<html>
<body>
<link rel = "stylesheet" type = "text/css" href = "login.css">	
<style type="text/css">@import "styles.css";
button {

		background: #B9DFFF;
		color: #000000;
		border: 1px solid #eee;
		border-radius: 20px;
		box-shadow: 5px 5px 5px #eee;
		text-shadow:none;
		width: 30%;
		height: 5%;
		margin: 0 auto;

}
button:hover {
background: #016ABC;
color: #fff;
border: 1px solid #eee;
border-radius: 20px;
box-shadow: 5px 5px 5px #eee;
text-shadow:none;
}
</style>

<?php
session_start();
$oldusername = $_SESSION["username"];
$password = $_SESSION["password"];
$contact = $_SESSION["contact"];
$email = $_SESSION["email"];

echo $oldusername;
?>
	<form action="update_data.php" method="post">
		<div class="login-page">
			<div class="form">
		
				<form action="insert_data.php" class="login-form" method="post" required>
				  <input type="text" placeholder="username" name="username"/ value="<?php echo $oldusername;?>"required>
				  <input type="password" placeholder="password" name="password"/ value="<?php echo $password;?>"required>
				  <input type="number" placeholder="contact" name="contact" maxlength="8" value="<?php echo $contact;?>"required/>
				  <input type="text" placeholder="email address" name="email" value="<?php echo $email;?>"required/>
				  <button type="submit" name="Enter" value="Enter">Update</button>
				  
				</form>
			</div>
		</div>
			
				
				
	</form>
		
</body>	
</html>	





