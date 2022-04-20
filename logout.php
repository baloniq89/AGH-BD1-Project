<?php
session_start();
unset($_SESSION['user']);
session_destroy();
header("Location: http://pascal.fis.agh.edu.pl/~9balawender/BD_project/index.php");
