<?php
session_start();
unset($_SESSION['facebook_access_token']);
unset($_SESSION['facebook_user_name']);

header('Location: ../../index.php');