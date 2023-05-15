<?php
session_start();
session_destroy();

unset($user_id);
header("Location: login.php");
exit();
