<?php
error_reporting(0);
session_start();
include ('authenticate.php');


$userid_sess =  htmlentities(htmlentities($_SESSION['uid'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8"));
$username_sess =   htmlentities(htmlentities($_SESSION['owner_identity'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo'], ENT_QUOTES, "UTF-8"));


?>


<!DOCTYPE html>
<html lang="en">

<head>
 <title>- Welcome <?php echo htmlentities(htmlentities($fullname_sess, ENT_QUOTES, "UTF-8")); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="landing page, website design" />


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
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

        <li class="navgate about_click">Audio-Video Transcript AI</li>
       
       
        
             
<li class="navgate"><img style="max-height:60px;max-width:60px;" class="img-circle" width="60px" height="60px" src="<?php echo htmlentities(htmlentities($_SESSION['photo'], ENT_QUOTES, "UTF-8")); ?>" width="80px" height="80px">


<span class="dropdown">
  <a style="color:white;font-size:14px;cursor:pointer;" title='View More Data' class="btn1 btn-default1 dropdown-toggle"  data-toggle="dropdown"><?php echo htmlentities(htmlentities($_SESSION['fullname'], ENT_QUOTES, "UTF-8")); ?>
  <span class="caret"></span></a>

<ul class="dropdown-menu col-sm-12">
<li><a title='Logout' href="logout.php">Logout</a></li>

</ul></span>

</li>
        
<li class="navgate"><a title='Logout' href="logout.php">Logout</a></li>


      </ul>


    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->



	
<br><br><br>
<div class="rows">

<h2 style='color:fuchsia'><center>Audio-Video Transcript AI  </center></h2>
<h4><center><b style='color:#800000'> Powered by AssemblyAI
</b></center></h4>



<div class="row">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalx">Add Audio/Video File URL</button>

  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Upload Audio/Video Files</button>

</div><br>





<br>




<div class="col-sm-1">

</div>

<div class="col-sm-10">

<script>

$(document).ready(function(){
$('#documents_btn').click(function(){
		
var audio_url = $('#audio_url').val();
var title = $('#title').val();
var description = $('#description').val();

if(audio_url==""){
alert('Please Enter Audio Url Link.');

}

else if(title==""){
alert('Please Enter Audio/Video Title.');

}

else if(description ==""){
alert('Please Enter Audio/Video description.');

}

else{

$('#loader_o').fadeIn(400).html('<br><div style="color:white;background:#3b5998;padding:10px;"><img src="ajax-loader.gif">&nbsp;Please Wait, Processing Your Files Transcription via AssemblyAI</div>');
var datasend = {audio_url:audio_url, title:title, description:description};	
		$.ajax({
			
			type:'POST',
			url:'audio_video_url_process.php',
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
		
	})
					
});




</script>





  <!-- Modalx Start -->
<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModalx" role="dialog">
    <div class="modal-dialog">
    <br><br><br><br>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Audio/Video File URL For Transcriptions</h4>
        </div>
        <div class="modal-body">

          <p>



<!-- form starts  -->


<div class="col-sm-12 form-group" style='background:#f1f1f1; padding:16px;color:black'>
<label>Enter Your Audio or Video URL(Formats Eg. Ogg, wav, mp3, mp4, webm. etc)<br>

Sample Files: <br>
1.)&nbsp;&nbsp;&nbsp;&nbsp; https://fredjarsoft.com/audio_sample.mp3 
<br> 2.) &nbsp;&nbsp;&nbsp;&nbsp; https://fredjarsoft.com/video_sample1.webm ) </label>


<input type="text" name="audio_url" id="audio_url" class="form-control audio_url" placeholder="Enter Audio Url" value="https://fredjarsoft.com/audio_sample.mp3">


            </div>




<div class="col-sm-12 form-group">
<label>Audio/Video Title</label>
<input  class="form-control contact_input_color" id="title" name="title" placeholder="Audio/Video Title" type="text" value="Your Audio/Video Title Goes here" required>
</div>



<div class="col-sm-12 form-group">
<label>Audio/Video Description</label>
<textarea  class="form-control contact_input_color" id="description" name="description" placeholder="Audio/Video Description"  required>Your Audio/Video Description Goes here</textarea>
</div>



<div class="form-group">

                    <br>
<button type="button" id="documents_btn" class="fcss1"  >Submit</button><br><br>
<div id="loader_o"></div>

<div id="result_o" class="myform_o"></div>
<br />
</div>


</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

  <!-- Modalx ends -->











<!--start form 2-->

<script>






            $(function () {
                $('#post_btn').click(function () {
                    var file_fname = $('#file_content').val();
                    

var title = $('#title2').val();
var description = $("#description2").val();


if(title==""){
alert('Audio/Video Title cannot be Empty');
//return false;
}


else if(description==""){
alert('Audio/Video Description cannot be Empty');
//return false;
}

else if(file_fname==""){
alert('Files Uploads cannot be Empty');
//return false;
}

else{

var fname=  $('#file_content').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["wav", "WAV", "mp3", "MP3", "mp4", "MP4", "webm", "WEBM", "ogg", "OGG"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid files');
}else{
alert("Please Upload a Valid Video. Only Wav, Mp3, Webm, MP4, OGG Files Formats are allowed..");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('title', title);
          form_data.append('description', description);
                    $('.upload_progress').css('width', '0');
                    $('#btn').attr('disabled', 'disabled');
                    $('#loader').fadeIn(400).html('<br><span class="well" style="color:black"><img src="ajax-loader.gif">&nbsp;Please Wait, Your Audio/Video is being Submitted</span>');
                    $.ajax({
                        url: 'audio_video_file_process.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress').css('width', upload_percent + '%');
                                    $('.upload_progress').text(upload_percent + '%');

                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
                                $('#box').val('');
				$('#loader').hide();
				$('.result_data').fadeIn('slow').prepend(msg);
				$('#alertdata_uploadfiles').delay(5000).fadeOut('slow');
                                $('#alerts_reg').delay(5000).fadeOut('slow');
                                $('#alertdata_uploadfiles2').delay(20000).fadeOut('slow');
                                $('#save_btn').removeAttr('disabled');


//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_fname').val('');
$('#title2').val('');
$('#description2').val('');

window.location='dashboard.php';
}




                        }
                    });
} // end if validate
                });
            });



</script>
<style>
.upload_progress{
padding:10px;
background:green;
color:white;
cursor:pointer;
min-width:30px;
}

#imageupload_preview
{
max-height:200px;
max-width:200px;
}
</style>
 


  <!-- Modal Start -->
<div class="container">


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <br><br><br><br>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Audio/Video For Transcriptions</h4>
        </div>
        <div class="modal-body">

          <p>
<div class="col-sm-12 form-group">
<label>Audio/Video Title</label>
<input  class="form-control contact_input_color" id="title2" name="title2" placeholder="Audio/Video Title" type="text" required>
</div>



<div class="col-sm-12 form-group">
<label>Audio/Video Description</label>
<textarea  class="form-control contact_input_color" id="description2" name="description2" placeholder="Audio/Video Description"  required></textarea>
</div>



<div class="form-group">
<label style="">Select Audio or Video: (Allowed Video Formats: Wav, Mp3, MP4, Webm and Ogg) </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" />
 
</div>

<br>




                    <div class="form-group">
                            <div class="upload_progress" style="width:0%">0%</div>

                        <div id="loader"></div>
                        <div class="result_data"></div>
                    </div>

<button type="button" id="post_btn" class="fcss1" /> Submit</button>
</div>





</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

  <!-- Modal ends -->





<!--end form 2-->






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
$result = $db->prepare("SELECT * FROM posts where username =:username and userid=:userid order by id desc");
$result->execute(array(':username' =>$username_sess, ':userid' =>$userid_sess ));


$count_post = $result->rowCount();
if($count_post ==0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Audio or Video Added Yet.. <b></b></div>";
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

<button class='readmore_btn btn btn-primary'><a title='Run <?php echo $data_type; ?> AI Transcription Analysis' style='color:white;' 
target="blank" href='files_ai_analysis.php?title=<?php echo $title_seo; ?>&status=<?php echo $transcript_status; ?>&transcript_id=<?php echo $transcript_id; ?>'>Run <?php echo $data_type; ?> AI Transcription Analysis Via AssemblyAI</a></button>



                 
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



















