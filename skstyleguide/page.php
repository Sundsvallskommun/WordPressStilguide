<?php get_header(); ?>

<div class="content">

    <?php while ( have_posts() ) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <div class="page-content">
        <div class="last-change">Senast ändrad <?php echo date ("Y-m-d", strtotime($post->post_modified)); ?></div>
        <?php the_content(); ?>
      </div>
    <?php endwhile; // end of the loop. ?>

  <?php include("partial-news.php"); ?>

</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>