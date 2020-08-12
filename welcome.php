<?php

if($_SESSION['email']=='')
{
  header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
button
{
	background-color: #77777740;
	color: black;
	padding: 16px 2px;
  border: 2px solid #ccc;
	cursor: pointer;
	opacity: 0.8;
	width: 280px;
  margin-bottom:20px;
  margin-left:1px;
}

.field_css
{
  background-color: #77777740;
	color: black;
	padding: 16px 2px;
  border: 2px solid #ccc;
	cursor: pointer;
	opacity: 0.8;
	width: 280px;
  margin-bottom:20px;

}
</style>
</head>
<body>

<div style="height:100%;width:100%">
<div style="height:300px;background: #0f6688;padding-top:1px;text-align:center">
  <form method="post" action="welcome.php">
  <?PHP
  //Getting User Data from database
  session_start();
  $email="anshurk1@gmail.com"; //$_SESSION['email'];
  $con= mysqli_connect('127.0.0.1:3308','root','','test');
  $query = "SELECT * FROM user_tab WHERE u_email='$email'";
	$sql = mysqli_query($con,$query);
	if(mysqli_num_rows($sql) > 0)
	{
			$result=mysqli_fetch_assoc($sql);
      $name=$result['u_name']; 
      $email=$result['u_email']; 
      $dob=$result['u_dob']; 
      $pin=$result['u_pinCode']; 
      $mobileNo=$result['u_mobileNo']; 
} 
  ?><br><br><br><br>
  <h1>Baba Ramdas Memorial Sr. Sec. School</h1>
  <h1 style="text-transform:capitalize">Welcome <?php echo  $name; ?> </h1>

  <?php 
	if (isset($_POST['Logout_User']))
	{
		session_destroy();
		header('location:index.php');

	}				
  ?>

</form>
</div>
 
<div style="width:100%;margin-top:2px">

<div style="margin-right:2px;width:20%;height:100%;float:left;padding-top:1px;text-align:center;">
<form method="post" action="welcome.php">

<br><br>
<button style="width:70%;backround-color:" class="btn btn-theme btn-block" name="Show_User" type="submit"><i class="fa fa-lock"></i> Show Details </button>     
<button style="width:70%;" class="btn btn-theme btn-block" name="Update_Details" type="submit"><i class="fa fa-lock"></i> Update Details </button>     
<button style="width:70%;" class="btn btn-theme btn-block" name="delete_User" type="submit"><i class="fa fa-lock"></i> Delete Account </button>     
<button style="width:70%;" class="btn btn-theme btn-block" name="Logout_User" type="submit"><i class="fa fa-lock"></i> Logout </button>     

</form>
</div>

<center>
<div style="width:100%;height:100%;padding-top:1px;text-align:center">
<form method="post" action="welcome.php">

<?php 
// Showing User Record
	if (isset($_POST['Show_User']))
	{ ?>

  <form  class="form-container" method="post" action="welcome.php">
	<h1 style="margin-right:18%">User Profile</h1>
  <table style="margin-left:35%">
<tr>
<td><label><b>Name	</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input  class="field_css" type="text" placeholder="Enter Name" value="<?php echo $name; ?>" name="c_name" readonly></td>
</tr>
<tr>
<td><label><b>Email</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input  class="field_css" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email; ?>" name="c_email" readonly></td>
</tr>
<tr>
<td><label><b>DOB</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input  class="field_css" type="text" name="c_dob" max="2010-12-01" value="<?php echo $dob; ?>" readonly></td>
</tr>
<tr>
<td><label><b>Pincode</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input  class="field_css" type="text" placeholder="Enter Pincode" name="c_pinCode" value="<?php echo $pin; ?>" readonly></td>
</tr>
<tr>
<td><label><b>Mobile No.</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input class="field_css" type="text" placeholder="Enter Mobile No" name="c_mobileNo" value="<?php echo $mobileNo; ?>" readonly></td>
</tr>
</table>
  </form>

  
 <?PHP }	
  if (isset($_POST['Update_Details']))
	{ ?>
	
  <form  class="form-container" method="post" action="welcome.php">
	<h1 style="margin-right:18%">Update Profile</h1>

<table style="margin-left:35%">
<tr>
<td><label><b>Name	</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input style="text-transform:capitalize"  class="field_css" type="text" placeholder="Enter Name" value="<?php echo $name; ?>" name="c_name" required></td>
</tr>
<tr>
<td><label><b>Email</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input style="text-transform:lowercase"  class="field_css" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email; ?>" name="c_email"readonly></td>
</tr>
<tr>
<td><label><b>DOB</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input  class="field_css" type="text" name="c_dob" max="2010-12-01" value="<?php echo $dob; ?>" readonly></td>
</tr>
<tr>
<td><label><b>Pincode</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input  class="field_css" type="text" placeholder="Enter Pincode" name="c_pinCode" pattern="[0-9]{6}" maxlength="6" value="<?php echo $pin; ?>" required></td>
</tr>
<tr>
<td><label><b>Mobile No.</b></label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><input class="field_css" type="text" placeholder="Enter Mobile No" name="c_mobileNo" pattern="[0-9]{10}" maxlength="10" value="<?php echo $mobileNo; ?>" required></td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><button class="btn btn-theme btn-block" style="margin-left:-5%;background-color: #0f6688;"  name="Update_De" type="submit"><i class="fa fa-lock"></i> Update</button></td>
</tr>
</table>

  <?php }	
  // Updating User Record

  if (isset($_POST['Update_De']))
	{

    $name=$_POST['c_name']; 
    $pin=$_POST['c_pinCode']; 
    $mobileNo=$_POST['c_mobileNo'];
    $email=$_SESSION['email'];
    //$query="update user_tab set u_name ='$name', u_dob ='$dob', u_pinCode ='$pin' and u_mobileNo ='$mobileNo' where u_email='$_SESSION['email']'";
    $query="UPDATE `user_tab` SET `u_name` = '$name', `u_mobileNo` = '$mobileNo', `u_pinCode` = '$pin' WHERE `u_email` = '$email';";
    $result = mysqli_query($con,$query);
    if($result)
		{
				echo '<script>alert(" Updated Successfully")</script>'; 
		}
		else
		{
			echo '<script>alert("Try Again")</script>'; 
		}	


  }

  // Account LogOut
  if (isset($_POST['Logout_User']))
	{
		session_destroy();
		header('location:index.php');

  }	

  // Deleting User Record
  if (isset($_POST['delete_User']))
	{
		?>
    <div style="color: black;margin-left:30%;margin-top:5%;padding: 5px 2px;border: 2px solid #ccc;width: 50%;margin-bottom:20px;">
    <form  class="form-container" method="post" action="welcome.php">
    
    <h1>Do You Really Want To Delete This Account </h1>
    <button class="btn btn-theme btn-block" style="	opacity:1;width:200px;margin-left:-5%;background-color: #0f6688;"  name="yes_btn" type="submit"><i class="fa fa-lock"></i> Yes</button>
    &nbsp;&nbsp;<button class="btn btn-theme btn-block" style="opacity:1;width:200px;margin-left:5%;background-color: #0f6688;"  name="no_btn" type="submit"><i class="fa fa-lock"></i> No</button>

    <div>
    </form>
    <?php

  }		
  if (isset($_POST['yes_btn']))
	{	
    $query="DELETE FROM `user_tab` WHERE `u_email`='$email'";
    $result = mysqli_query($con,$query);
    if($result)
		{
        session_destroy();
				echo '<script>alert(" Account Deleted")</script>'; 
		}
		else
		{
			echo '<script>alert("Deletion Failed")</script>'; 
		}	

  }	
  if (isset($_POST['no_btn']))
	{	
    	echo '<script>alert("No Data Have Been Deleted")</script>'; 

  }		
  ?>


</form>
</div>

</div>

</div>
</body>
<script>

</script>
</html>
