# BRMS_Project


•	Front End – PHP
•	Back End - mYSQL


I Prepare this Project on localhost . In order to run this project successfully on another host ,these change are required .
1.	To Send Mail for the OTP Login

On this path C:\xampp\php\php.ini - Set these values For [mail function]  

SMTP=smtp.gmail.com , 
smtp_port=587 ,
sendmail_from = Your Email ID , 
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"


On C:\xampp\sendmail\sendmail.ini  -  set these values For [sendmail]

smtp_server=smtp.gmail.com ,
smtp_port=587 ,
error_logfile=error.log ,
debug_logfile=debug.log ,
auth_username= Your Email ID ,
auth_password=Email Password ,
force_sender= Your Email ID ,



2.	Database & Table Creation

1.	Database Name - test , 
2.	Table Name - user_tab ,
    
CREATE TABLE `user_tab` (
	`u_name` varchar(20) NOT NULL ,
	`u_email` varchar(20) PRIMARY KEY,
	`u_dob` date NOT NULL,
	`u_mobileNo` char(10) NOT NULL,
	`u_pinCode` varchar(20) NOT NULL);

3.	Change mysqli_connect() values, according to the host machine
$con= mysqli_connect('127.0.0.1:3308','root','','test');
