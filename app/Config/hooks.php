$hook['post_controller_constructor'][] = array(
    'class'    => 'Redirect_filter',
    'function' => 'redirect_after_login',
    'filename' => 'redirect_filter.php',
    'filepath' => 'hooks',
);
