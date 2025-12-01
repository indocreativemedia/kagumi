<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kagumi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-12 col-sm-6 col-md-12 col-lg-6 col-xxl-4 pt-2 mb-4' ); ?>>
	<div class="h-100 pb-4 border-bottom">

		<?php kagumi_post_thumbnail(); ?>

		<header class="entry-header mb-3">
			<?php
				the_title(
					sprintf( '<h2 class="h3 entry-title"><a href="%s">', esc_url( get_permalink() ) ),
					(is_sticky() ? '</a>&#128204;</h2>' : '</a></h2>')
				);

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					kagumi_posted_on();
					kagumi_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="clearfix"></div>

		<footer class="entry-footer mb-2">
			<?php kagumi_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
