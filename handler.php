<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
}
require 'functions.php';

$status = [
    'status' => true,
    'message' => 'Patient Registered Successfully',
    'details' => null
];

$name = CleanInput($_POST['name']);
$email = CleanInput($_POST['email']);
$phone = CleanInput($_POST['phone']);
$hospital = CleanInput($_POST['hospital']);
$department = CleanInput($_POST['department']);

$errors = [];
$old = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'hospital' => $hospital,
    'department' => $department
];


if ($name == "") {
    $errors['name'] = 'Name is a required field!';
} else {
    if (!preg_match("/^([a-zA-Z' ]+)$/", $name)) {
        $errors['name'] = 'Name should contain Letters & Space only!';
    }
}

if ($email == "") {
    $errors['email'] = 'Email is a required field!';
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email is Invalid!';
    }
    $exist = CheckEmailAlreadyExist($email);
    if ($exist == true) {
        $errors['email'] = 'Email is already registered!';
    }
}

if ($phone == "") {
    $errors['phone'] = 'Email is a required field!';
} else {
    if (!preg_match("/^[0-9]{10}+$/", $phone)) {
        $errors['phone'] = 'Number should be less then 10 digits!';
    }
}

if ($hospital == "") {
    $errors['hospital'] = 'Hospital Must be selected!';
} else {
    if (!preg_match("/^[0-9]*$/", $hospital)) {
        $errors['hospital'] = 'Something Went Wrong!';
    }
}

if ($department == "") {
    $errors['department'] = 'Department Must be selected!';
} else {
    if (!preg_match("/^[0-9]*$/", $department)) {
        $errors['department'] = 'Something Went Wrong!';
    }
}

if (count($errors)>0) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
    header("Location: index.php");
    die();
} else {
    $connect = ConnectToDB();
    $query = "INSERT INTO `patients` (`id`, `name`, `email`, `phone`, `hospital_id`, `department_id`, `created_at`, `updated_at`) VALUES (NULL, '".$name."', '".$email."', '".$phone."', '".$hospital."', '".$department."', current_timestamp(), current_timestamp());";
    $insert = $connect->query($query);
    if ($insert !== true) {
        $status = [
            'status' => false,
            'message' => 'Database error contact support!'
        ];
    }
}

if ($status['status'] == true) {
    $_SESSION['status'] = $status;
    header("Location: index.php");
}