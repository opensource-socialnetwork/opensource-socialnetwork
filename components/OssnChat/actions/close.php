<?php

$chat = input('fid');
if (OssnChat::removeChatTab($chat)) {
    echo 1;
} else {
    echo 0;
}