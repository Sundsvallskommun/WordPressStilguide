<?php
/**
 * The template for displaying Archive pages.
 */

get_header(); ?>

<div class="of-main-padded">
	<?php if ( have_posts() ) : ?>
		<header>
			<h1>Arkiv</h1>
		</header>

		<?php	get_template_part( 'loop', 'index' ); ?>
	<?php else : ?>
		<?php get_template_part( 'loop', 'index' ); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>