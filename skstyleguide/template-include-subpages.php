<?php
/**
* Template Name: Inkludera undersidor
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

get_header();
global $post, $subpage;
?>

<div class="content">
  <div class="style-content">
    <div class="container">

      <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="last-change">Senast ändrad <?php echo date ("Y-m-d", strtotime($post->post_modified)); ?></div>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>


      <?php

      $args = array(
          'sort_order' => 'asc',
          'sort_column' => 'menu_order',
          'child_of' => $post->ID,
      );
      $subpages = get_pages($args);
      foreach ($subpages as $subpage) : ?>

        <div class="included-subpage row">
          <a name="<?php echo $subpage->post_name; ?>"></a>
          <?php $partial_file = get_page_template_slug( $subpage->ID ); ?>
          <?php if ($partial_file) : ?>
            <?php include($partial_file); ?>
          <?php else : ?>
            <?php include("template-subpage-standard.php"); ?>
          <?php endif; ?>
        </div>

      <?php endforeach; ?>

    </div>
  </div>

  <?php include("partial-news.php"); ?>

</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>