<aside class="sidebar">
	<a href="/"><img src="<?php bloginfo( 'template_directory' ); ?>/dist/images/skstyleguide/sundsvall_logo_large.svg" alt="Sundsvalls kommun" id="logo" /></a>
	<div id="tagline">Digitalt identitetsverktyg</div>

	<?php //wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

	<?php
		global $original_post;

		$menu = wp_get_nav_menu_items( "Menu 1" );
	?>

	<ul class="styleguide-menu">
		<?php foreach ($menu as $menuitem) : ?>
			<?php
				$class = "";
				if ($menuitem->object_id == $original_post->ID) {
					$class = "current";
				}
			?>

			<li class="styleguide-item <?php echo $class; ?>"><a href="<?php echo $menuitem->url; ?>"><?php echo $menuitem->title; ?></a></li>

			<?php if ($class == "current") : ?>
				<?php
					$args = array(
						'sort_order' => 'asc',
						'sort_column' => 'menu_order',
						'child_of' => $menuitem->object_id,
					);
					$subpages = get_pages($args);
				?>

				<?php if ($subpages) : ?>
					<ul>
						<?php foreach ( $subpages as $subpage ) : ?>
							<li><a href="#<?php echo $subpage->post_name; ?>"><?php echo $subpage->post_title; ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			<?php endif; ?>

		<?php endforeach; ?>
	</ul>


	<div id="contact-info">
		<?php
			$contact_page = get_posts(
				array(
					'name'      => 'kontakt',
					'post_type' => 'page'
				)
			);

			if ( $contact_page ) {
				$contact_title = $contact_page[0]->post_title;
				$contact_info = $contact_page[0]->post_content;
			}
		?>

		<h2><?php echo $contact_title; ?></h2>
		<?php echo $contact_info; ?>
	</div>

</aside>
