<?php
error_reporting(0);



include('db_connect.php');


//$conversation_idxx = $_GET['conversation_idxx'];
//$data[] = array('Documents Analytic Type', 'Percent', 'Seconds');



$conversation_idxx = $_GET['conversation_idxx'];
$data[] = array('Name Entities', 'Start Values');

$result = $db->prepare('SELECT * FROM entities where conversation_id=:conversation_id');
$result->execute(array(':conversation_id' => $conversation_idxx));
$nosofrows = $result->rowCount();
while($row = $result->fetch()){
$id= $row['id'];


//foreach($json['data'] as $v1){
$start_value = $row['start_value'];
$entity_type = $row['entity_type'];
$content_text = $row['content_text'];

$sts= "$entity_type(Text: $content_text, Start: $start_value)";
$data[] = array($sts,(int)$start_value);
}


echo json_encode($data);
