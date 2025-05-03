<?php
// Implementable php file for the database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "project_one";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
