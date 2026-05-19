<?php if(!empty($params['type'])){  
	$type = $params['type'];
    $emoji_structures = [
        'like' => '
            <div class="emoji emoji--like">
                <div class="emoji__hand"><div class="emoji__thumb"></div></div>
            </div>',
        'dislike' => '
            <div class="emoji emoji--dislike">
                <div class="emoji__hand"><div class="emoji__thumb"></div></div>
            </div>',
        'love' => '
            <div class="emoji emoji--love">
                <div class="emoji__heart"></div>
            </div>',
        'haha' => '
            <div class="emoji emoji--haha">
                <div class="emoji__face">
                    <div class="emoji__eyes"></div>
                    <div class="emoji__mouth"><div class="emoji__tongue"></div></div>
                </div>
            </div>',
        'yay' => '
            <div class="emoji emoji--yay">
                <div class="emoji__face">
                    <div class="emoji__eyebrows"></div>
                    <div class="emoji__mouth"></div>
                </div>
            </div>',
        'wow' => '
            <div class="emoji emoji--wow">
                <div class="emoji__face">
                    <div class="emoji__eyebrows"></div>
                    <div class="emoji__eyes"></div>
                    <div class="emoji__mouth"></div>
                </div>
            </div>',
        'sad' => '
            <div class="emoji emoji--sad">
                <div class="emoji__face">
                    <div class="emoji__eyebrows"></div>
                    <div class="emoji__eyes"></div>
                    <div class="emoji__mouth"></div>
                </div>
            </div>',
        'angry' => '
            <div class="emoji emoji--angry">
                <div class="emoji__face">
                    <div class="emoji__eyebrows"></div>
                    <div class="emoji__eyes"></div>
                    <div class="emoji__mouth"></div>
                </div>
            </div>'
    ];
	echo "<div class='ossn-reacted-item-icon'>";
	echo $emoji_structures[$type];
	echo "</div>";
    ?>
<?php } ?>