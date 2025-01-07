<?php
setcookie("event-clicked", "", time() - 3600, "/");
setcookie("user-session", "", time() - 3600, "/");
header("Location: index.php");
?>