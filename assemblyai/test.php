<?php
$filename_string = 'https://fredjarsoft.com/audio_sample.mp3';
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

echo "my data: $data_type";



?>