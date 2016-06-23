<?php
/**
* Template Name: Undersida Styles
*
* @author Tomas Wisten <tomas@kingmary.se>
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

global $post, $subpage;

if ($subpage) {
    $preview_subpage = false;
} else {
    $subpage = $post;
    $preview_subpage = true;
}
?>

<?php if ($preview_subpage) : ?>
    <?php include("partial-subpage-top.php"); ?>
<?php endif; ?>


<div class="subpage-styles subpage">
    <h2><?php echo $subpage->post_title; ?></h2>
    <?php echo wpautop($subpage->post_content); ?>
    <?php

      $image_text = get_field("text_vid_bild", $subpage->ID);
      $image = get_field("bild", $subpage->ID);
      $image_mobile = get_field("bild_mobilversion", $subpage->ID);
      $file = get_field("ladda_ner_fil", $subpage->ID);

    ?>

    <div class="row">
        <?php if ($image_text) : ?>
            <?php $image_cols = 10; ?>
            <div class="col-md-2 style-image-text">
                <?php echo $image_text; ?>
            </div>

        <?php else : ?>
            <?php $image_cols = 12; ?>
        <?php endif; ?>

        <?php if ($image) : ?>
            <?php if ($image_mobile) : // Show both mobile and desktop version of image ?>
                <div class="col-md-<?php echo $image_cols; ?> style-image">
                    <img src="<?php echo $image['url']; ?>" class="image-only-desktop" />
                    <img src="<?php echo $image_mobile['url']; ?>" class="image-only-mobile" />
                </div>
            <?php else : ?>
                <div class="col-md-<?php echo $image_cols; ?> style-image">
                    <img src="<?php echo $image['url']; ?>" />
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>

    <?php if ($file) : ?>
        <div class="style-file-container">
            <h4>Ladda ner</h4>
            <div class="style-file pull-xs-left">
                <a href="<?php echo $file['url']; ?>"><img src="<?php echo get_template_directory_uri(); ?>/dist/images/icons/download.png" class="style-icon pull-xs-left" /></a>

                <div class="style-description pull-xs-left">
                    <a href="<?php echo $file['url']; ?>"><?php echo $file['filename']; ?></a>
                    <div class="description"><?php echo $file['description']; ?></div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php if ($preview_subpage) : ?>
    <?php include("partial-subpage-bottom.php"); ?>
<?php endif; ?>

