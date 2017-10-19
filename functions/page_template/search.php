<?php
/*
Template Name: Search Result
*/
get_header();
?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/data/css/search-results.css" type="text/css"/>
 
<div class="page-wrap">
	<div class="blogpost grid-1-1">
		<h2 class="search-results-title">Search Result <?php if(!empty($_GET["q"]))echo "for ".$_GET["q"];?></h2>

		<div class="module all-search-results">
			<div>
			  	<script>
			  (function() {
			    var cx = "<?php echo get_option( 'shirshak_theme_option' )['google_search']; ?>";
			    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
			    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
			        '//www.google.com/cse/cse.js?cx=' + cx;
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
			  })();
			</script>
			</div>
			<p><gcse:searchresults-only></gcse:searchresults-only> </p>
		</div>
		<br/><br/>
		<div class="veiw_all_button"><a href="/all-post-list" class="button">All News &#10140;</a> <a href="/all-post-list?type=note" class="button">All Notes &#10140;</a> <a href="/all-post-list?type=entrance" class="button">All Test &#10140;</a> <a href="/all-post-list?type=college" class="button">All College &#10140;</a></div>
	</div>
</div>
<?php 
get_footer(); 
?>