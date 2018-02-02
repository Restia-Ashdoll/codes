<html>
<body>  

<link rel="stylesheet" type="text/css" href="login.css">

<?php
$con = mysqli_connect("localhost","root","","login"); //connect to database
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
#$username= $_POST['username'];
#$password= $_POST['password'];
#$email = $_POST['email'];
#$contact = $_POST['contact'];


$query= $con->prepare("delete from `user` where Username=?");
$username= $_POST['username'];
$query->bind_param('s', $username); //bind the parameters
$query->execute();


if ($query->execute()){  //execute query
  echo "Account deleted."; echo "<meta http-equiv='refresh' content='2;url=index.html'>";
}else{
  echo "Error executing query.";
}
?>	
</body>
</html>