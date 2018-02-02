<html>
<body>

<link rel = "stylesheet" type = "text/css" href = "login.css">	
<?php
$con = mysqli_connect("localhost","root","","login"); //connect to database
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
require_once "recaptchalib.php";
?>
<?php
if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        
        $secretKey = "6Leu3kEUAAAAAOJBQigdluyhymPYZ6YPi37CpxLS";
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo 'Please check your captcha form'; header('Location: index.html');
        } else {
          echo '<h1>FF20</h1>';
        }


?>
<?php
session_start();
$Username = $_POST['username'];
$password = $_POST['password'];
if ($Username==NULL){ echo "Account does not exist"; exit(); }
$checkexist = mysqli_query($con, "SELECT Username from user where Username = '$Username' and password = '$password'");
$checkexistresultrow = mysqli_num_rows($checkexist);
if ($checkexistresultrow > 0) { echo " Welcome $Username "; } else { echo "Login failed. Please enter a valid username or password."; echo "<meta http-equiv='refresh' content='2;url=index.html'>"; exit(); }
$query=$con->prepare("select Username, password, contact, email from user where Username = '$Username' and password = '$password'");
if($query->execute())
{
	$query->bind_result($Username, $password, $contact, $email);
}
else
{
	header('Location: index.html');
}	

?>

  
  
 <?php
while($query->fetch())
{
	echo "<div style='text-align:center' class='card'>";
    echo "<img src='food.jpg' style='width:0.05%'>";
    echo "<h1>$Username</h1>";
    echo "<p class='title'>Customer</p>";
    echo "<p>FF20</p>";  
    echo "<p>$email</p>";
	echo "<p>$contact</p>"; 
		
}
echo '<form action="delete_data.php" method="post">';
echo '<button type ="submit" name="username" value='.$Username.'>Delete</button></form>';

echo '<form action="update.php" method="post">';
echo '<button>Update</button></form>';

$_SESSION["username"] = $Username;
$_SESSION["password"] = $password;
$_SESSION["contact"] = $contact;
$_SESSION["email"] = $email;



?>
   
</div>




	



</body>
</html>