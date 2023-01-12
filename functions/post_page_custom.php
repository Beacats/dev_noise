<?php
// カスタム投稿画面にCSS・jsの追加

function my_admin_style(){
  wp_enqueue_style( 'my_admin_style', get_template_directory_uri().'/css/my_admin_style.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );

function my_admin_script(){
// jQuery 
wp_enqueue_script( 'my_admin_script', get_template_directory_uri().'/js/my_admin_script.js', array('jquery'));
 
}
add_action( 'admin_enqueue_scripts', 'my_admin_script' );





?>