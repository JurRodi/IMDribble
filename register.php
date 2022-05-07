<?php
    include_once(__DIR__. "/bootstrap.php");

    if(!empty($_POST)){
        try {
            $user = new User();
            
            $user->setUsername($_POST['username']);
            //ajax gebruiken om zien op email al gebruikt
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setPassword_conf($_POST['password_conf']);
            $user->save();

            session_start();
            $_SESSION['email'] = $user->getEmail();
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

    <div class="split-screen">
        <div class="left">
            <img id="quote" src="images/quote.png" alt="quote">
        </div>

        <div class="right">
            <form method="POST" action="">
            <section class="copy">
                <h1>Register</h1>
                <h2>Create a account!</h2>
            </section>
            <div class="userdetails"> 
              <div class="input-box" id="usernameInputSection">
                <label for="username">Username</label>
                <input class="login-input" id="username-input" type="text" name="username" placeholder="username" >
            </div>
            <div class="input-box" id="emailInputSection">
                <label for="email">Email</label>
                <input class="login-input" id="email-input" type="text" name="email" placeholder="email" >
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input class="login-input" type="password" name="password" placeholder="password" autocomplete="on">
            </div>
            <div class="input-box">
                <label for="password_conf">Repeat password</label>
                <input class="login-input" type="password" name="password_conf" placeholder="password" autocomplete="on">
            </div>
            <input class="signup-btn" type="submit" value="Register">
          </div> 
                <a class="link2" href="login.php">Go to log in</a>
            </form>
        

        </div>
    </div>
    <?php if(isset($error)): ?>
        <div><?php echo $error ?></div>
    <?php endif; ?>
    <script src="./scripts/login.js"></script>
</body>
</html>