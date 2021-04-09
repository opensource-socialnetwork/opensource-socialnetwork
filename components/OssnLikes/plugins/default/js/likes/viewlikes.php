//<script>
Ossn.ViewLikes = function($post, $type) {
    if (!$type) {
        $type = 'post';
    }
    Ossn.MessageBox('likes/view?guid=' + $post + '&type=' + $type);
};