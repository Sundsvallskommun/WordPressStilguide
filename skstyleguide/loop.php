<?php if(have_posts()) : ?>

<?php while ( have_posts() ) : the_post(); ?>
  
  <article class="index">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_content(); ?>
  </article>

<?php endwhile; // end of the loop. ?>
  
<?php endif; ?>