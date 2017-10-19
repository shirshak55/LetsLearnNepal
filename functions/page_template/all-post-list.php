<?php
/*
Template Name: All Post List
*/
?>
<?php 
get_header();
$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : "post";
$order=isset($_GET['order']) ? htmlspecialchars($_GET['order']) : "ASC";
if(!empty($order)){if($order=="ASC"){$orderlink="DESC";}else{$orderlink="ASC";}};
$orderby=isset($_GET['orderby']) ? htmlspecialchars($_GET['orderby']) : "date";
?>

<style type="text/css">
.main-post{
margin-bottom:10px!important;
}
.all-post{
padding-right:30px;
}
.table {
border-collapse: collapse;
border-spacing: 0;
width: 100%;
margin: 0 0 20px 0;
position:relative;
}
.table tbody{
display:block;
}
.table td {
padding: 20px;
}
table th, table td {
border: 1px solid #aaa;
padding: 5px;
}
.post h2{
margin-top:0!important;
}
.post td p{
  font-size:75%;
  color:#999;
}
p br,.rmorelink{
  display:none!important;
}
.btr td{
background:#DFF7F3;
}
.odd .palegreen{
  background:#E6D4EF;
}
.paleblue{
  background:#72D3DE;
}
.paleyellow{
  background: #F1EE77;
}
.lightgreen{
  background:lightgreen;
}
</style>



<!-- Grid group -->
<div class="grid group">

<!-- Blogpsot -->
<div class="blogpost grid-1-1">

<!-- Table with Module -->
<table class="table module" >
<tbody>

<tr class="btr">

<td><h2 style="color:#200CAF;"><a href="?type=<?php echo $type;?>&order=<?php echo $orderlink;?>&orderby=title">Our Topics<a></h2></td>
<td>Post Veiw</td>
<td><a href="?type=<?php echo $type;?>&order=<?php echo $orderlink;?>&orderby=comment_count">Comments<a></td>
<td><a href="?type=<?php echo $type;?>&order=<?php echo $orderlink;?>&orderby=date">Published Date<a></td>

</tr>


<?php
$j=0;
$args = array( 'post_type' => $type, 'posts_per_page' =>50,'order'=>$order,"orderby"=>$orderby);
$wp_query = new WP_Query($args);
while ( have_posts() ) : the_post(); ?>
                                        
                                                 <tr class="<?php echo (++$j % 2) ? "odd" : "even"; ?>">
                                                            <td class="palegreen">
                                                            <h2 class="blogpost-heading"><a id="article-anchors" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                                                      <?php the_title(); ?>
                                                              </a></h2>
<?php //the_advanced_excerpt('length=20&use_words=1&no_custom=0&read_more=0&allowed_tags=0'); ?>
                                                              
                                                           </td>
                                                           <td class="paleblue" >
                                                            <?php echo 0; ?> views
                                                           </td>
                                                           
                                                           <td  class="paleyellow">
                                                           <?php comments_number("0 Comment", 'One comments', '% comments' );?>
                                                              </td>
             
                                                           <td class="lightgreen">
                                                           <?php echo get_the_date();?>
                                                           </td>

                                                  <tr>
                                        
<?php endwhile; ?>

</tbody>
</table>

<!-- Paginate This Page -->
  <?php 
  if (function_exists("pbt_paginate")) {
      pbt_paginate();
  } 
  ?>
<!-- /Out the Paginaion -->

</div>
<!-- /Blogpost -->


</div>
<!-- /Grid Group -->



<?php 
get_footer(); 
?>