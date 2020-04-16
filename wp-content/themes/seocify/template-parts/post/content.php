<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
$blog_style = seocify_option( 'blog_style' );
if ( $blog_style == '1' ):
	?>

	<div <?php post_class( 'post-list ' ); ?>>

		<?php
		if ( get_post_format() == 'video' ):
			if ( defined( 'FW' ) ) {
				$video_url = fw_get_db_post_option( get_the_ID(), 'video_url' );
			} else {
				$video_url = '';
			}
			?><div class="post-image"><?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'post-thumbnail' );
			else:
				seocify_get_youtube_image( $video_url );
			endif;
			if ( $video_url != '' ):
				?><div class="post-image-content">
						<a href="<?php echo esc_url( $video_url ); ?>" class="xs-video-popup video-popup-btn pulse-effect">
							<i class="icon icon-play2"></i>
						</a>
					</div>
				<?php endif; ?>
			</div><?php
		elseif ( get_post_format() == 'audio' ):
			?><div class="post-media post-image"><?php
			if ( defined( 'FW' ) ) {
				$soundcloud_embed = fw_get_db_post_option( get_the_ID(), 'soundcloud_embed' );
			} else {
				$soundcloud_embed = '';
			}
			echo seocify_kses( $soundcloud_embed );
			?></div><?php elseif ( get_post_format() == 'gallery' ):
			if ( defined( 'FW' ) ) {
				$gallery_images = fw_get_db_post_option( get_the_ID(), 'gallery_images' );
			} else {
				$gallery_images = '';
			}
			if ( !empty( $gallery_images ) && $gallery_images != '' ):
				?>
				<div class="post-image">
					<div class="gallery-slider owl-carousel">
						<?php
						foreach ( $gallery_images as $gallery_image ) {
							?>
							<div class="single-item">
								<img src="<?php echo esc_url( $gallery_image[ 'url' ] ); ?>" alt="<?php esc_attr_e( 'blog list image', 'seocify' ); ?>">
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			else:

				if ( has_post_thumbnail() ) :
					?><div class="post-image"><?php
					the_post_thumbnail( 'post-thumbnail' );
					?></div><?php
				endif;
			endif;
		else:
			if ( has_post_thumbnail() ) :
				?><div class="post-image"><?php
					the_post_thumbnail( 'post-thumbnail' );
					?></div><?php
			endif;
		endif;
		?>
		<div class="post-body">
			<div class="entry-header">
				
				<?php
				if ( is_sticky() ) {
					echo '<span class="meta-featured-post sticky"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Featured', 'seocify' ) . ' </span>';
				}
				?>
								<?php seocify_post_meta(); ?>

				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php seocify_content_read_more( '35' ); ?>
			</div>
		</div>
	</div>

<?php else: ?>
	<div class="blog-grid-item">

		<div <?php post_class( 'single-blog-post-thumb' ); ?>>

			<?php
			if ( get_post_format() == 'video' ):
				if ( defined( 'FW' ) ) {
					$video_url = fw_get_db_post_option( get_the_ID(), 'video_url' );
				} else {
					$video_url = '';
				}
				?><div class="post-image"><?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'post-thumbnail' );
				else:
					seocify_get_youtube_image( $video_url );
				endif;
				if ( $video_url != '' ):
					?><div class="post-image-content">
							<a href="<?php echo esc_url( $video_url ); ?>" class="xs-video-popup video-popup-btn pulse-effect">
								<i class="icon icon-play2"></i>
							</a>
						</div>
					<?php endif; ?>
				</div><?php
			elseif ( get_post_format() == 'audio' ):
				?><div class="post-media post-image"><?php
				if ( defined( 'FW' ) ) {
					$soundcloud_embed = fw_get_db_post_option( get_the_ID(), 'soundcloud_embed' );
				} else {
					$soundcloud_embed = '';
				}
				echo seocify_kses( $soundcloud_embed );
				?></div><?php elseif ( get_post_format() == 'gallery' ):
				if ( defined( 'FW' ) ) {
					$gallery_images = fw_get_db_post_option( get_the_ID(), 'gallery_images' );
				} else {
					$gallery_images = '';
				}
				if ( !empty( $gallery_images ) && $gallery_images != '' ):
					?>
					<div class="post-image">
						<div class="gallery-slider owl-carousel">
							<?php
							foreach ( $gallery_images as $gallery_image ) {
								?>
								<div class="single-item">
									<img src="<?php echo esc_url( $gallery_image[ 'url' ] ); ?>" alt="<?php esc_attr_e( 'blog list image', 'seocify' ); ?>">
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				else:

					if ( has_post_thumbnail() ) :
						?><div class="post-image"><?php
						the_post_thumbnail( 'post-thumbnail' );
						?></div><?php
					endif;
				endif;
			else:
				if ( has_post_thumbnail() ) :
					?><div class="post-image"><?php
						the_post_thumbnail( 'post-thumbnail' );
						?></div><?php
				endif;
			endif;
			?>
			<div class="post-body">
				<div class="entry-header">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
						if ( is_sticky() ) {
							echo '<span class="meta-featured-post sticky"> <i class="fa fa-thumb-tack"></i> ' . esc_html__( 'Featured', 'seocify' ) . ' </span>';
						}
						?>
						<?php the_excerpt(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>