<html>
<head>
<style>

.error
{
	color:red;
	font-size:20px;	
}

#main
{
height:1000px;
width:900px;
padding:30px;
position:absolute;
left:450px;
top:200px;
color:black;
background-color:#8D8C8A;
}

body
{
	background-color:#3D3C3A;
}

#form
{
	margin:40px;
	font-size:30px;
	padding:20px;
}

.space
{
	height:35px;
	width:350px;
	font-size:25px;
	position:absolute;
	left:550px;
}


</style>
</head>
<body> 

<?php
session_start();

$nameErr = $rnoErr = $deptErr = $yearErr = $emailErr = $passErr = $captchaErr = "";
$name = $email = $rno = $dept = $year = $pass = $captchca = "";
$formOk = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	
   if (empty($_POST["name"])) 
   {
     $nameErr = "Name is required";
	 $formOk = 0;
   }
   else 
   {
     $name = read($_POST["name"]);
     
     if (!preg_match("/^[a-zA-Z ]*$/",$name))
		 {
       $nameErr = "Only letters and white space allowed"; 
	   $formOk = 0;
		 }
   }
   
    if (empty($_POST["rno"])) 
	{
     $rnoErr = "Roll no is required";
	 $formOk = 0;
   }
   else 
   {
     $rno = read($_POST["rno"]);
	 $_SESSION['roll'] = $rno;
    
     if (!preg_match("/^[0-9]/",$rno))
		 {
       $rnoErr = "Invalid Rollno"; 
	   $formOk = 0;
         }
   }
   
     if (empty($_POST["dept"])) 
	 {
     $deptErr = "Department name required";
	 $formOk = 0;
	 }
	 else
	   {
     $dept = read($_POST["dept"]);
       }

    if (empty($_POST["year"]))
	   {
     $yearErr = "Year is required";
	 $formOk = 0;
       } 
	   else 
	   {
     $year = read($_POST["year"]);
	 if (!preg_match("/^[0-9]/",$year))
		 {
       $yearErr = "Invalid Year"; 
	   $formOk = 0;
         }
       }
   
   
   if (empty($_POST["email"])) 
   {
     $emailErr = "Email is required";
	 $formOk = 0;
   }
   else 
   {
     $email = read($_POST["email"]);
     
     if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		 {
       $emailErr = "Invalid email format"; 
	   $formOk = 0;
     }
   }
   
   
    if (empty($_POST["pass"])) 
	{
     $passErr = "Password required";
	 $formOk = 0;
   }
   else 
   {
     $pass = $_POST["pass"];
	 if(strlen($pass)<8)
	 {
		 $passErr = "Minimum 8 characters required! ";
		 $formOk = 0;
	 }
		 
   }
   
       if (empty($_POST["captcha"])) 
	{
     $captchaErr = "Captcha required. ";
	 $formOk = 0;
   }
   else 
   {
     
	 if($_POST["captcha"] != $_SESSION['digit'])
	 {	
		 $captchaErr = "Wrong captcha. ";
		 $formOk = 0;
	 }
   }
   
}

	function read($data)
	{
	$data = trim($data);							
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}



?>

<br>
<h3 style = "color:white;"><center>Fill all the fields in the form correctly and once the record has been created succesfully the profilepic can be uploaded.</center></h3>
<div id = "main">
<h1><center>REGISTRATION FORM</center></h1>
<div id = "form">
<p><span class="error">* required field.</span></p>
<form method="post" id = "FORM" name = "FORM" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

   NAME: <input type="text" name="name" id ="name" value = "" class = "space">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   
   ROLL NO: <input type="text" name="rno" id = "rno" value = "" class = "space">
   <span class="error">* <?php echo $rnoErr;?></span>
   <br><br>
   
   DEPARTMENT: <input type="text" name="dept" id = "dept" value = "" class = "space">
   <span class="error">* <?php echo $deptErr;?></span>
   <br><br>
   
   YEAR: <input type = "text" name="year" id = "year" value = "" class = "space">
   <span class="error">* <?php echo $yearErr;?></span>
   <br><br>
   
   E-MAIL: <input type = "text" name="email" id = "email" value = "" class = "space">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   
   PASSWORD: <input type = "password" name="pass" id = "pass" value = "" class = "space" id = "pass">
   <span class="error">* <?php echo $passErr;?></span>
   <br>
   <div style = "position:absolute; left:545px;">
   <input type = "checkbox" id = "checkbox" style = "height:20px; width:20px;"> <span style = "font-size:20px;">SHOW/HIDE PASSWORD</span></p>
   </div>
   <br><br>
   
   CAPTCHA: 
   <img src = "/captcha.php" width = "120" height = "30" border = "1" id = "captcha" alt = "CAPTCHA" style = "position:absolute; left:550px;"><br>
   <span style = "position:absolute; left:550px; font-size:20px;" >Prove us you are not a robot</span><br>
   <input type = "button" value = "Not clear?" onclick = "changeCaptcha()" style = "position:absolute; left:550px;" ><br>
   <input type = "text" name="captcha" value = "" class = "space">
  
  <center><input type = "submit" name = "submit" value = "SUBMIT FORM" style = "font-size:20px; position:absolute; top:900px; left:390px;"></center> 
  <br><br>
  
  
  
  
   

</form>

   <form method = "post" action = "upload.php" enctype = "multipart/form-data" style = "position:absolute; top:970px;" >  
   PROFILE PICTURE: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
   <input type="file" name="fileToUpload" id="fileToUpload" style = "font-size:15px;">
   <input type="submit" value="UPLOAD" name="submit" style = "font-size:15px; position:absolute; left:670px; top:10px;">
   </form>
   
   
<br><br><br><br><br>
   
</div>
</div>

<?php
if($formOk == 1 && !empty($_POST["name"]))
{
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);     //Check
} 

$lastId = rand(100000000,999999999);

/*$sql = "INSERT INTO students (ID, NAME, ROLLNO, DEPARTMENT, YEAR, EMAIL, PASSWORD)
VALUES ('$lastId', '$name', '$rno', '$dept', '$year', '$email', '$pass')";*/


 
if ($stmt = $conn->prepare("INSERT INTO students (ID, NAME, ROLLNO, DEPARTMENT, YEAR, EMAIL, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?)"))
	{
 
    
    $stmt->bind_param("sssssss", $lastId, $name, $rno, $dept, $year, $email, $pass);
 
    
    if($stmt->execute() == TRUE)
	{
		echo " <center><h1> New record created successfully with unique ID : "  . $lastId . "</h1></center>";			// with prevention of sql injection
	}
	
	else
	{
		echo "Error: " . "<br>" . $conn->error;
	}
 
   
    $stmt->close();
 
	}

/*if ($conn->query($sql) === TRUE) 
{
    
    echo " <center><h1> New record created successfully with unique ID : "  . $lastId . "</h1></center>";
	$name = $email = $rno = $dept = $year = $pass = "";
	$formOk = 0;																									// without prevention of sql injection
	
} else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/

$conn->close();
}
$formOk = 0;
?>


</body>
<script>
var dom = function(id)
{
	return document.getElementById(id);
}
dom('checkbox').onchange = function()
{
	if(dom('checkbox').checked)
	{
		dom('pass').setAttribute("type","text");
		
	}
	
	else
	{
		dom('pass').setAttribute("type","password");
	}
}

function changeCaptcha()
{	
	var captcha = dom('captcha');
	captcha.src = "/captcha.php";
	
}

</script>
</html>