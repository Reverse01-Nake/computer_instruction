<?php
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["group"]);
    header("location: ../index.php");
?>