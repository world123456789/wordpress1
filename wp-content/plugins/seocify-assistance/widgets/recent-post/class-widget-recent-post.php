<?php
if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );

/**
 * Creates widget with recent post thumbnail
 */
class Seocify_recent_post extends WP_Widget {

	function __construct() {

		$widget_opt = array(
			'classname'		 => 'seocify_widget',
			'description'	 => esc_html__('Recent Post With Thumbnail','seocify')
		);

		parent::__construct( 'xs-recent-post', esc_html__( 'Seocify Recent Post', 'seocify' ), $widget_opt );
	}

	function widget( $args, $instance ) {

		global $wp_query;

		echo seocify_return($args[ 'before_widget' ]);

		if ( !empty( $instance[ 'title' ] ) ) {

			echo seocify_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . seocify_return($args[ 'after_title' ]);
		}

		if ( !empty( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}


		$query = array(
			'post_type'		 => array( 'post' ),
			'post_status'	 => array( 'publish' ),
			'orderby'		 => 'date',
			'order'			 => 'DESC',
			'posts_per_page' => $no_of_post
		);  

		$loop = new WP_Query( $query );
		?>
		<div class="widget-posts">
			<?php
			if ( $loop->have_posts() ): 
				while ( $loop->have_posts() ):
					$loop->the_post();
					?>
					<div class="widget-post media">
						<?php
							$thumbnail	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), '' );
							if(!empty($thumbnail)){
							$img  = fw_resize( $thumbnail[0], 70, 70, true );
							echo '<div class="post-thumb"><a href="'.get_the_permalink().'"><img src="' . esc_url( $img ) . '" alt="' . esc_attr__('thumb','seocify') . '"></a></div>';
							}
							?>
						<div class="media-body">
							<h5 class="entry-title">
								<a href="<?php echo get_the_permalink(); ?>" ><?php echo get_the_title();?></a>
							</h5>
							<span class="meta-date"><i class="icon icon-clock"></i> <?php echo get_the_date(); ?></span>
						</div>
					</div>

				<?php endwhile; ?>
			<?php else: ?>
				<div class="nopost_message">
					<p><?php echo esc_html__( 'No Post Available', 'seocify' ) ?></p>';
				</div>
			<?php endif; ?>  
			</div>
		<?php
		wp_reset_postdata();
		echo seocify_return($args[ 'after_widget' ]);
	}

	function update( $new_instance, $old_instance ) {

		$old_instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$old_instance[ 'number_of_posts' ] = $new_instance[ 'number_of_posts' ];

		return $old_instance;
	}

	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'Recent Posts', 'seocify' );
		}
		if ( isset( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'seocify' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php esc_html_e( 'Number Of Posts:', 'seocify' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $no_of_post ); ?>" />
		</p>
		<?php
	}

}
