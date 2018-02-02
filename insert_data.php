<html>
<body>  
<link rel = "stylesheet" type = "text/css" href = "login.css">	

<?php
$con = mysqli_connect("localhost","root","","login"); //connect to database
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}


$query= $con->prepare("INSERT INTO `user` (`Username`, `password`, `contact`, `email`) VALUES
(?,?,?,?)");
$username= trim($_POST['username']);
$password= $_POST['password'];
$email = $_POST['email'];
$contact = $_POST['contact'];

if ($username==NULL){ echo "Please input a username"; echo "<meta http-equiv='refresh' content='2;url=signup.html'>"; exit(); }
$checkexist = mysqli_query($con, "SELECT Username from user where Username = '$username'");
$checkexistresultrow = mysqli_num_rows($checkexist);
if ($checkexistresultrow > 0) { echo "$username  is already taken";  echo "<meta http-equiv='refresh' content='2;url=signup.html'>"; exit();} else { echo "This username may be used. ";  }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
	  echo "$emailErr";
	  echo "<meta http-equiv='refresh' content='2;url=signup.html'>";
	  exit();
    }
$query->bind_param('ssss', $username, $password, $contact, $email); //bind the parameters
if ($query->execute()){  //execute query
  echo " Your account will now be created."; echo "<meta http-equiv='refresh' content='2;url=index.html'>" ;
}else{
  echo "Error executing query.";
}
?>

</body>
</html>