<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Social Network</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Search</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newpost.php">Create Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="utils/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>-->
<div class="header-container">
  <div class="logo-container">
    <span class="fa-regular fa-lightbulb icon" aria-hidden="true" title="Logo"></span>
    <span class="sr-only">Logo icon</span>
    <!-- <img class="icon" src="/resources/icons/logo.svg" alt="logo"/> -->
    <span class = "header-title"> SolveIT </span>
  </div>
  <div class="notifications-container">
    <span class="fa-solid fa-bell icon" aria-hidden="true" title="Notifications icon"></span>
    <span class="sr-only">Notifications icon</span>
    <span class="notification-badge">
            <?php 
                $number = count(getNewNotifications());
                echo $number > 99 ? "99+" : $number;
            ?>
    </span>
  </div>
</div>

