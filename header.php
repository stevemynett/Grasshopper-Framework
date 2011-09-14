<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="author" content="">
	<title><?php if (function_exists('is_tag') && is_tag()) { echo 'Tag Archive for &quot;'.$tag.'&quot; - '; } elseif (is_archive()) { wp_title(''); echo ' Archive - '; } elseif (is_search()) { echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; } elseif (!(is_404()) && (is_single()) || (is_page() && ! is_front_page())) { wp_title(''); echo ' - '; } elseif (is_404()) { echo 'Not Found - '; } if (is_front_page()) { bloginfo('name'); echo ' - '; bloginfo('description'); } else { bloginfo('name'); } ?></title>

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/style.css" />
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<script src="<?php bloginfo('template_url'); ?>/js/modernizr.2.0.6.custom.js"></script>
	<?php wp_enqueue_script('jquery', '/wp-content/themes/sm_framework/js/jquery-1.6.2.min.js', array('jquery')); ?>	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
