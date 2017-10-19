<!doctype html>
<!--
 _         _         _                            _  _                  _ 
| |    ___| |_ ___  | |    ___  __ _ _ __ _ __   | \ | | ___ _ __   __ _| |
| |   / _ \ __/ __| | |   / _ \/ _` | '__| '_ \  |  \| |/ _ \ '_ \ / _` | |
| |__|  __/ |_\__ \ | |__|  __/ (_| | |  | | | | | |\  |  __/ |_) | (_| | |
|_____\___|\__|___/ |_____\___|\__,_|_|  |_| |_| |_| \_|\___| .__/ \__,_|_|

Designed By :

 ____  _     _          _          _         ____         _             _       
/ ___|| |__ (_)_ __ ___| |__   __ _| | __    | __ )  __ _ (_) __ _  __ _(_)_ __  
\___ \| '_ \| | '__/ __| '_ \ / _` | |/ /    |  _ \ / _` || |/ _` |/ _` | | '_ \ 
 ___) | | | | | |  \__ \ | | | (_| |   <     | |_) | (_| || | (_| | (_| | | | | |
|____/|_| |_|_|_|  |___/_| |_|\__,_|_|\_\    |____/ \__,_|/ |\__, |\__,_|_|_| |_|
                                                        |__/ |___/               
Owned By :
 ____                          _   
/ ___|  __ _ _   _  __ _  __ _| |_ 
\___ \ / _` | | | |/ _` |/ _` | __|
 ___) | (_| | |_| | (_| | (_| | |_ 
|____/ \__,_|\__,_|\__, |\__,_|\__|
                   |___/           

Interested in working with us? See https://www.letslearnnepal.com/contact
Just peeking under the hood?
Don't Touch us . We are here to serve people .
-->

<html <?php language_attributes();?>>

<head>
    <title><?php wp_title('|', true, 'right'); ?></title>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,minimum-scale=1">

    <?php if(get_option('bv_blog_favicon')){ ?>
        <link rel="shortcut icon" href="<?php echo esc_url(get_option('bv_blog_favicon')); ?>"/>
    <?php } else {?>
        <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri()); ?>/data/images/favicon.png"/>
    <?php } ?>

    <link rel="stylesheet" href="<?php echo get_stylesheet_uri();?>" type="text/css"/>


    <!--Great Stuff that stop your brain-->
    <?php 
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
    wp_head(); 
    ?>
    <!-- Stuff -->
</head>

<body <?php body_class(); ?> id="sweet_body">

<?php include(get_template_directory()."/headerbox.php"); ?>

<div class="layout">