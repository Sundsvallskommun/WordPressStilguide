<?php
/**
* Template Name: Startsida
*
* @author Tomas Wisten <tomas@kingmary.se>
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

    global $post;
    get_header();
?>

<div class="content">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="page-content" id="startpage-header-container" style="background-image: url('<?php echo the_post_thumbnail_url("full", $post->ID); ?>')">
            <div id="startpage-header-text">
                <div class="startpage-headline">
                    <h1><?php the_field("sidhuvud_rubrik"); ?></h1>
                </div>
                <div class="startpage-subheadline">
                    <?php the_field("sidhuvud_underrubrik"); ?>
                </div>
            </div>
        </div>

        <div class="page-content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; // end of the loop. ?>

    <?php include("partial-news.php"); ?>

</div><!-- /.content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

