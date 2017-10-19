<?php
add_action("after_switch_theme",function(){
	if(get_page_by_title( 'Contact Us' ) OR get_page_by_title( 'List Of All the Posts' ) OR get_page_by_title( 'Search' ) OR get_page_by_title( 'About Us' ) OR get_page_by_title( 'Games' ) OR get_page_by_title( 'Dictionary' )){
		return;
	}else{
		wp_insert_post(['post_title' =>'List Of All the Posts','post_status'=>'publish','post_name'=>'all-post-list','post_type'=>'page','page_template'=>'page_template_loader.php']);
		wp_insert_post(['post_title' =>'Contact Us','post_name'=>'contact','post_status'=>'publish','post_type'=>'page','page_template'=>'page_template_loader.php']);
		wp_insert_post(['post_title' =>'Search','post_name'=>'search','post_status'=>'publish','post_type'=>'page','page_template'=>'page_template_loader.php']);
		wp_insert_post(['post_title' =>'About Us','post_name'=>'about-us','post_status'=>'publish','post_type'=>'page','page_template'=>'page_template_loader.php']);
		wp_insert_post(['post_title' =>'Games','post_name'=>'games','post_status'=>'publish','post_type'=>'page','page_template'=>'page_template_loader.php']);
		wp_insert_post(['post_title' =>'Dictionary','post_name'=>'dictionary','post_status'=>'publish','post_type'=>'page','page_template'=>'page_template_loader.php']);
		return;
	}
});
?>