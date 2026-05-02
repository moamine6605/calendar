<?php

    //1. Connect to Local MySQL Server

    $username = "root";
    $conn = new mysqli("localhost", "root", "", "calendar");

    $conn->set_charset("utf-8");
?>