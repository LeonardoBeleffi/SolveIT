<div class="header-container">
  <div class="logo-container">
    <span class="fa-regular fa-lightbulb icon" aria-hidden="true" title="Logo"></span>
    <span class="sr-only">Logo icon</span>
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

