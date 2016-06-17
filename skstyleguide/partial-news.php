<div class="news-list">
	<h3>Senaste uppdateringar</h3>

	<div class="container">

		<div class="col-md-6">

			<?php $original_post = $post; ?>

			<?php query_posts('posts_per_page=6'); ?>
			<?php $current_number = 0; ?>

			<?php while (have_posts()) : the_post(); ?>

			<?php if ($current_number == 3) : ?>
		</div><div class="col-md-6">
			<?php endif; ?>

			<div class="news-post">
				<div class="news-title"><a href="/<?php the_permalink(); ?>/"><?php the_title(); ?></a></div>
				<div class="news-date"><?php the_date(); ?></div>
				<div class="news-excerpt"><?php the_excerpt(); ?></div>

			</div>

			<?php $current_number++; ?>
			<?php endwhile; ?>

		</div><!-- /.col-md-6 -->
	</div><!-- /.container -->

</div><!-- /.news-list -->
