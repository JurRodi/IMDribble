<nav>
<ul class="nav-mobile"> 
<a href="index.php" class="nav-link link-active">
            <i class="material-icons nav-icon">home</i>
            <span class="nav-text">Home</span>
        </a>
        <a href="addproject.php" class="nav-link link-active">
            <i class="material-icons nav-icon">add_box</i>
            <span class="nav-text">Add project</span>
        </a>
        <a href="profile.php" class="nav-link link-active">
            <i class="material-icons nav-icon">person</i>
            <span class="nav-text">Profile</span>
        </a>
</ul>
</nav>

<nav class="navbar">
    <a href="index.php"><img class="logo" src="images/logo.png" alt="Logo"> </a>
    <ul>
        <li><a href="index.php">Home</a></li>
      
        <li><a href="addProject.php">Add project</a></li>
       
        <li><a href="profile.php">Profile</a></li>
    </ul>
   
    <div>
        <?php if(!isset($_SESSION['email'])): ?>
            <a href="login.php">Log in</a>
        <?php else: ?>
            <a href="logout.php" class="nav-link link-active">
            <i class="material-icons nav-icon">logout</i>
        </a>
        <?php endif; ?>
        
    </div>
</nav>
<div id="line"></div>
