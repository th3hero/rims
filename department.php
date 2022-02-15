<?php
require 'functions.php';
$hospital = $_GET['hospital_id'];
$departments = GetDepartments(htmlspecialchars(stripslashes($hospital)));
$list = [];
$i = 0;
while ($data = $departments->fetch_assoc()) {
    $list[$i] = [
        'id' => $data['id'],
        'name' => $data['department']
    ];
    $i++;
}
echo json_encode($list);