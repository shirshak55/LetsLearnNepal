<?php
get_header();
function our_entrance_list($category){
	$query = new WP_Query(['post_type'=>'entrance','tax_query' => [['taxonomy' => 'objective_questions','field' => 'slug','terms' =>$category]]]);
	if( $query->have_posts() ) {
	    while ($query->have_posts()) : $query->the_post(); ?>
	        <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <small> <?php echo show_likes_count(get_the_ID())?> Likes /  <?php echo show_dislikes(get_the_ID())?> Dislikes <?php edit_post_link(' /  Edit'); ?> /  <?php comments_number('0 comment', 'One comments', '% comments' );?></small></li>
	<?php
	endwhile;}
	wp_reset_query();
}
?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/data/css/entrance.css" type="text/css"/>
<div class="page-wrap">
	<div class="entrance-wrapper module">
		<nav class="entrance-navi">
		        <div class="grid nopadding group">
					<ul class="top-navi group" id="top-navi">
					<li class="active"><a href="/entrance/Physics/">Physics</a>
					</li><li><a href="/entrance/Chemistry/">Chemistry</a>
					</li><li><a href="/entrance/Biology/">Biology</a>
					</li><li><a href="/entrance/Mathematics/">Mathematics</a>
					</li><li><a href="/entrance/IOE/">IOE</a>
					</li><li><a href="/entrance/IOM/">IOM</a>
					</li><li><a href="/entrance/KU/">KU</a>
					</li><li><a href="/entrance/bpharm/">B.Pharm</a></li>
					</ul>

					<div class="entrance-list  Physics" id="entrance-list">
						<ul class="Physics">
							<?php
								our_entrance_list("Physics");
							?>
						</ul>


						<ul class="Chemistry">
							<?php
								our_entrance_list("Chemsitry");
							?>
						</ul>

						<ul class="Biology">
							<?php
								our_entrance_list("Biology");
							?>
						</ul>


						<ul class="Mathematics">
							<?php
								our_entrance_list("Mathematics");
							?>
						</ul>


						<ul class="IOE">
							<?php
								our_entrance_list("IOE");
							?>
						</ul>


						<ul class="IOM">
							<?php
								our_entrance_list("IOM");
							?>
						</ul>


						<ul class="KU">
							<?php
								our_entrance_list("KU");
							?>
						</ul>
					</div>

		        </div>
		</nav>
	</div>
</div>
<script>
(function($){
	var snippetsTopNav = $("#top-navi > li"),
	    snippetsTopNavLinks = snippetsTopNav.find("a"),
	    listOfSnippets = $("#entrance-list"),
	    curClass = "Physics";
	if (snippetsTopNav.on("click", function(s) {
	    s.preventDefault();
	    var $this = $(this),
	        link = $this.find("a");
	    if (snippetsTopNavLinks.removeClass("active"), link.addClass("active"), newClass = $this.text(), listOfSnippets.removeClass(curClass).addClass(newClass), curClass = newClass, localStorage.setItem("snippetType", $this.attr("id")), $(window).width() < 600) {
	        var i = $("#entrance-list").position();
	        window.scrollTo(0, i.top);
	    }
	})) ;
	else {
	    var snippetPersist = localStorage.getItem("snippetType");
	    $("#" + snippetPersist).click();
	}
})(jQuery);
</script>
<?php 
get_footer(); 
?>