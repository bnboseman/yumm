<?php if ( ! isset( $content_width ) ) $content_width = 720;?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url');?>">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url');?>" media="screen" />
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
        <div class="mainheader">
            <h1><a href="<?php   echo esc_url( home_url('/') ) ?>"><?php bloginfo('name')?></a></h1>
            <div class="description"><?php bloginfo('description')?></div>
        </div>
		<div class="container">