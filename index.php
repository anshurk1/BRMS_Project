<!DOCTYPE html>
<?php
/*

CREATE TABLE `user_tab` (
	`u_name` varchar(20) NOT NULL ,
	`u_email` varchar(20) PRIMARY KEY,
	`u_dob` date NOT NULL,
	`u_mobileNo` char(10) NOT NULL,
	`u_pinCode` varchar(20) NOT NULL);
*/   
session_start();
$errors = array(); 
$_SESSION['check']='';

$con= mysqli_connect('127.0.0.1:3308','root','','test');

//User Registration
if (isset($_POST['register_user']))
{

	$name=$_POST['c_name'];
	$email= $_POST['c_email'];
	$pinCode= $_POST['c_pinCode'];
	$dob=$_POST['c_dob'];
    $mobileNo= $_POST['c_mobileNo'];
	
	
	if (empty($name))
	{
		array_push($errors, "name is required");
	}
	if (empty($email)) 
	{
		array_push($errors, "email is required");
	}
	if (empty($pinCode))
	{
		array_push($errors, "pincode is required");
	}
	if (empty($dob)) 
	{
		array_push($errors, "DOB is required");
	}
	if (empty($mobileNo)) 
	{
		array_push($errors, "Mobile No is required");
	}
	if (count($errors) == 0)
	{
		$query = "select u_email from user_tab WHERE u_email='$email'";
		$sql = mysqli_query($con,$query);
		if(mysqli_num_rows($sql) > 0)
		{
			$result=mysqli_fetch_assoc($sql);
			echo '<script>alert("This email is already Registered ")</script>'; 			
			echo  "User Id :".$result['u_email']; 

		}
		else
		{
			$query = "INSERT INTO user_tab(u_name,u_email,u_dob,u_pincode,u_mobileNo)VALUES('$name','$email','$dob','$pinCode','$mobileNo')";
			$result = mysqli_query($con,$query);
			if($result)
			{
				echo '<script>alert("You Registered Successfully")</script>'; 	
				header('location:welcome.php');
		
			}
		}		
	}

}

//Sent OTP Verification
if (isset($_POST['verify_otp']))
{
	echo $user_otp=$_POST['user_otp'];
	if ($_SESSION['random_otp']==$user_otp)
	{
		header('location:welcome.php');
	}
	else
	{
		echo '<script>alert(" OTP Verification Failed")</script>'; 	

	}

}	


?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.open-button {
  background-color: #202020;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  top: 40%;
  left: 40%;
  width: 260px;
}

.form-popup {
  display: none;
  position: fixed;
  top: 10%;
  left: 38%;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

.form-container .btn {
  background-color: #29689e;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

.form-container .cancel {
  background-color: red;
}

.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body style="background-image: url('back.jpg');background-repeat:no-repeat;background-size: cover;">
<center>
<br><br>
<h2>Baba Ramdas Memorial Sr. Sec. School</h2>

<div id="myFormLogin">
<form  class="form-container" method="post" action="index.php">
	<h1>Login</h1>
    <label for="email" style="float:left"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" style="text-transform:lowercase" required>

	<?php if( ($_SESSION['check']=='1')|| ($_SESSION['check']=='') || isset($_POST['login_user']))
	{ ?>
    <button type="submit" class="btn btn-theme btn-block" name="login_user" ><i class="fa fa-lock"></i> Sign In</button>     
   	<button type="button" class="btn btn-theme btn-block" onclick="openFormRegister()" ><i class="fa fa-lock" ></i> Register Here</button>     
	<?php } ?>
</form>
</div>

<?php
//Verifing Email ID
if (isset($_POST['login_user']))
{ 
		$_SESSION['email']=$to_email=$_POST['email'];
	
		$query = "SELECT * FROM user_tab WHERE u_email='$to_email'";
		$results = mysqli_query($con, $query);
		if (mysqli_num_rows($results) == 1) 
		{
			
			$_SESSION['random_otp']=$random_otp=rand(1000,10000);	
			$subject = "OTP Verification";
			$body = "Your OTP : ".$random_otp;
			$headers = "BRMS : Account Verification ";

			$f=0;
			if (mail($to_email, $subject, $body, $headers))
			{ 
			?>
			<script>
				  document.getElementById("myFormLogin").style.display = "none";
			</script>
			
  			<form  class="form-container" method="post" action="index.php" >
  			<button type="button" style="ont-size:12px;color:red;float:right;border:0px" onclick="closeForm()"><i class="fa fa-close" ></i></button>
			<h1>Verify OTP</h1>
			<br>
			<label for="OTP"><b>Enter the OTP sent on your registered Email ID</b></label>
    		<input type="text" placeholder="Enter OTP" maxlength="4" name="user_otp" required>
	 		<button class="btn btn-theme btn-block" name="verify_otp" type="submit"><i class="fa fa-lock"></i> Verify OTP</button>     	
			</form>

			<?php
		
			}
			else
			{
				$_SESSION['check']='1';
				echo '<script>alert("Try Again")</script>'; 

			}
		}
		else
		{
			$_SESSION['check']='1';
			echo '<script>alert("This Email is not registered")</script>'; 

		}	
}	
?>



<div class="form-popup" id="myFormRegister">
  <form  class="form-container" method="post" action="index.php">
  <button type="button" style="font-size:12px;color:red;float:right;border:0px" onclick="closeFormRegister()"><i class="fa fa-close" ></i></button>
	<h1>Register</h1>

    <label for="name" style="float:left"><b>Name	</b></label>
    <input type="text" style="text-transform:capitalize" placeholder="Enter Name" name="c_name" required>

  
    <label for="email" style="float:left"><b>Email</b></label>
    <input type="text" style="text-transform:lowercase" pattern="[a-zA-Z0-9.!#$%&amp;’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+" placeholder="abc@gmail.com" name="c_email" required>


    <label for="dob" style="float:left"><b>DOB</b></label><br>
    <input type="date" name="c_dob" max="2010-12-01" style="background-color: #f1f1f1;width: 100%;padding: 15px;margin: 5px 0 22px 0;border: none;background: #f1f1f1" required>
	
	<br><br>
	 <label for="pin" style="float:left"><b>Pincode</b></label>
    <input type="text" placeholder="Enter Pincode" name="c_pinCode" pattern="[0-9]{6}" maxlength="6" required>

	 <label for="phone" style="float:left"><b>Mobile No.</b></label>
    <input type="text" placeholder="Enter Mobile No" name="c_mobileNo" pattern="[0-9]{10}" maxlength="10" required>


    <button class="btn btn-theme btn-block" name="register_user" type="submit"><i class="fa fa-lock"></i> Sign Up</button>     
  </form>
</div>



<script>
function openFormRegister()
{
	  document.getElementById("myFormRegister").style.display = "block";
	  document.getElementById("myFormLogin").style.display = "none";

}

function openFormSentOTP() 
{
	document.getElementById("myForm").style.display = "block";
}
function closeFormLogin()
 {
  document.getElementById("myForm").style.display = "none";

}
function closeFormRegister()
{
	document.getElementById("myFormLogin").style.display = "block";
	document.getElementById("myFormRegister").style.display = "none";
}
function closeForm()
{
	document.getElementById("myForm").style.display = "none";
	document.getElementById("myFormLogin").style.display = "block";

}

</script>
</center>
</body>
</html>
