<?php 
    include_once(__DIR__. "/bootstrap.php");

    if (!empty($_POST)) {
        try {
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->canLogin();
            
            session_start();
            $_SESSION['email'] = $user->getEmail();
            header("Location: index.php");
        }
        catch ( Throwable $e ) {
            $error = $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDribble</title>
    <style><?php include 'styling/style.css'; ?></style>
    <link rel="stylesheet" href="styling/style.css">
</head>
<body>
    
    <div class="split-screen">
        <div class="left">
            <img id="quote" src="images/imdribble.png" alt="imdribble">
        </div>

        <div class="right">
            <form method="POST" action="">
            <section class="copy">
                <h1>Login</h1>
                <h2>Welcome back!</h2>
            </section>
            
            <div class="userdetails"> 
              <div class="input-box">
                <label for="email">Email</label>
                <input class="login-input1" type="text" name="email" placeholder="email" >
            </div>
            <div class="userdetails"> 
            <div class="input-box">
                <label for="password">Password</label>
                <input class="login-input" type="password" name="password" placeholder="password">
                <a class="link3" href="requestPassword.php">Forgot your password?</a>
            </div>
            <?php if(isset($error)): ?>
                <div class="error"><?php echo $error ?></div>
            <?php endif; ?>
            </div>
            <input class="signup-btn"  type="submit" value="Log in">
            </div>
            <a class="link1" href="register.php">Go to registration</a>
            
            </form>
    </div>
    </div>
    
</body>
</html>