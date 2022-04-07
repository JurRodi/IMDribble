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
</head>
<body>
    <form method="POST" action="">
    <label for="email">Email</label>
    <input type="text" name="email" placeholder="email" >
    <label for="password">Password</label>
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="Log in">
    </form>
    <a href="requestPassword.php">Forgotten password?</a>
    <?php if(isset($error)): ?>
        <div><?php echo $error ?></div>
    <?php endif; ?>
</body>
</html>