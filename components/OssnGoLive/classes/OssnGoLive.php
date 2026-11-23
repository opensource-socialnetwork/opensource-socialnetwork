<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

class OssnGoLive extends OssnWall {

    /**
     * Centralized cURL helper for Cloudflare Stream API
     */
    private function makeCloudflareRequest($endpoint, $method = 'GET', $data = null) {
        $component = new OssnComponents();
        $settings  = $component->getSettings('OssnGoLive');

        $account_id = trim($settings->cloudflare_account_id ?? '');
        $api_token  = trim($settings->cloudflare_api_token ?? '');

        if (empty($account_id) || empty($api_token)) {
            return array('success' => false, 'message' => ossn_print('golive:error:credentials'));
        }

        $url = "https://api.cloudflare.com/client/v4/accounts/{$account_id}/stream{$endpoint}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        $headers = array(
            "Authorization: Bearer {$api_token}",
            "Content-Type: application/json"
        );

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            return array('success' => false, 'message' => ossn_print('golive:error:curl') . ': ' . $curl_error);
        }

        $res_data = json_decode($response, true);

        if ($http_code !== 200 || !isset($res_data['success']) || !$res_data['success']) {
            $cf_error = isset($res_data['errors'][0]['message']) ? $res_data['errors'][0]['message'] : ossn_print('golive:error:unknown');
            return array('success' => false, 'message' => "Cloudflare Error (HTTP {$http_code}): {$cf_error}");
        }

        return array('success' => true, 'result' => $res_data['result']);
    }

    /**
     * Find active stream post for a user
     */
    public function getActiveByGuid($guid) {
        $posts = $this->GetPosts(array(
				'owner_guid' => (int)$guid,
				'page_limit' => 1,
				'entities_pairs' => array(
						array(
							'name'   => 'stream_status',
							'value'  => 'live',
						),
				),
		));
        if ($posts) {
            return $posts[0];
        }
        return false;
    }

    /**
     * Start Stream: Cleanup old session, call Cloudflare, create wall post, and set data properties
     */
	public function startStream($guid, $payload) {
        // 1. Auto-cleanup any existing active session first
        $this->stopStream($guid);

        // 2. Request new live input from Cloudflare
        $cf_response = $this->makeCloudflareRequest('/live_inputs', 'POST', $payload);
        if (!$cf_response['success']) {
            return $cf_response;
        }

        $input_id = $cf_response['result']['uid'];
        $whip_url = $cf_response['result']['webRTC']['url'] ?? '';

        // 3. Create the Wall Post object directly via OssnWall inheritance
        $this->type        = 'user';
        $this->item_type   = 'golive';
        $this->owner_guid  = (int)$guid;
        $this->poster_guid = (int)$guid;
        
        $post_guid = $this->Post(null, '', '', OSSN_PUBLIC);
        
        if (!$post_guid) {
            return array('success' => false, 'message' => ossn_print('golive:error:save'));
        }
		
        $post_object = $this->GetPost($post_guid);
        if ($post_object) {
            $post_object->data->item_guid = $input_id;
            $post_object->data->stream_status = 'live';
            $post_object->save();
        }
		
		//notify friends here
		$user = ossn_loggedin_user();
		$friends = $user->getFriends($user->guid, array('page_limit' => false));
		if($friends){
			foreach($friends as $friend){
				$notification = new OssnNotifications();
				$notification->add('golive', $user->guid, $post_guid, $post_guid, $friend->guid);
			}
		}
        return array(
            'success' => true,
            'live_input_id' => $input_id,
            'whip_url' => $whip_url
        );
    }
    /**
     * Stop Stream: Disable on Cloudflare and update post data stream_status to 'ended'
     */
    public function stopStream($guid) {
        $active_post = $this->getActiveByGuid($guid);

        if ($active_post) {
            $input_id = $active_post->data->item_guid ?? '';
            if (!empty($input_id)) {
                $this->makeCloudflareRequest("/live_inputs/{$input_id}", 'PUT', array('enabled' => false));
            }
            if (isset($active_post->data)) {
                $active_post->data->stream_status = 'ended';
                $active_post->save();
            }
            return true;
        }

        return false;
    }

    /**
     * Get stream post by ID using OssnWall's GetPost method
     */
    public function getStreamById($id) {
        return $this->GetPost($id);
    }
}