<?php
$con = mysqli_connect("localhost", "root", "", "test2");
if (!$con) {
    echo 'Nu se poate face conexiunea la server';
    exit();
}