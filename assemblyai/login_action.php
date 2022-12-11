<?php
error_reporting(0);

$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);


if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Email is empty</font></div>";
exit();
}


if ($password == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>password is empty</font></div>";
exit();
}


// honey pot spambots
$emailaddress_pot =$_POST['emailaddress_pot'];
if($emailaddress_pot !=''){
//spamboot detected.
//Redirect the user to google site

echo "<script>
window.setTimeout(function() {
    window.location.href = 'https://google.com';
}, 1000);
</script><br><br>";

exit();
}





include('db_connect.php');
$result = $db->prepare('SELECT * FROM users where email = :email');

		$result->execute(array(
			':email' => $email

    ));

$count = $result->rowCount();

$row = $result->fetch();

if( $count == 1 ) {


//start hashed passwordless Security verify
if(password_verify($password,$row["password"])){
            //echo "Password verified and ok";


$userid = htmlentities(htmlentities($row["id"]));
$fullname = htmlentities(htmlentities($row["fullname"]));
$email = htmlentities(htmlentities($row["email"]));
$owner_identity = htmlentities(htmlentities($row["owner_identity"]));
$photo = htmlentities(htmlentities($row["photo"]));


session_start();
session_regenerate_id();

// initialize session if things where ok.
$_SESSION['uid'] = $row['id'];
$_SESSION['fullname'] = $row['fullname'];
$_SESSION['owner_identity'] = $row['owner_identity'];
$_SESSION['photo'] = $row['photo'];

echo "<div class='alert alert-success'>Login sucessful <img src='ajax-loader.gif'></div>";
echo "<script>window.location='dashboard.php'</script>";




}
else{
echo "<br><br><div style='background:red;color:white;padding:10px;border:none;' id='alerts_login'>Password Does not Matched</div>";

}



}
else {
echo "<br><br><div style='background:red;color:white;padding:10px;border:none;' id='alerts_login'>User with This Email does not exist..</div>";
}






?>

<?php ob_end_flush(); ?>
