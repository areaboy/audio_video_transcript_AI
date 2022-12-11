<?php

error_reporting(0);
session_start();



include('settings.php');
include('db_connect.php');

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

$file_content = strip_tags($_POST['file_fname']);

$username = 'good';
$mt_id=rand(0000,9999);
$dt2=date("Y-m-d H:i:s");
$ipaddress = strip_tags($_SERVER['REMOTE_ADDR']);




if ($file_content == ''){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>Files Upload is empty</font></div>";
exit();
}

$ip= filter_var($ipaddress, FILTER_VALIDATE_IP);
if (!$ip){
echo "<div class='alert alert-danger' id='alerts_reg'><font color=red>IP Address is Invalid</font></div>";
exit();
}

$upload_path = "uploads/";


$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("wav", "WAV", "mp3", "MP3","mp4", "MP4", "webm", "WEBM", "ogg", "OGG");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Formats not allowed. Only mp3, wav, mp4, webm, ogg Audio/Videos Files are allowed<br></div>";
exit();
}




if($ext =='mp3'){
$data_type ='audio';
}

if($ext =='MP3'){
$data_type ='audio';
}


if($ext =='wav'){
$data_type ='audio';
}

if($ext =='WAV'){
$data_type ='audio';
}


if($ext =='mp4'){
$data_type ='video';
}

if($ext =='MP4'){
$data_type ='video';
}



if($ext =='webm'){
$data_type ='video';
}

if($ext =='WEBM'){
$data_type ='video';
}


if($ext =='ogg'){
$data_type ='video';
}

if($ext =='OGG'){
$data_type ='video';
}



 //validate file names, ensures directory tranversal attack is not possible.
//thus replace and allowe filenames with alphanumeric dash and hy

//allow alphanumeric,underscore and dash

$fname_1= preg_replace("/[^\w-]/", "", $filename_string);

// add a new extension name to the uploaded files after stripping out its dots extension name
//$new_extension = ".png";
//$fname = $fname_1.$new_extension;



$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

//give file a random names
$filecontent_name = $username.time();
//$filecontent_name = 'fred1';


if ($fsize > 50 * 1024 * 1024) { // allow file of less than 50 mb
echo "<div id='alertdata' class='alerts alert-danger'>File greater than 50mb not allowed<br></div>";
exit();
}

// Check if file already exists
if (file_exists($upload_path . $filecontent_name.'.'.$ext)) {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>This uploaded File <b>$filecontent_name.$ext</b> already exist<br></div>";
exit(); 
}



 	


$allowed_types=array(
'audio/mp3',
'audio/mpeg',
'audio/wav',
'audio/ogg',
'video/mp4',
'video/webm',
'video/ogg'
);



if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only  mp3, wav,mp4, webm, ogg Videos Files are allowed..<br><br></div>";
exit();
}




//validate files using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);

if ( ! ( in_array($mime, $allowed_types) ) ) {
  echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>Only  mp3, wav,mp4, webm, ogg Videos Files are allowed please.<br></div>";
exit();
}
finfo_close($finfo);



if (move_uploaded_file($ftmp, $upload_path . $filecontent_name.'.'.$ext)) {

$final_filename =  $filecontent_name.'.'.$ext;
$timer = time();

include ('authenticate.php');

$uid = strip_tags($_SESSION['uid']);
$userid =  strip_tags($_SESSION['fullname']);
$fullname = strip_tags($_SESSION['fullname']);
$username =  strip_tags($_SESSION['owner_identity']);
$photo = strip_tags($_SESSION['photo']);

$mt = microtime(true);
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$dt2=date("Y-m-d H:i:s");
$title = strip_tags($_POST['title']);

//replace any space with hyphen
$sp ='-';
$tt = time();
$title_seo = str_replace(' ', '-', $title.$sp.$tt);


$description = strip_tags($_POST['description']);

$audio_url ="$site_url/uploads/$final_filename";
       

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => 'https://api.assemblyai.com/v2/transcript',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode(
    [
      'audio_url' => $audio_url,
'auto_highlights' => true,
'content_safety' => true,
'iab_categories' => true,
'sentiment_analysis' => true,
'auto_chapters' => true,
'entity_detection' => true

    ]
  ),
  CURLOPT_HTTPHEADER => [
    "Authorization: $assemblai_token",
    'Content-Type: application/json'
  ]
]);

$response = curl_exec($curl);

$err = curl_error($curl);
curl_close($curl);

if ($err) {
  //echo 'cURL Error #:' . $err;


echo "<div style='background:red;padding:8px;color:white;border:none;'>Audio/Video Transcription Error: $err . Also Ensure there is Internet Connection and Try Again</div>";

} else {
  $response;


$json = json_decode($response, true);
$transcript_id = $json["id"];

echo $transcript_status = $json["status"];
//queued processing completed

if($transcript_id !==''){




$statement = $db->prepare('INSERT INTO posts
(title,title_seo,content,timer1,timer2,username,fullname,transcript_status,userphoto,data_type,userid,transcript_id,file_url)
                        values
(:title,:title_seo,:content,:timer1,:timer2,:username,:fullname,:transcript_status, :userphoto,:data_type,:userid,:transcript_id, :file_url)');
$statement->execute(array( 
':title' => $title,
':title_seo' => $title_seo,
':content' => $description,
':timer1' => $timer,
':timer2' => $created_time,
':username' => $username,
':fullname' => $fullname,
':transcript_status' => $transcript_status,
':userphoto' => $photo,
':data_type' => $data_type,
':userid' => $uid,
':transcript_id' => $transcript_id,
':file_url' => $audio_url
));





$res = $db->query("SELECT LAST_INSERT_ID()");
$lastId_post = $res->fetchColumn();



echo "<div style='background:green;padding:8px;color:white;border:none;'>Audio Processed and redirecting in less than 5 secs...<img src='ajax-loader.gif'></div>";



echo "<script>
window.setTimeout(function() {
    window.location.href = 'dashboard.php';
}, 10000);
</script><br><br>";

}else{


echo "<div style='background:red;padding:8px;color:white;border:none;'>Audio/Video Transcription Failed. Audio/Video Transcription ID is empty</div>";

}
}


                } else {
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Uploads Failed.<br></div>";
                }

}


?>












?>