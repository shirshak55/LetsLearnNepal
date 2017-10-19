<?php
/*
Template Name: Contact
*/
$errors=[];
if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
	$formdata=[];
	foreach ( $_POST as $field => $value ) {
		if ( get_magic_quotes_gpc() ) {
		    $value = stripslashes( $value );
		}
		$form_data[$field] = strip_tags( $value );
	}
    extract($form_data);
    if(empty($contact_user_email_address)){
    	$errors[]="You forgot to enter email address";
    }else{
    	if(!is_email($contact_user_email_address)){
    		$errors[]="Invalid Email Supplied.";
    	}
    }
    if(empty($contact_user_name)){
    	$errors[]="You forgot to enter username";
    }
    if(empty($contact_user_subject)){
    	$errors[]="You forgot to enter subject.";
    }
    if(empty($contact_user_message)){
    	$errors[]="You forgot to enter your message.";
    }
    if(count($errors)==0){
	    $email_subject = "[" . get_bloginfo( 'name' ) . "] " . $contact_user_subject;
	    $email_message = $contact_user_message . "\n\nIP: " . get_client_ip();
	    $headers  = "From: " . $contact_user_name . " <" . $contact_user_email_address . ">\n";
	    $headers .= "Content-Type: text/plain; charset=UTF-8\n";
	    $headers .= "Content-Transfer-Encoding: 8bit\n";
	    if(wp_mail( get_option( "admin_email", "bloggervista@gmail.com" ), $email_subject, "From: " . $contact_user_name . " {$contact_user_name} : <" . $contact_user_email_address . ">\n".$contact_user_message, $headers )){
	    	$sucess=true;
	    };
	   
    }
}
get_header();
?>
<div class="page-wrap">
	<div class="grid-2-3">
		<div class="module">
			<?php 
			if(have_posts()):while(have_posts()):the_post(); 
			?>
				<h1>Contact Us</h1>
				<blockquote>Suggestions are highly appreciated. If you have any problem we suggest you to remain in touch with us.</blockquote>
				<?php if(count($errors)>0):echo "<blockquote class='red'><ul>";foreach($errors as $error)echo "<li>{$error}</li>";echo "</ul></blockquote>";endif;?>
				<?php the_content(); ?>
				<?php if(!empty($sucess)):echo "<div class='explanation'>Your message has been sent. Check your email time to time</div>";
				else: ?>
					<form action="" class="respond" method="post">
						<div class="form-input">
			                <label for="contact_user_name">Your Full Name: </label>
			                <input class="full-width" type="text" name="contact_user_name" id="contact_user_name" value="<?php echo !empty($contact_user_name)?$contact_user_name:"";?>" >
			            </div>
			            <div class="form-input">
			                <label for="contact_user_email_address">Your Email Address: </label>
			                <input class="full-width" type="text" name="contact_user_email_address" id="contact_user_email_address" value="<?php echo !empty($contact_user_email_address)?$contact_user_email_address:"";?>">
			            </div>
			            <div class="form-input">
			                <label for="contact_user_subject">Subject: </label>
			                <input class="full-width" type="text" name="contact_user_subject" id="contact_user_subject" value="<?php echo !empty($contact_user_subject)?$contact_user_subject:"";?>">
			            </div>
			            <div class="form-input">
			                <label for="contact_user_message">Your Message</label>
			                <textarea class="full-width" type="text" name="contact_user_message" id="contact_user_message" ><?php echo !empty($contact_user_message)?$contact_user_message:"";?></textarea>
			            </div>
			            <input type="submit" class="button" name="submit">
					</form>
				<?php endif;?>
			<?php endwhile;endif; ?>
		</div>
	</div>
	<?php get_sidebar();?>
</div>
<?php get_footer(); ?>