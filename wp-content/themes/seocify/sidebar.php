<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>
<div class="col-md-4">
	<div class="blog-sidebar-wraper right-sidebar">
		<?php
			if ( is_active_sidebar( 'sidebar-1' ) ) {
				dynamic_sidebar( 'sidebar-1' );
			}
		?>
	</div>
</div>

