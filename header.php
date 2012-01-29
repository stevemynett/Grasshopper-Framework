<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="author" content="">
    <meta name="description" content=""> 
    <meta name="viewport" content="width=device-width,initial-scale=1"> 

    <title><?php sm_title(); ?></title>

    <link rel="stylesheet/less" type="text/css" href="<?php bloginfo('template_url'); ?>/css/prod/styles.less">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <script src="<?php bloginfo('template_url'); ?>/js/modernizr.2.0.6.custom.js"></script>
    <?php wp_enqueue_script('jquery', '/wp-content/themes/sm_framework/js/jquery-1.6.2.min.js', array('jquery')); ?>	

    <?php if ( is_singular() ) echo '<link rel="canonical" href="' . get_permalink() . '">'; ?>
    <?php if ( is_singular() && get_option( 'thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>


	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="wrapper">
    <header>
        <a class="logo ir" href="<?php bloginfo('home'); ?>" rel="home"><?php bloginfo('name'); ?> |  <?php bloginfo('description'); ?></a>

        <nav class="primary">>
        <a href="<?php echo get_permalink(2); ?>" <?php if(is_page('2')){echo 'class="current_page_item"';};?>>Home</a>
        </nav>
    </header>