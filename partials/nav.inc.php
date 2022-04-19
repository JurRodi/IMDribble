<nav>
    <div>
        <a href="index.php">IMDribble</a>
        <a href="addProject.php">Add project</a>
        <a href="profile.php">Profile</a>
    </div>
    <div>
        <?php if(!isset($_SESSION['email'])): ?>
            <a href="login.php">Log in</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </div>
</nav>