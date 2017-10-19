<div style="clear:both"></div>
<script src="<?php echo esc_url( get_template_directory_uri()); ?>/data/js/love.js" type="text/javascript"></script>
<footer>
  <div class="blog-footer site-footer footer-slogan">
    <?php include (get_template_directory() . "/functions/template_includes/separator.php"); ?>
    <!--  Stuff -->
    <?php wp_footer(); ?>
    <!-- /Stuff -->
    <div class="footerwrap">


      <div class="copyright">
        <a href="/privacy-policy">Privacy Policy</a> | 
        <?php if ( !is_user_logged_in() ): ?>
          <a href="/login" class="login_button">Login</a> |
          <a href="/register" class="registration_button">Register</a> |
        <?php endif;?>
        <a href="/contact" class="registration_button">Contact</a>
      </div>
      <div class="copyright">Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>, All Rights Reserved  | 
      <?php $statcounter=get_option('shirshak_theme_option')['statcounter'];if(!empty($statcounter)) echo html_entity_decode($statcounter); ?></div>
    </div>
  </div>
</footer>

</div>
<!-- /Layout -->
<?php
if ((get_option('shirshak_theme_option') ["google_analytics"]) == true and !is_admin()): ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo get_option('shirshak_theme_option') ["google_analytics"] ?>', 'auto');
  ga('send', 'pageview');

</script>
<?php
endif; ?>

</body>
</html>