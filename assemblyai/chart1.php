<?php
//error_reporting(0);


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


include('db_connect.php');


$conversation_idxx = $_GET['conversation_idxx'];

//$c_id = '5414484538556416';
$data[] = array('Sentiments', 'Score(Confidence)');

$result = $db->prepare('SELECT * FROM sentiments where conversation_id=:conversation_id');
$result->execute(array(':conversation_id' => $conversation_idxx));
$nosofrows = $result->rowCount();
while($row = $result->fetch()){
$id= $row['id'];


//foreach($json['data'] as $v1){
$score1 = $row['score'];
$score = $row['score'] * 100;
$documents = $row['documents'];
$sentiments_suggested = $row['sentiments'];

$sentiments= "$documents(Sentiments: $sentiments_suggested, Score: $score1)";
$data[] = array($sentiments,(int)$score);
}


echo json_encode($data);
