<!doctype html>
<!--[if lt IE 8]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if lt IE 9]>
<html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/dist/css/main.min.css">

	<link href='https://fonts.googleapis.com/css?family=Raleway:400,500|Source+Sans+Pro:400,600,800' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lte IE 9]>
<div class="outdated-browser">
	<p>
		<img src="<?php echo get_template_directory_uri(); ?>/dist/images/sad.png" alt="Inget browserstöd">
		Din webbläsare är <em>väldigt</em> gammal. Den är så pass gammal att den här webbplatsen inte kommer att fungera
		riktigt som den ska. På <a href="http://browsehappy.com/">browsehappy.com</a> kan du få hjälp med att uppgradera
		din webbläsare och förbättra upplevelsen.
	</p>
</div>
<![endif]-->

<?php require_once( dirname( __FILE__ ) . '/dist/images/icons.svg' ); ?>

<header role="banner">
</header>

<main role="main">