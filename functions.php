<?php

$info = [
    'host' => 'localhost',  //Change with your host address or keep it localhost if hosted on same server.
    'user' => 'root',   //Change with the username.
    'password' => '',   //Change with the password of user.
    'database' => 'test' //Name of your database.
];

function ConnectToDB() {
    global $info;
    $connect = new mysqli($info['host'], $info['user'], $info['password'], $info['database']);
    if ($connect->connect_errno) {
        echo $connect->connect_errno;
        die();
    }
    return $connect;
}

function GetHospitals() {
    $connect = ConnectToDB();
    $query = "SELECT * FROM `hospitals` WHERE `status` = '1'";
    return $connect->query($query);
}

function GetDepartments($hospital) {
    $query = "SELECT * FROM `departments` WHERE `hospital_id` = '".$hospital."'";
    $connect = ConnectToDB();
    return $connect->query($query);
}

function CleanInput($inp) {
    return htmlspecialchars(stripslashes($inp));
}

function CheckEmailAlreadyExist($email) {
    $connect = ConnectToDB();
    $query = "SELECT * FROM `patients` WHERE `email` = '".$email."'";
    $response = $connect->query($query);
    if ($response->num_rows > 0) {
        return true;
    }
    return false;
}