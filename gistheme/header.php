<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<script>
jQuery( document ).ready(function($) {
    // $( ".sidebar-main-toggle" ).click(function() {
	// 	$( 'section#sidebar' ).toggleClass( "active-cc" );
	// 	$( 'section#main-content' ).toggleClass( "active-cl" );

	// });
	// $( "section#sidebar .nav-sidebar .nav-link.legitRipple" ).click(function() {
	// 	$(this).parent().toggleClass( "active-ca" );
	// });

	$('#tabs li a:not(:first)').addClass('inactive');
	$('.container').hide();
	$('.container:first').show();

	$('#tabs li a').click(function(){
	    var t = $(this).attr('id');
	  if($(this).hasClass('inactive')){ //this is the start of our condition
	    $('#tabs li a').addClass('inactive');
	    $(this).removeClass('inactive');

	    $('.container').hide();
	    $('#'+ t + 'C').fadeIn('slow');
	 }
	});

	$( ".triger-pi" ).click(function() {
		$(this).parent('.nav-item').find('.switch').click();
	});
	$( ".sidebar-main-toggle" ).click(function() {
		map.updateSize();
	});

	$( ".click-chuthich-bt" ).click(function() {
		$( '.chuthich-bt' ).toggleClass( "active-ct" );
	});
	$( "#map" ).click(function() {
		$( '.chuthich-bt' ).removeClass( "active-ct" );
	});

	$('.kichban1 a').click(function(e){
      var kb1= $(this).attr( "title" );
      console.log(kb1);
      e.preventDefault;
    });
});

</script>
<body <?php body_class(); ?>>
<?php wp_body_open(); 
$value = myprefix_get_theme_option( 'checkbox_khancap' );
$class_kc = $value.'khancap';
?>

<div id="page" class="site <?php echo $class_kc; ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'twentytwentyone' ); ?></a>

	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
