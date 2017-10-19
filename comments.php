<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
	<?php die('You can not access this page directly! Trollers are supposed to stay away huh?'); ?>
<?php endif; ?>
<?php if(!empty($post->post_password)) : ?>
	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
		<p class="explanation">Post is password procted .For security you need to enter your password. If nothing work try logout and login .</p>
	<?php endif; ?>
<?php endif; ?>

<div class="comment-wrap">
	<?php if ( comments_open() ) : ?>
		<h4 class="comment_count"><span aria-hidden="true" data-icon="9"></span><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h4>

		<?php if ( have_comments() ) : ?>
			<ol class="list_of_comments">
				<?php 
				wp_list_comments('callback=advanced_comment');
				?>
			</ol>
		<?php endif; ?>
		
		<div class="respond" id="respond">
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="group comment-form">
				<div class="cancel-comment-reply">
					<small><?php cancel_comment_reply_link(); ?></small>
				</div>
				 
				<?php if ( is_user_logged_in() ) : ?><?php else : ?>
					<div class="form-input">
						<label for="author" class="image-replace signin-username">Name*</label>
						<input  type="text" name="author" id="author" class="full-width paddingleft50" placeholder="Your Name" class="infoput" value="<?php echo esc_attr($comment_author); ?>" <?php if ($req) echo "aria-required='true'"; ?> />
					</div>
					<div class="form-input">
						<label for="email" class="image-replace signin-email">Email*</label>
						<input  type="text" name="email" id="email" class="full-width paddingleft50" placeholder="Email Address" value="<?php echo esc_attr($comment_author_email); ?>" <?php if ($req) echo "aria-required='true'"; ?> />
					</div>
				<?php endif; ?>
				<div class="comment-wrap">
					<textarea name="comment" class="full-width write-comment"  placeholder="Enter your thoughts,comments,questions etc.."></textarea>
				</div>
				<input name="submit" type="submit" class="button" id="submit" value="Submit Comment">
				<?php comment_id_fields();do_action('comment_form', $post->ID); ?>
			</form>
		</div>
	<?php else : // comments are closed ?>
		<p class="nocomments explanation">Sorry , Due to security reason comments are closed. If you have any problem you can easily contact us using contact form .</p>
	<?php endif; ?>
</div>