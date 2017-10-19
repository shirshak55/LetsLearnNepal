<?php get_header(); ?> 
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/data/css/entrance.css" type="text/css"/>
<link href="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.css" type="text/css" rel="stylesheet" />

<div class="page-wrap">
	<div class="grid-2-3">
		<?php if(have_posts()):while(have_posts()):the_post(); ?>
			<article class="module"  id="<?php the_ID(); ?>">     
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2> 
					
					<?php 
if (! function_exists('array_column')) {
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}
if(empty($_GET["exam"])):?>
<?php require(get_template_directory()."/functions/template_includes/informations.php");?>
	<hr/>
	<?php the_content();?>
	<a href="?exam=start" class="button">Start Exam</a>
<?php else:?>

<?php
global $post;
$table_name=$wpdb->entrance_result;
$post_id=$post->ID;
$errors=[];
$alphabets=str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ");

$question_info_array = get_field( 'questions' ,$post_id);
$entrance_pass_mark = get_field( 'pass_marks' ,$post_id);
$no_of_question_to_show = get_field( 'number_of_question_to_show_per_page' ,$post_id);
$login_compulsary=get_field( 'login_compulsory' ,$post_id);
$entrance_randomize_question_each_time=get_field( 'random_question' ,$post_id);
$mathjax_enabled = get_field( 'math_jax' ,$post_id);
$entrance_all_question_compulsary=get_field( 'make_all_questions_compulsory' ,$post_id);
$entrance_time=get_field( 'time' ,$post_id);
$entrance_time=strtotime("1970-01-01 $entrance_time UTC");
if(count($question_info_array)>0):
	$correct_answers=array_column($question_info_array,'correct_answers');
	$marks=array_column($question_info_array,'marks');
	$solution=array_column($question_info_array,'solution');

	$total_question=count($correct_answers);
	$total_marks=array_sum($marks);
else:
	$errors["questions"]="No questions available";
endif;


if($login_compulsary=="Yes") if(!is_user_logged_in()) $errors["login"]="User must be logged in to give this test.";
if(!empty($_POST)):
	if(empty($_POST["user_answer"]))$errors["submission"]="You need to at least select one the option before submitting.";
	if($entrance_all_question_compulsary=="Yes") if(count($question_info_array)!=count($_POST["user_answer"])) $errors["submission"]="All the Questions are compulsary.";;
endif;

if(!empty($_POST["exam_result"]) AND !empty($_POST["user_answer"]) AND count($errors)==0):
	$candidate_attempted_question=count($_POST["user_answer"]);
	$candidate_correct_answer_qn=[];
	$candidate_incorrect_answer_qn=[];
	$candidate_missed_question_qn=[];
	$candidate_marks=0;
	foreach($correct_answers as $qn=>$correct_answer):
		if(isset($_POST["user_answer"][$qn])){
			if($_POST["user_answer"][$qn]==$correct_answer){
				$candidate_correct_answer_qn[]=$qn;
				$candidate_marks=$candidate_marks+$marks[$qn];
			}else{
				$candidate_incorrect_answer_qn[]=$qn;
			}
		}else{
			$candidate_missed_question_qn[]=$qn;
		}
	endforeach;
	$show_results=true;

	$no_of_correct_answer=count($candidate_correct_answer_qn);
	$no_of_incorrect_answer=count($candidate_incorrect_answer_qn);
	$no_of_missed_answer=count($candidate_missed_question_qn);
	$percent=round($candidate_marks/$total_marks*100 ,2);

	if(is_user_logged_in()):
		$data=['user_id'=>get_current_user_id(),
				'post_id'=>$post_id,
				 'ip_address'=>get_client_ip(), 
				 'full_marks'=>$total_marks,  
				 'pass_marks'=>$entrance_pass_mark,  
				 'obtained_marks'=>$candidate_marks, 
				 'percentage'=>$percent, 
				 'no_attempted_question'=>$candidate_attempted_question,
				 'started_time'=>time(), 
				 'end_time'=>time()-$entrance_time, 
				 'correct_questions'=>serialize($candidate_correct_answer_qn),
				 'incorrect_questions'=>serialize($candidate_incorrect_answer_qn),
				 'missed_questions'=>serialize($candidate_missed_question_qn), 
			];
		$inserted = $wpdb->insert($table_name,$data,["%d","%d","%s","%d","%d","%d","%d","%d","%d","%d","%s","%s","%s"]);
		if( $inserted ){
		    $insert_id = $wpdb->insert_id;
		    //wp_redirect( get_site_url()."/result/".$insert_id);exit;
		 }else{
		    $error["database"]="There is problem ! we don't know ! Contact admin for more info.";
		 }
	endif;
	
endif;
?>
<?php if(count($errors)>0) echo "<div class='explanation red'><ul><li>".implode("</li><li>",$errors)."</li></ul></div>";?>
<?php if(empty($errors["login"]) AND !isset($show_results) AND empty($errors["questions"])):?>

<div class="h5">Time Left: <span class="timer" data-seconds-left="<?php $entrance_time=get_field( 'time',$post_id );echo strtotime("1970-01-01 $entrance_time UTC");?>"></span></div>
<hr>
<form class="questions-form" method="post">
	<div  id='current_page' class="screen-reader-text"></div>  
	<div  id='show_per_page' class="screen-reader-text"> </div>
	<div class="question_lists">
		<?php foreach($question_info_array as $question_number=>$question_info):?>
			<div class="question_loop">
				<?php if(!empty($question_info["hints"])):?>
				<a href="#" class="hint_link" data-featherlight="#hint_<?php echo $question_number;?>">Hint</a>
				<div id="hint_<?php echo $question_number;?>" class="hide"><?php echo $question_info["hints"];?></div>
				<?php endif; ?>

				<div style="clear:both;"></div>
				<div class="h5"><strong>Q.N. <?php echo $question_number+1;?>: <?php echo $question_info["question"]; ?></strong></div>
				<div class="answers">
					<?php 
					
					for($i=0;$i<count($question_info["answers"]);$i++){?>
						<div class="answer_input"><input type="checkbox" value="<?php echo $i; ?>" id="answer_<?php echo $question_number?>_<?php echo $i;?>"  name="user_answer[<?php echo $question_number;?>][]" >
						<?php echo "<label  class='answer_label' for='answer_{$question_number}_{$i}'>".$alphabets[$i].". ".$question_info["answers"][$i]["answer"]."</label>";?></div class="answer_selection"> 
					<?php }?>
				</div>
				<hr>
				</div>	
		<?php endforeach;?>
	</div>
	<div class="page_navigation pbt-paginate"></div>
	<input type="submit" class="button" name="exam_result">
</form>
<?php endif;?>

<?php if(empty($errors) and isset($show_results)):?>

	<p>You scored <span class="h5"><?php echo $percent; ?> %</span> </p>
	<table>
		<th>S.N.</th><th>Topic</th><th>Value</th>
		<tr><td>1</td><td>Total Percentage you secured </td><td style="color:green;"><b><?php echo $percent;?> %<b></td></tr>
		<tr><td>2</td><td>Total number of questions attempted</td><td><?php echo $candidate_attempted_question;?></td></tr>
		<tr><td>3</td><td>Total number of incorrect answer</td><td><?php echo $no_of_incorrect_answer ?></td></tr>
		<tr><td>4</td><td>Total number of correct answer</td><td><?php echo $no_of_correct_answer; ?></td></tr>
		<tr><td>5</td><td>Total number of questions you left</td><td><?php echo $no_of_missed_answer;?></td></tr>
		<tr><td>6</td><td>Full marks</td><td><?php echo $total_marks;?></td></tr>
		<tr><td>7</td><td>Total obtained marks</td><td><?php echo $candidate_marks;?></td></tr>
	</table>

	<?php if(!empty($candidate_incorrect_answer_qn)):?>
		<h3>Questions you made a mistake</h3>
		<hr/>
			<?php foreach($candidate_incorrect_answer_qn as $question_number):;?>
				<div class="question_loop">
					<div class="question">
						<?php if(!empty($question_info_array[$question_number]["hints"])):?>
						<a href="#" class="hint_link" data-featherlight="#hint_<?php echo $question_number;?>">Hint</a>
						<div id="hint_<?php echo $question_number;?>" class="hide"><?php echo $question_info_array[$question_number]["hints"];?></div>
						<?php endif; ?>
			
						<?php if(!empty($question_info_array[$question_number]["solution"])):?>
						<a href="#" class="solution_link" data-featherlight="#solution_<?php echo $question_number;?>">Solution</a>
						<div id="solution_<?php echo $question_number;?>" class="hide"><?php echo $question_info_array[$question_number]["solution"];?></div>
						<?php endif; ?>
						<div class="h5 question"><?php echo $question_number+1; ?>.<?php echo $question_info_array[$question_number]["question"];?></div>
						<div class="answers">
							<?php for($i=0;$i<count($question_info_array[$question_number]["answers"]);$i++){?>
								<div class="answer_label <?php if(in_array($i,$_POST["user_answer"][$question_number]))echo "user_selected_answer"; ?> <?php if(in_array($i,$question_info_array[$question_number]["correct_answers"]))echo "correct_answer"; ?>"><?php echo $alphabets[$i].". ".$question_info_array[$question_number]["answers"][$i]["answer"];?> </div>
							<?php }?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		
		<div style="clear:both"></div>
	<?php endif;?>

	<?php if(!empty($candidate_missed_question_qn)):?>
		<div class="question_lists">
				<div  id='current_page' class="screen-reader-text"></div>  
				<div  id='show_per_page' class="screen-reader-text"> </div>
			<h3>Questions you left</h3>
			<hr/>
				<?php foreach($candidate_missed_question_qn as $question_number):?>
					<div class="question_loop">
						<div class="question">
							<?php if(!empty($question_info_array[$question_number]["hints"])):?>
							<a href="#" class="hint_link" data-featherlight="#hint_<?php echo $question_number;?>">Hint</a>
							<div id="hint_<?php echo $question_number;?>" class="hide"><?php echo $question_info_array[$question_number]["hints"];?></div>
							<?php endif; ?>

							<?php if(!empty($question_info_array[$question_number]["solution"])):?>
							<a href="#" class="solution_link" data-featherlight="#hint_<?php echo $question_number;?>">Solution</a>
							<div id="solution_<?php echo $question_number;?>" class="hide"><?php echo $question_info_array[$question_number]["solution"];?></div>
							<?php endif; ?>

							<div class="h5 "><?php echo $question_number+1; ?>.  <?php echo $question_info_array[$question_number]["question"];?></div>
							<div class="answers">
								<?php for($i=0;$i<count($question_info_array[$question_number]["answers"]);$i++){?>
									<div class="answer_label <?php if(in_array($i,$question_info_array[$question_number]["correct_answers"]))echo "correct_answer"; ?>"><?php echo $alphabets[$i].". ".$question_info_array[$question_number]["answers"][$i]["answer"];?> </div>
								<?php }?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<div style="clear:both"></div>
		</div>
		<div class="page_navigation pbt-paginate"></div>
	<?php endif;?>

	<?php if(!empty($candidate_correct_answer_qn)):?>
		<h3>Questions you made correct</h3>
		<hr/>
		<?php foreach($candidate_correct_answer_qn as $question_number):?>
			<div class="question_loop">
				<div class="question">
					<div class="h5 question"><?php echo $question_number+1; ?>.  <?php echo $question_info_array[$question_number]["question"];?></div>
					<div class="answers">
						<?php foreach($question_info_array[$question_number]["correct_answers"] as $correct_answers){?>
							<div class="answer_label correct_answer"><?php echo  $question_info_array[$question_number]["answers"][$correct_answers]["answer"];?> </div>
						<?php }?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		<div style="clear:both"></div>
	<?php endif;?>
	
<?php endif;?>

<script>
	get_show_per_page=<?php echo $no_of_question_to_show ;?>;
</script>

<?php endif; ?> 

			</article>
		<?php endwhile;endif;?>  
	</div>
	<?php get_sidebar();?>
</div>

<script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo  get_template_directory_uri(); ?>/data/js/timer.js"></script>
<script src="<?php echo  get_template_directory_uri(); ?>/data/js/entrance.js"></script>

<?php get_footer(); ?>