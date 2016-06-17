<?php
/**
* Template Name: Undersida standard
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


<div class="subpage-standard subpage">
    <h2><?php echo $subpage->post_title; ?></h2>
    <?php echo wpautop($subpage->post_content); ?>
</div>

<?php if ($preview_subpage) : ?>
    <?php include("partial-subpage-bottom.php"); ?>
<?php endif; ?>

