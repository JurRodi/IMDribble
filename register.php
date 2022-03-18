<?php
    include_once(__DIR__."/classes/User.php");
	session_start();
    if(!empty($_POST)){
        try {
            $user = new User();
            
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setPassword_conf($_POST['password_conf']);
            $user->save();
            header("Location: index.php");
        }
        catch ( Throwable $e ) {
            $error = $e->getMessage();
        }
    }
	  
	
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
    <link rel="stylesheet" type="" href="styling/style.css">
</head>
<body>
    <form method="POST" action="">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="username" >
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="email" >
        <label for="password">Password</label>
        <input type="text" name="password" placeholder="password">
        <label for="password_conf">Repeat password</label>
        <input type="text" name="password_conf" placeholder="password">
        <input type="submit" value="Register">
    </form>
    <?php if(isset($error)): ?>
        <div><?php echo $error ?></div>
    <?php endif; ?>
    
</body>

<body>
	
	

	
</body>
</html>