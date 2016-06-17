<?php
/**
* Template Name: Undersida Typsnitt
*
* @author Tomas Wisten <tomas@kingmary.se>
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

    global $post, $subpage;

    $file = get_field("ladda_ner_fil", $subpage->ID);

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


<div class="subpage-fonts subpage">
    <h2><?php echo $subpage->post_title; ?></h2>
    <?php echo wpautop($subpage->post_content); ?>

    <br /><h4>Våra typsnitt</h4>
    <div class="row">
        <div class="style-fonts container">
            <div class="col-md-4 style-font-item item style-font-example" id="font-raleway">
                Raleway
            </div>
            <div class="col-md-4 style-font-item item style-font-example" id="font-source-sans">
                Source sans
            </div>
        </div>
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

