<!DOCTYPE html>
<html>
<head>
<title>Logout</title>
</head>
<body>
<?php
setcookie("user_id", $u_id, time() - 3600, "/");
header('Location: index');
?>