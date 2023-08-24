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
    <img class="icon" src="/resources/icons/logo.svg" alt="logo" />
    <span class = "header-title"> SolveIT </span>
  </div>
  <div class="notifications-container">
    <img  class="icon notification-button" src="/resources/icons/bell-solid.svg" alt="notifications" />
    <?php echo count(getNewNotifications()); ?>
  </div>
</div>

