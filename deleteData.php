<?php
// connect the database
include_once 'connection.php';

// you can change this query
$queryDelete = "DELETE FROM users WHERE id = " . $_GET['id'];
mysqli_query($db, $queryDelete);
