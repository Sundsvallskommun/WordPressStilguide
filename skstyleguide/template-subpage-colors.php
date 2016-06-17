<?php
/**
* Template Name: Undersida Färger
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


<div class="subpage-colors subpage">
    <h2><?php echo $subpage->post_title; ?></h2>
    <?php echo wpautop($subpage->post_content); ?>
    <?php

      $fargskala = get_field("fargskala", $subpage->ID);
      $file = get_field("ladda_ner_fil", $subpage->ID);

    ?>


    <div class="row">
        <?php if ($fargskala) : ?>
            <?php foreach ($fargskala as $this_color) : ?>
                <div class="style-color-collection row">
                    <?php for ($fargnummer = 1; $fargnummer < 4; $fargnummer++) : ?>
                        <div class="style-color row">
                            <div class="col-md-3 style-color-text">
                                <?php $fieldname = "beskrivning_farg_".$fargnummer; ?>
                                <?php echo $this_color[$fieldname]; ?><br>
                            </div>

                            <?php $fieldname = "fargkod_farg_".$fargnummer; ?>
                            <div class="col-md-9 style-color-bar" style="background-color: <?php echo $this_color[$fieldname]; ?>;">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endforeach; ?>
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

