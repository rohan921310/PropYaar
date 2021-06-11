<?php

/*
function ping(){
    die("ping pong");
}

ping();

*/

function get_view($sub, $data = [], $domain = 'front'){
    $CI = &get_instance();

    die(get_class($CI));

    $CI->load-view($domain . "/" . $sub);

}

function get_page($page){
    get_view('pages/');
}

function get_asset_url($sub, $domain = 'front'){
    return base_url($domain . '/asset/' . $sub);
}

function get_css_url($css, $domain = 'front'){
    return get_asset_url('css/' . $css, $domain);
}

function link_css($css, $attrs = [], $domain = 'front'){
    $link = '<link ';
    foreach($attrs as $name => $value){
        $link .= " {$name}=\"{$value}\" ";
    }
    $link .= ' href="' . get_css_url($css, $domain) . '">';

    return $link;
}

function get_js_url($js, $domain = 'front'){
    return get_asset_url('js/' . $js, $domain);
}

function link_js($js, $attrs = [], $domain = 'front'){
    $script = '<script ';

    foreach($attrs as $name => $value){
        $script .= " {$name}=\"{$value}\" ";
    }
    $script .= ' src="' . get_js_url($js, $domain) . '"></script>';
    return $script;
}

function get_images_url($image, $domain = 'front'){
    return get_asset_url('images/' . $image, $domain);
}

function get_image($image, $attrs = [], $domain = 'front'){
    $img = '<img ';

    foreach($attrs as $name => $value){
        $img .= " {$name}=\"{$value}\" ";
    }

    return get_images_url($image, $domain);

}

function ping(){
    die("ping pong");
}

//ping();