<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xs
 */
/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'seocify_post_nav' ) ) :

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function seocify_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
		$pre_post = $next_post = '';
		$next_post	 = get_next_post();
		$pre_post	 = get_previous_post();
		if ( !$next_post && !$pre_post ) {
			return;
		}
		if($pre_post):
			$pre_img = wp_get_attachment_url( get_post_thumbnail_id($pre_post->ID) );
		endif;
		if($next_post):
			$next_img = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID) );
		endif;
		
		

		echo '<div class="post-navigation"> 
		<div class="row no-gutters"><div class="col-md-6"><div class="post-previous">';
		if ( !empty( $pre_post ) ):
			?>
			<a href="<?php echo get_the_permalink( $pre_post->ID ); ?>" class="single-post-nav">
				<div class="media align-items-center">
					<h4 class="post-title"><?php echo get_the_title( $pre_post->ID ) ?></h4>
				</div>
								<h3 class="post-nav-title icon-left"><i class="icon icon-arrow-left"></i> <?php esc_html_e( 'Previous Post', 'seocify' ) ?></h3>

			</a>

			<?php
		endif;
		echo '</div></div><div class="col-md-6"><div class="post-next">';

		if ( !empty( $next_post ) ):
			?>
			<a href="<?php echo get_the_permalink( $next_post->ID ); ?>" class="single-post-nav">
				<div class="media align-items-center">
					<h4 class="post-title"><?php echo get_the_title( $next_post->ID ) ?></h4>
				</div>
								<h3 class="post-nav-title icon-right"><i class="icon icon-arrow-right"></i> <?php esc_html_e( 'Next Post', 'seocify' ) ?></h3>

			</a>

			<?php
		endif;
		echo '</div></div></div></div>';
	}

endif;


/**
 * ----------------------------------------------------------------------------------------
 *  - Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'seocify_post_meta' ) ) {

	function seocify_post_meta() {
		$show_date = seocify_option('show_date');

		echo '<div class="entry-meta">';
			
		
		printf(
			'<span class="post-author"><a href="%1$s"><i class="icon icon-user"></i> %2$s</a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
		);
		$category_list = get_the_category_list( ', ' );
		if ( $category_list ) {
			echo '<span class="post-cat"><i class="icon icon-folders"></i>   ' . $category_list . ' </span>';
		}
		
		if ( comments_open() ) :
			echo '<span class="post-comments"><i class="icon icon-comment"></i> ';
			comments_popup_link( esc_html__( '0', 'seocify' ), esc_html__( '1', 'seocify' ), esc_html__( '%', 'seocify' ) );
			echo '</span>';
		endif;

		if ( get_post_type() === 'post' && $show_date && !is_single()) {
			echo '<span class="post-date"><strong>' . get_the_date('j') . '</strong>' . get_the_date('M') . '</span>';
		}


		 
		if ( get_post_type() === 'post' ) {
			// If the post is sticky, mark it.
			if ( !is_single() ) {
				$tag_list = get_the_tag_list( '', ', ' );
				if ( $tag_list ) {
					echo '<span class="tagcloud"><i class="icon icon-tags"></i> ' . $tag_list . ' </span>';
				}
			}
			if ( is_single() ) {
				// Edit link.
				if ( is_user_logged_in() ) {
					edit_post_link( esc_html__( 'Edit', 'seocify' ), '<span class="meta-edit"><i class="icon icon-pencil"></i> ', '</span>' );
				}
			}
		}
		echo '</div>';
	}

	if ( !function_exists( 'seocify_post_meta_left' ) ) {

		function seocify_post_meta_left() {

			echo '<div class="post-meta-left pull-left text-center"><div class="entry-meta">';
			if ( get_post_type() === 'post' ) {

				// Get the post author.

				// Comments link.
				if ( comments_open() ) :
					echo '<span class="post-comment"><i class="icon icon-comment"></i> ';
					comments_popup_link( esc_html__( '0', 'seocify' ), esc_html__( '1', 'seocify' ), esc_html__( '%', 'seocify' ) );
					echo '</span>';
				endif;

			// Edit link.
				if ( is_user_logged_in() ) {
					echo '<div>';
					edit_post_link( esc_html__( 'Edit', 'seocify' ), '<span class="meta-edit">', '</span>' );
					echo '</div>';
				}
			}
			echo '</div></div>';
		}

	}
}


if ( !function_exists( 'seocify_post_meta_date' ) ) {

	function seocify_post_meta_date() {
		if ( get_post_type() === 'post' ) {

			echo '<span class="post-date meta-date"><span class="day">' . get_the_date( 'm' ) . '</span>' . get_the_date( 'M' ) . '</span>';
		}
	}

}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xs
 */
/**
 * ----------------------------------------------------------------------------------------
 * 6.0 - Display navigation to the next/previous set of posts.
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'seocify_paging_nav' ) ) {

	function seocify_paging_nav() {


		if ( is_singular() )
			return;

		global $wp_query;

		/** Stop execution if there's only 1 page */
		if ( $wp_query->max_num_pages <= 1 )
			return;

		$paged	 = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max	 = intval( $wp_query->max_num_pages );

		/** 	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;

		/** 	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<ul class="pagination justify-content-center">' . "\n";

		/** 	Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link( '<i class="fa fa-long-arrow-left"></i>' ) );

		/** 	Link to first page, plus ellipses if necessary */
		if ( !in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';

			printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( !in_array( 2, $links ) )
				echo '<li>…</li>';
		}

		/** 	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/** 	Link to last page, plus ellipses if necessary */
		if ( !in_array( $max, $links ) ) {
			if ( !in_array( $max - 1, $links ) )
				echo '<li>…</li>' . "\n";

			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s" class="page-link">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/** 	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li>%s</li>' . "\n", get_next_posts_link( '<i class="fa fa-long-arrow-right"></i>' ) );

		echo '</ul>' . "\n";
	}

}
/**
 * Single post footer.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package xs
 */
/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - footer tags with social share
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists( 'seocify_single_post_footer' ) ) {

	function seocify_single_post_footer() {
		$show_social = seocify_option('show_social');
        $tag_list = get_the_tag_list( '', ' ' );
		if ( $tag_list || $show_social):
		if ( $tag_list ) {
			echo '<div class="post-tags"><span class="icon icon-tags"></span>';
			echo seocify_kses( $tag_list );
			echo '</div>' . "\n";
		}
		
		if(class_exists('Xs_Main') && ($show_social) ):
			?><div class="social-share"><?php
				$Xs_Main = Xs_Main::xs_get_instance();
				$Xs_Main->get_social_share();
			?></div><?php
        endif;

        endif;
	}

}

function seocify_xs_comment_style( $comment, $args, $depth ) {
	if ( 'div' === $args[ 'style' ] ) {
		$tag		 = 'div';
		$add_below	 = 'comment';
	} else {
		$tag		 = 'li ';
		$add_below	 = 'div-comment';
	}
	?>
	<<?php
	echo seocify_kses( $tag );
	comment_class( empty( $args[ 'has_children' ] ) ? '' : 'parent'  );
	?> id="comment-<?php comment_ID() ?>"><?php if ( 'div' != $args[ 'style' ] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php }
	?>	
		<?php
		if ( $args[ 'avatar_size' ] != 0 ) {
			echo get_avatar( $comment, $args[ 'avatar_size' ], '', '', array( 'class' => 'comment-avatar pull-left' ) );
		}
		?>
		<div class="meta-data">
			<div class="reply"><?php
				comment_reply_link(
				array_merge(
				$args, array(
					'add_below'	 => $add_below,
					'depth'		 => $depth,
					'max_depth'	 => $args[ 'max_depth' ]
				) ) );
				?>
			</div>


			<div class="comment-author">
				<p class="author"><?php echo get_comment_author_link(); ?></p>
                <p class="comment-date"><?php printf( esc_html__( '%1$s', 'seocify' ), get_comment_date()); ?></p>
			</div>
			<div class="comment-content">
				<?php comment_text(); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'seocify' ); ?></em><br/><?php }
			?>

			<div class="comment-meta commentmetadata comment-date">
				
				<?php edit_comment_link( esc_html__( '(Edit)', 'seocify' ), '  ', '' ); ?>
			</div>
		</div>	
		
		<?php if ( 'div' != $args[ 'style' ] ) : ?>
		</div><?php
	endif;
}

function seocify_link_pages() {
	$args = array(
		'before'			 => '<div class="page-links"><span class="page-link-text">' . esc_html__( 'More pages: ', 'seocify' ) . '</span>',
		'after'				 => '</div>',
		'link_before'		 => '<span class="page-link">',
		'link_after'		 => '</span>',
		'next_or_number'	 => 'number',
		'separator'			 => '  ',
		'nextpagelink'		 => esc_html__( 'Next ', 'seocify' ) . '<I class="fa fa-angle-right"></i>',
		'previouspagelink'	 => '<I class="fa fa-angle-left"></i>' . esc_html__( ' Previous', 'seocify' ),
	);
	wp_link_pages( $args );
}
