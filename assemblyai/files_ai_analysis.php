
<?php
error_reporting(0);
session_start();
include ('authenticate.php');


$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$username_sess =   htmlentities(htmlentities($_SESSION['owner_identity'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo'], ENT_QUOTES, "UTF-8"));

$title = strip_tags($_GET['title']);
$status = strip_tags($_GET['status']);
$transcript_id = strip_tags($_GET['transcript_id']);


include ('db_connect.php');

$del= $db->prepare('DELETE FROM sentiments where conversation_id=:conversation_id');
$del->execute(array(':conversation_id' => $transcript_id));


$del= $db->prepare('DELETE FROM entities where conversation_id=:conversation_id');
$del->execute(array(':conversation_id' => $transcript_id));



?>

<!DOCTYPE html>
<html lang="en">

<head>
 <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="landing page, website design" />


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script src="moment.js"></script>
	<script src="livestamp.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>




.section_padding {
padding: 60px 40px;
}

.imagelogo_li_remove {
list-style-type: none;
margin: 0;
 padding: 0;
}

.imagelogo_data{
 width:120px;
 height:80px;
}



  .navbar {
    letter-spacing: 1px;
    font-size: 14px;
    border-radius: 0;
    margin-bottom: 0;
   background-color:purple;

    z-index: 9999;
    border: 0;
    font-family: comic sans ms;
//color:white;
  }



  
.navbar-toggle {
background-color:orange;
  }

.navgate {
padding:16px;color:white;

}



.navgate:hover{
 color: black;
 background-color: orange;

}


.navbar-header{
height:60px;
}

.navbar-header-collapse-color {
background:white;
}

.dropdown_bgcolor{

background: #800000;
color:white;
}

.dropdown_dashedline{
 border-bottom: 2px dotted white;
}

.navgate101:hover{
background:800000;
color:white;

}






.category_post{
background-color: #800000;
padding: 16px;
color:white;
font-size:14px;
border-radius: 15%;
border: none;
cursor: pointer;
text-align: center;
width:100%;
z-index: -999;
}
.category_post:hover {
background: black;
color:white;
}	




.category_post1{
background-color: purple;
padding: 16px;
color:white;
font-size:14px;
border-radius: 15%;
border: none;
cursor: pointer;
text-align: center;
width:100%;
z-index: -999;
}

.category_post1:hover {
background: black;
color:white;
}	



</style>



 
</head>
<body>















<!--start left column all-->

    <div class="left-column-all left_shifting">

<!-- start column nav-->


<div class="text-center">
<nav class="navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navgator">
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span> 
        <span class="navbar-header-collapse-color icon-bar"></span>                       
      </button>
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img class="img-rounded imagelogo_data" src="logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">



      <ul class="nav navbar-nav navbar-right">


        <li class="navgate"><a href='dashboard.php' style='color:white'>Dashboard</a></li>
           <li class="navgate"><a href='logout.php' style='color:white'>Logout</a></li>
       
        
        



      </ul>


    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->



	
<br><br>
<div class="rows">

<h2 style='color:fuchsia'><center>Audio/Video Transcript AI Analysis  </center></h2>






<style>

.fcss{
padding: 10px;
  border: 2px solid #666;
  color: white;
  background-color: #800000;
}

.fcss:hover{
 color: black;
  background-color: orange;
}


.fcss1{
padding: 10px;
  border: 2px solid #666;
  color: white;
  background-color: purple;
}

.fcss1:hover{
 color: black;
  background-color: orange;
}



</style>



<style>
.point_count { color: #fff; display: block; float: right; border-radius: 12px; border: 1px solid #2E8E12; background: #ec5574; padding: 2px 6px;font-size:20px; }
.point_count1 { color:#FFF; display: block; float: right; border-radius: 12px; border: 1px solid #2E8E12; background: purple; padding: 2px 6px;font-size:20px; }


</style>

        <div class="content">

            <?php

include('db_connect.php');
$result = $db->prepare("SELECT * FROM posts where title_seo =:title_seo and transcript_id=:transcript_id order by id desc");
$result->execute(array(':title_seo' =>$title, ':transcript_id' =>$transcript_id ));


$count_post = $result->rowCount();
if($count_post ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Audio or Video Found.. <b></b></div>";
}






while ($row = $result->fetch()) {

$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$postid = $id;
$title = htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$title_seo = htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));
$content = $row['content'];
$username = htmlentities(htmlentities($row['username'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$userphoto = htmlentities(htmlentities($row['userphoto'], ENT_QUOTES, "UTF-8"));
$created_time = htmlentities(htmlentities($row['timer2'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer1'], ENT_QUOTES, "UTF-8"));
$post_userid = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));

$microcontent = substr($content, 0, 120)."...";
$transcript_status = htmlentities(htmlentities($row['transcript_status'], ENT_QUOTES, "UTF-8"));
$transcript_id = htmlentities(htmlentities($row['transcript_id'], ENT_QUOTES, "UTF-8"));
$file_url = htmlentities(htmlentities($row['file_url'], ENT_QUOTES, "UTF-8"));
$data_type = htmlentities(htmlentities($row['data_type'], ENT_QUOTES, "UTF-8"));


            ?>

                    <div class="post well">

<span class='point_count'><span><?php echo $data_type; ?> Transcription Status: </span> <?php echo $transcript_status; ?> </span>
<br>
<h3><?php echo $data_type; ?> Transcription Status: <?php echo $transcript_status; ?>   </h3><br>



<img class='' style='border-style: solid; border-width:3px; border-color:#800000; width:80px;height:80px; 
max-width:80px;max-height:80px;border-radius: 50%;' src='<?php echo $userphoto; ?>'><br>
<b style='color:#800000;font-size:18px;' >Owner: <?php echo $fullname; ?> </b><br>


<b class='title_css'>Title: <?php echo $title; ?></b><br>
<b >Descriptions:</b><br><?php echo $content; ?> ....<br>
<b ><?php echo $data_type; ?> Transcription ID:</b> <?php echo $transcript_id; ?> ....<br>
<b >File URL:</b> <?php echo $file_url; ?> ....<br>

<?php 
if($data_type == 'video'){
?>

<video style='float:left;width:100%;' width="420" height="340" controls>

  <source src="<?php echo $file_url; ?>" type="video/mp4">
  <source src="<?php echo $file_url; ?>" type="video/ogg">
  <source src="<?php echo $file_url; ?>" type="video/webm">
  Your browser does not support the video tag.
</video>
<br>
      
<?php
}
?>


<?php 
if($data_type == 'audio'){
?>

<video style='float:left;width:100%;' width="420" height="50" controls>

  <source src="<?php echo $file_url; ?>" type="audio/mpeg">
  <source src="<?php echo $file_url; ?>" type="audio/ogg">
  <source src="<?php echo $file_url; ?>" type="audio/webm">
  Your browser does not support the audio tag.
</video>
<br>
      
<?php
}
?>


<span style='color:#800000;'><b> Time: </b> <span data-livestamp="<?php echo $timer1;?>"></span></span> <br>



<br>



                 
</div>





            <?php

                }
            ?>



<!-- Main Post Database query ends here-->

</div>






</div>
<!--End Right-->

</div>
<!--Row-->













<div class="col-sm-1">

</div>

<div class="col-sm-10">


<script>

$(document).ready(function(){


		
var title = '<?php echo  $title; ?>';
var transcript_status = '<?php echo  $status; ?>';
var transcript_id = '<?php echo  $transcript_id; ?>';

if(transcript_id ==""){
alert('Audio/Video Transcription ID cannot be Empty');

}



else{

$('#loader_o').fadeIn(400).html('<br><div style="color:white;background:#3b5998;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Analyzing your  Audio/Video Files via AssemblyAI</div>');
var datasend = {title:title, transcript_status:transcript_status, transcript_id:transcript_id};	
		$.ajax({
			
			type:'POST',
			url:'files_ai_analysis_action.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){


                        $('#loader_o').hide();
				//$('#result_o').fadeIn('slow').prepend(msg);

$('#result_o').fadeIn('slow').html(msg);

			//$('#documents').val('');
			}
			
		});
		
		}
		
	
					
});



</script>







<!-- form starts  -->






<div class="form-group">

                    <br>
<div id="loader_o"></div>

<div id="result_o" class="myform_o"></div>
<br />
</div>







<br><br><br><br>

</div>



<!-- form ends  -->











</div>

<div class="col-sm-1">

</div>


<div>
   
<br><br><br><br><br>
</body>
</html>



















