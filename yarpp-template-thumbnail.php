<?php
/*
YARPP Template: Thumnbail
Description: Show notes with their thumbnails
Author: Shirshak Bajgain
*/ ?>
<h3>Read This Also:</h3>
<?php if (have_posts()):?>
<div class="related-post-wrap">
    <?php while (have_posts()) : the_post(); ?>
    	<div class="related-post">
			<?php if (has_post_thumbnail()):?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
			        <div class="related-post-thumbnail"><?php the_post_thumbnail(); ?></div>
			        <div class="related-post-caption"><small><?php the_title(); ?></small></div>
			    </a>
	        <?php else:?>
        		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><small><?php the_title(); ?></small></a>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
</div>
<?php else: ?>
<?php endif; ?>
<div style="clear:both"></div>