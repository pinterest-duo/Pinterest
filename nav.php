<nav class="navbar sticky-top navbar-expand navbar-custom">
    <a class="navbar-brand" href="home.php"><img src="images/pinterest_logo.png" alt="Pinterest" height="27px"></a>
    <input class="form-control mr-lg-2 searchBar" id="searchBar" type="search" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="home.php" id="homeLink">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="" id="followingLink">Following</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="" id="profileLink"><img class="profileImg" src="<?php echo $row['user_image'];?>"/><p><?php echo $row['username'];?></p></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="" id="messagesLink">Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="" id="notificationsLink">Notifications</a>
        </li>
        <li class="nav-item">
            <a class="nav-link navEllipse" href="" id="moreLink">...</a>
        </li>
    </ul>
</nav>