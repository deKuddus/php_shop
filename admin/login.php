<?php include '../classes/Adminlogin.php'; ?>
<?php

$adminlogin = new Adminlogin();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = $_POST['username'];
    $userpass = md5($_POST['password']);

    $adminLogCheck = $adminlogin->adminLogin($username,$userpass);
}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
            <?php if(isset($adminLogCheck)){
                echo $adminLogCheck;
            }?>
			<div>
				<input type="text" placeholder="Username" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">E-commerce admin panel</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>