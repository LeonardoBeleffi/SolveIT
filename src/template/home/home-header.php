<div class="header-container">
  <div class="logo-container">
    <span id="home-redirect-logo" class="fa-regular fa-lightbulb icon" title="Logo"></span>
    <span class="sr-only">Logo icon</span>
    <span class = "header-title"> SolveIT </span>
  </div>
  <div class="notifications-container">
    <span class="fa-solid fa-bell icon" title="Notifications icon"></span>
    <span class="sr-only">Notifications icon</span>
    <span class="notification-badge">
            <?php
                $number = count(getNewNotifications());
                echo $number > 99 ? "99+" : $number;
            ?>
    </span>
  </div>
</div>

