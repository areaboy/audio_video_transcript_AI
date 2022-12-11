<?php

//error_reporting(0);
session_start();
include ('authenticate.php');

include('settings.php');

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


include('db_connect.php');
$description = strip_tags($_POST['description']);
$audio_url = $_POST['audio_url'];



$filename_string = $audio_url;
// thus check files extension names before major validations

$allowed_formats = array("wav", "WAV", "mp3", "MP3","mp4", "MP4", "webm", "WEBM", "ogg", "OGG");
$exts = explode(".",$filename_string);
echo $ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div id='alertdata_uploadfiles' class='alerts alert-danger'>File Formats not allowed. Only mp3, wav, mp4, webm, ogg Audio/Videos Files are allowed.<br></div>";
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

//echo "my data: $data_type";





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




//session_start();
//$_SESSION['id_sess'] = $transcript_id;

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

?>