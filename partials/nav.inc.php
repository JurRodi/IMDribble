<link rel="stylesheet" type="" href="styling/style.css">
<nav>

<ul class="nav-mobile"> 
<a href="index.php" class="nav-link link-active">
            <i class="material-icons nav-icon">home</i>
            <span class="nav-text">Home</span>
        </a>
        <a href="#" class="nav-link link-active">
            <i class="material-icons nav-icon">travel_explore</i>
            <span class="nav-text">Explore</span>
        </a>
        <a href="archive.php" class="nav-link link-active">
            <i class="material-icons nav-icon">add_box</i>
            <span class="nav-text">Add project</span>
        </a>
        <a href="profile.php" class="nav-link link-active">
            <i class="material-icons nav-icon">person</i>
            <span class="nav-text">Profile</span>
        </a>
</ul>

<nav class="navbar">
<img class="logo" src="images/logo.png" alt="Logo"> 
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Explore?</a></li>
        <li><a href="addProject.php">Add project</a></li>
        <li><a href="#">saved</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>


    <div>
        <?php if(!isset($_SESSION['email'])): ?>
            <a href="login.php">Log in</a>
        <?php endif; ?>
        <a href="logout.php" class="nav-link link-active">
            <i class="material-icons nav-icon">logout</i>
        </a>
    </div>
</nav>