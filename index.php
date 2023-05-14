<?php if(file_exists("config.php"))require_once("config.php");?>
<?php session_start(); ?>
<?php
// تحديد معلومات تسجيل الدخول
$valid_username = "admin";
$valid_password = "admin";

// التحقق من تقديم اسم المستخدم وكلمة المرور
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// التحقق من صحة اسم المستخدم وكلمة المرور
	if (($username == $valid_username) && ($password == $valid_password)) {
	// تسجيل الدخول الناجح
	$_SESSION=array();
	$_SESSION['status']=true;
	header("Location:dashboard.php"); // توجيه المستخدم إلى صفحة اللوحة
	exit();
	} else {
	// عرض رسالة الخطأ
	$error_message = "اسم المستخدم أو كلمة المرور غير صحيحة";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>Login Page</title>
 <style>
  body {
   background-color: #f2f2f2;
   font-family: Arial, sans-serif;
  }
  .container {
   margin: 0 auto;
   max-width: 500px;
   padding: 20px;
   background-color: #fff;
   border-radius: 5px;
   box-shadow: 0 0 10px rgba(0,0,0,0.3);
  }
  h1 {
   text-align: center;
   margin-bottom: 20px;
  }
  input[type="text"], input[type="password"] {
   width: 100%;
   padding: 12px 20px;
   margin: 8px 0;
   display: inline-block;
   border: 1px solid #ccc;
   border-radius: 4px;
   box-sizing: border-box;
  }
  button {
   background-color: #4CAF50;
   color: white;
   padding: 14px 20px;
   margin: 8px 0;
   border: none;
   border-radius: 4px;
   cursor: pointer;
   width: 100%;
  }
  button:hover {
   background-color: #45a049;
  }
  .error {
   color: red;
   font-size: 12px;
   margin-top: 5px;
  }
 </style>
</head>
<body>
 <div class="container">
  <h1>Login</h1>
  <form action="#" method="post">
   <label for="username">Username</label>
   <input type="text" id="username" name="username" >

   <label for="password">Password</label>
   <input type="password" id="password" name="password" >

   <button type="submit" name="login">Login</button>

   <div class="error">
    <!-- يمكن استخدام PHP لعرض رسالة الخطأ هنا -->
	<?php echo $error_message;?>
   </div>
  </form>
 </div>
</body>
</html>

