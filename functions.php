<?php
wp_register_script('modernizr', get_template_directory_uri() . '/scripts/modernizr.js');
wp_register_script('bootstrap', get_template_directory_uri() . '/scripts/bootstrap.min.js', array('jquery'), '3.1.1', true);
wp_register_style('theme', get_template_directory_uri() . '/css/theme.css');

require_once 'plugins/plugin-loader.php';
load_plugin('plugin-mvc');
load_plugin('navbar-walker');
load_plugin('bootstrap-shortcodes');

load_plugin('social-links');

add_theme_support('post-thumbnails');
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('menus');

add_image_size('background-larger', 1920, 1080, true);
add_image_size('background-large', 1368, 720, true);
add_image_size('background-medium', 1280, 1024, true);
add_image_size('background-small', 1024, 768, true);
add_image_size('background-phone', 640, 320, true);

register_nav_menu('header-menu', 'Header Menu');
register_nav_menu('footer-menu', 'Footer Menu');

register_sidebar(array(
    'name'          => "Footer",
    'id'            => 'footer',
    'description'   => '',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>'
));

register_sidebar(array(
    'name'          => "Blog Page Right",
    'id'            => 'blog-rail',
    'description'   => '',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>'
));

//add_filter('bootstrap_config_default_values', function($fields){
//    $fields['Nav'] = array(
//      '@linkColorNav' => array('name' => '@linkColorNav', 'type' => 'color', 'title' => 'Nav Link Color', 'value' => '@linkColor', 'order'=> 40)
//    );
//    $fields['Theme Settings'] = array_merge($fields['Theme Settings'], array(
//        '@paragraphLineHeight' => array('name' => '@paragraphLineHeight', 'type' => 'size', 'title' => 'Paragraph Line Height', 'value' => '1.5', 'order'=> 10),
//        '@paddingBodyTop' => array('name' => '@paddingBodyTop', 'type' => 'size', 'title' => 'Body Top Padding', 'value' => '0', 'order'=> 40),
//        '@containerBackground' => array('name' => '@containerBackground', 'type' => 'color', 'title' => 'Container Background', 'value' => '@white', 'order'=> 20),
//        '@containerPadding' => array('name' => '@containerPadding', 'type' => 'shorthand', 'title' => 'Container Padding', 'value' => '0', 'order'=> 20),
//        '@contentBackground' => array('name' => '@contentBackground', 'type' => 'color', 'title' => 'Content Area Background', 'value' => 'transparent', 'order'=> 20),
//        '@contentPadding' => array('name' => '@contentPadding', 'type' => 'shorthand', 'title' => 'Content Area Padding', 'value' => '10px', 'order'=> 20),
//        '@headerImagePadding' => array('name' => '@headerImagePadding', 'type' => 'shorthand', 'title' => 'Header Image Padding', 'value' => '0', 'order'=> 20),
//        '@postBackgroundColor' => array('name' => '@postBackgroundColor', 'type' => 'color', 'title' => 'Post Background', 'value' => 'transparent', 'order'=> 20),
//        '@socialLinkColor' => array('name' => '@socialLinkColor', 'type' => 'color', 'title' => 'Social Link Color', 'value' => '@textColor', 'order'=> 30),
//        '@socialLinkColorHover' => array('name' => '@socialLinkColorHover', 'type' => 'color', 'title' => 'Social Link Hover Color', 'value' => 'lighten(@socialLinkColor, 30%)', 'order'=> 31),
//        '@socialLinkSize' => array('name' => '@socialLinkSize', 'type' => 'size', 'title' => 'Social Link Size', 'value' => '@fontSizeLarge', 'order'=> 30)
//    ));
//    
//    return $fields;
//});

function get_background_image_size($size){
    global $wpdb;
    $bkgd = get_background_image();
    $upload_base = wp_upload_dir();
    $upload_base = trailingslashit( $upload_base['baseurl'] );
    $bkgd = str_replace($upload_base, '', $bkgd);
    $id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $bkgd));
    if($id >= 0){
        $bkgd = wp_get_attachment_image_src($id, $size);
        $bkgd = $bkgd[0];
    }
    return $bkgd;
}

function get_favicon_url(){
    if(file_exists(get_stylesheet_directory() . '/favicon.ico')){
        return get_stylesheet_directory_uri() . '/favicon.ico';
    }elseif (file_exists(get_template_directory() . '/favicon.ico')) {
        return get_template_directory_uri() . '/favicon.ico';
    }else{
        return '/favicon.ico';
    }
}