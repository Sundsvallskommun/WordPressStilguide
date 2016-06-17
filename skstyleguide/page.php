<?php get_header(); ?>

<div class="content">
  <div class="page-content">

    <?php while ( have_posts() ) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>

  </div>

  <?php include("partial-news.php"); ?>

</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>