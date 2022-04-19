<?php
    include_once(__DIR__. "/bootstrap.php");

    if(!empty($_POST)){
        try {
            $user = new User();
            
            $user->setUsername($_POST['username']);
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
              <div class="input-box">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" >
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="email" >
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="text" name="password" placeholder="password">
            </div>
            <div class="input-box">
                <label for="password_conf">Repeat password</label>
                <input type="text" name="password_conf" placeholder="password">
            </div>
            <input class="signup-btn" type="submit" value="Register">
          </div> 
            </form>
        

        </div>
    </div>





   

    

  
    <?php if(isset($error)): ?>
        <div><?php echo $error ?></div>
    <?php endif; ?>
    
</body>

<body>
	
	

	
</body>
</html>