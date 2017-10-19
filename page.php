<?php  get_header();?>
<div class="page-wrap">
	<div class="blog-posts grid-2-3">
		<?php if(have_posts()):while(have_posts()):the_post();?>
			<article <?php echo post_class("module"); ?>  id="<?php the_ID(); ?>">
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

				<?php the_content(); ?>
				<div style="clear:both"></div>

				<?php
						if( function_exists( 'show_likes_dislikes' ) ) {
							echo show_likes_dislikes( get_the_ID() );
						}
					?>

				<?php numbered_in_page_links(); ?>
			</article>

		<?php endwhile;endif;comments_template(); ?>  
	</div>
	<?php get_sidebar();?>
</div>
<?php get_footer(); ?>