<html>
<header>
<meta http-equiv="refresh" content="1;index.html" />
</header>
<body>  
<link rel = "stylesheet" type = "text/css" href = "login.css">	
<?php
session_start();
$con = mysqli_connect("localhost","root","","login"); //connect to database
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$username= $_POST['username'];
$password= $_POST['password'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$oldusername = $_SESSION["username"];
if ($username==NULL){ echo "Please input a valid username"; exit(); }
$checkexist = mysqli_query($con, "SELECT Username from user where Username = '$username'");
$checkexistresultrow = mysqli_num_rows($checkexist);
if ($checkexistresultrow > 0) 
	if($oldusername != $username)
		{ echo "$username  is already taken";  echo "<meta http-equiv='refresh' content='2;url=update.php'>"; exit();} 
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
	  echo "$emailErr";
	  echo "<meta http-equiv='refresh' content='2;url=update.php'>";
	  exit();
    }
$query= $con->prepare("update `user` set Username=?, password=?, contact=?, email=? where Username=?");
$query->bind_param('sssss', $username, $password, $contact, $email, $oldusername); //bind the parameters
if ($query->execute()){  //execute query
  echo "Data updated."; echo "<meta http-equiv='refresh' content='2;url=index.html'>"; session_destroy();
}else{
  echo "Error executing query.";
}
?>

</body>
</html>