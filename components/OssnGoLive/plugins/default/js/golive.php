//<script>
/**
 * OssnGoLive - Frontend WebRTC WHIP Streamer with Dynamic Live Viewer Polling
 */
$(document).ready(function() {
    if ($('#golive-preview').length === 0) {
        return; // Only run on the producer page
    }

    let localStream = null;
    let peerConnection = null;
    let isStreaming = false;
    let viewerInterval = null;
    let activeLiveInputId = null; // <--- Stores the ID returned dynamically by AJAX

    const videoElement = document.getElementById('golive-preview');
    const videoSelect = $('#golive-video-source');
    const audioSelect = $('#golive-audio-source');

    // Match mobile studio stage aspect ratio to the active camera dimensions
    videoElement.addEventListener('loadedmetadata', function() {
        if (window.innerWidth <= 768 && videoElement.videoWidth && videoElement.videoHeight) {
            const stage = document.querySelector('.golive-stage-container');
            if (stage) {
                stage.style.aspectRatio = `${videoElement.videoWidth} / ${videoElement.videoHeight}`;
            }
        }
    });

    // 1. Settings Modal Toggle Handlers
    $(document).on('click', '#golive-settings-toggle', function() {
        $('#golive-settings-modal').fadeIn(200);
    });

    $(document).on('click', '#golive-modal-close, .golive-modal-backdrop', function(e) {
        if (e.target === this) {
            $('#golive-settings-modal').fadeOut(200);
        }
    });

    // 2. Enumerate devices and populate dropdowns
    async function initDeviceSelectors() {
        try {
            const devices = await navigator.mediaDevices.enumerateDevices();
            videoSelect.empty();
            audioSelect.empty();

            let hasDevices = false;
            devices.forEach(device => {
                if (device.kind === 'videoinput' || device.kind === 'audioinput') {
                    hasDevices = true;
                    const option = $('<option></option>').val(device.deviceId).text(device.label || `${device.kind === 'videoinput' ? 'Camera' : 'Mic'} (${device.deviceId.substr(0, 5)})`);
                    if (device.kind === 'videoinput') videoSelect.append(option);
                    if (device.kind === 'audioinput') audioSelect.append(option);
                }
            });

            if (!hasDevices || $(videoSelect).children().length === 0) {
                const tempStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                tempStream.getTracks().forEach(track => track.stop());
                return initDeviceSelectors();
            }

            startPreview();
        } catch (err) {
            console.error('Error accessing media devices.', err);
            $('#golive-camera-error').show();
        }
    }

    // 3. Start local camera preview & swap active WebRTC tracks if live
    async function startPreview() {
        if (localStream) {
            localStream.getTracks().forEach(track => track.stop());
        }

        const videoConstraints = videoSelect.val()
            ? { deviceId: { exact: videoSelect.val() } }
            : { width: { ideal: 1280 }, height: { ideal: 720 } };
        const audioConstraints = audioSelect.val()
            ? { deviceId: { exact: audioSelect.val() } }
            : true;

        try {
            localStream = await navigator.mediaDevices.getUserMedia({
                video: videoConstraints,
                audio: audioConstraints
            });
            videoElement.srcObject = localStream;
            $('#golive-camera-error').hide();

            if (isStreaming && peerConnection) {
                const newVideoTrack = localStream.getVideoTracks()[0] || null;
                const newAudioTrack = localStream.getAudioTracks()[0] || null;

                const senders = peerConnection.getSenders();
                for (const sender of senders) {
                    if (sender.track && sender.track.kind === 'video' && newVideoTrack) {
                        await sender.replaceTrack(newVideoTrack);
                    } else if (sender.track && sender.track.kind === 'audio' && newAudioTrack) {
                        await sender.replaceTrack(newAudioTrack);
                    }
                }
            }
        } catch (err) {
            console.error('Preview start error:', err);
            $('#golive-camera-error').show();
        }
    }

    videoSelect.on('change', startPreview);
    audioSelect.on('change', startPreview);

    initDeviceSelectors();

    // 4. Live Viewer Polling Functions
    function startViewerPolling() {
        if (!activeLiveInputId) return;

        if (viewerInterval) clearInterval(viewerInterval);

        fetchViewerCount();
        viewerInterval = setInterval(fetchViewerCount, 5000);
    }

    function fetchViewerCount() {
        if (!activeLiveInputId) return;

        $.ajax({
            url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/golive/get_views?live_input_id=' + encodeURIComponent(activeLiveInputId)),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {
                    const count = parseInt(response.liveViewers, 10) || 0;
                    if (count > 0) {
                        $('#studio-live-counter').text(count);
                        $('#golive-viewer-badge').removeClass('d-none').show();
                    } else {
                        $('#golive-viewer-badge').hide().addClass('d-none');
                    }
                } else {
                    $('#golive-viewer-badge').hide().addClass('d-none');
                }
            },
            error: function(err) {
                console.error('Failed to fetch live viewer count:', err);
                $('#golive-viewer-badge').hide().addClass('d-none');
            }
        });
    }

    function stopViewerPolling() {
        if (viewerInterval) {
            clearInterval(viewerInterval);
            viewerInterval = null;
        }
        activeLiveInputId = null;
        $('#studio-live-counter').text('0');
        $('#golive-viewer-badge').hide().addClass('d-none');
        $('.golive-immersive-studio').removeData('live-input-id');
    }

    // 5. Handle "Go Live" button click
    $(document).on('click', '#golive-start-btn', async function(e) {
        e.preventDefault();
        if (!localStream) {
            Ossn.trigger_message(Ossn.Print('golive:error:camera:notready') || 'Camera stream is not ready yet.', 'danger');
            return;
        }

        const $btn = $(this);
        $btn.prop('disabled', true).text(Ossn.Print('golive:starting') || 'Starting Stream...');

        try {
            const actionUrl = Ossn.AddTokenToUrl(Ossn.site_url + 'action/golive/start');
            const response = await $.ajax({
                url: actionUrl,
                type: 'POST',
                dataType: 'json'
            });

            if (!response.success || !response.whip_url) {
                Ossn.trigger_message(response.message || Ossn.Print('golive:error:init') || 'Failed to initialize live stream.', 'danger');
                $btn.prop('disabled', false).html('<i class="fa fa-broadcast-tower"></i> ' + (Ossn.Print('golive:go:live') || 'Go Live'));
                return;
            }

            // Capture the dynamic live input ID returned by PHP/Cloudflare!
            activeLiveInputId = response.live_input_id;
            // Store it on the studio DOM element so external functions can access it
            $('.golive-immersive-studio').data('live-input-id', activeLiveInputId);

            peerConnection = new RTCPeerConnection({
                iceServers: [{ urls: 'stun:stun.cloudflare.com:3478' }]
            });

            localStream.getTracks().forEach(track => {
                peerConnection.addTrack(track, localStream);
            });

            const offer = await peerConnection.createOffer();
            await peerConnection.setLocalDescription(offer);

            const whipResponse = await fetch(response.whip_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/sdp' },
                body: offer.sdp
            });

            if (!whipResponse.ok) throw new Error('Failed to connect to Cloudflare WHIP server.');

            const answerSdp = await whipResponse.text();
            await peerConnection.setRemoteDescription({ type: 'answer', sdp: answerSdp });

            $btn.hide();
            $('#golive-stop-btn').show();
            $('#golive-status-badge').removeClass('offline').addClass('live').html('<span class="badge-dot"></span> ' + (Ossn.Print('golive:status:live') || 'LIVE'));

            isStreaming = true;
            Ossn.trigger_message(Ossn.Print('golive:active:success') || 'Live stream is now active!', 'success');

            // Start polling the viewer count using the captured ID
            startViewerPolling();

        } catch (error) {
            console.error('Go Live Error:', error);
            Ossn.trigger_message(Ossn.Print('golive:error:start') || 'An error occurred while starting the stream.', 'danger');
            $btn.prop('disabled', false).html('<i class="fa fa-broadcast-tower"></i> ' + (Ossn.Print('golive:go:live') || 'Go Live'));
        }
    });

    // 6. Handle "End Stream" button click
    $(document).on('click', '#golive-stop-btn', async function(e) {
        e.preventDefault();
        const $btn = $(this);
        $btn.prop('disabled', true).text(Ossn.Print('golive:ending') || 'Ending Stream...');

        try {
            const actionUrl = Ossn.AddTokenToUrl(Ossn.site_url + 'action/golive/end');
            await $.ajax({
                url: actionUrl,
                type: 'POST',
                dataType: 'json'
            });

            if (peerConnection) {
                peerConnection.close();
                peerConnection = null;
            }

            stopViewerPolling();

            $('#golive-stop-btn').hide();
            $('#golive-start-btn.golive-btn-live').show().prop('disabled', false).html('<i class="fa fa-broadcast-tower"></i> ' + (Ossn.Print('golive:go:live') || 'Go Live'));
            $('#golive-status-badge').removeClass('live').addClass('offline').html('<span class="badge-dot"></span> ' + (Ossn.Print('golive:status:offline') || 'OFFLINE'));

            isStreaming = false;
            Ossn.trigger_message(Ossn.Print('golive:ended:success') || 'Live stream has ended.', 'success');
            setTimeout(() => {
                window.location.href = Ossn.site_url;
            }, 1000);

        } catch (error) {
            console.error('End Stream Error:', error);
            Ossn.trigger_message(Ossn.Print('golive:ended:error') || 'Failed to cleanly close stream session.', 'danger');
            $btn.prop('disabled', false).html('<i class="fa fa-stop-circle"></i> ' + (Ossn.Print('golive:end:stream') || 'End Live Video'));
        }
    });

    // 7. Graceful tab-close / unload cleanup using navigator.sendBeacon
    window.addEventListener('beforeunload', function (e) {
        if (isStreaming) {
            const actionUrl = Ossn.AddTokenToUrl(Ossn.site_url + 'action/golive/end');
            navigator.sendBeacon(actionUrl);
        }
    });
});