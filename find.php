<?php
ini_set('error_reporting', -1);
ini_set('display_errors', 1);
ini_set('html_errors', 1); // I use this because I use xdebug
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("Location: search.php");
}
require 'functions.php';

$search = CleanInput($_GET['search']);
$phone = CleanInput($_GET['phone']);
$data = SearchUser($search, $phone);
$list = [];
$i = 0;
while ($content = $data->fetch_assoc()) {
    $list[$i] = [
        'count' => $i+1,
        'name' => $content['name'],
        'email' => $content['email'],
        'phone' => $content['phone'],
        'hospital' => GetHospitalNameUsingID($content['hospital_id']),
        'department' => GetDepartmentNameUsingID($content['department_id']),
        'date' => date('j M, Y', strtotime($content['created_at']))
    ];
    $i++;
}
echo json_encode($list);

