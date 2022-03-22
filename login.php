<?php 
    include_once(__DIR__."/classes/User.php"); 
    session_start();

    if (!empty($_POST)) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = new User();
        try {
            $user->canLogin($email, $password);
            session_start();
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
    <input type="text" name="password" placeholder="password">
    <input type="submit" value="Log in">
    </form>
    <?php if(isset($error)): ?>
        <div><?php echo $error ?></div>
    <?php endif; ?>
</body>
</html>