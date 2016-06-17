<?php
/**
 * The template for displaying 404 pages (Not Found).
 */

get_header(); ?>

<div class="of-block of-main-padded of-inner-padded">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'osynlig' ); ?></h1>
	</header>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'osynlig' ); ?></p>
	<?php get_search_form(); ?>
</div>

<?php get_footer(); ?>