<?php

// connect the database
include_once 'connection.php';

// check if the request method is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // do insert
    $name = htmlentities($_POST['name'], ENT_QUOTES);
    $age = htmlentities($_POST['age'], ENT_QUOTES);
    $gender = htmlentities($_POST['gender'], ENT_QUOTES);

    // you can change this query insert
    mysqli_query($db, "INSERT INTO `users` (`name`, `age`, `gender`) VALUES('$name', '$age', '$gender');");

    // you will know what is this when the data is not valid and classic user try to going file insertData.php
} else {
    header('HTTP/1.1 404 Not found');
}
