<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
}
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

if (isset($_SESSION['old'])) {
    $old = $_SESSION['old'];
}
require 'functions.php';
$data = GetHospitals();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Management Page | Home</title>
</head>
<body>
<div class="container">
    <form action="handler.php" method="post" id="PatientRegisteration">
    <h3 class="text-center">Management Page</h3>
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="mb-3">
                <label for="UserName" class="form-label">Enter Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="UserName" placeholder="Enter Name" name="name" value="<?php if (isset($old['name'])) { echo $old['name']; } ?>">
                <span class="text-danger" id="NameFeedback"><?php if (isset($errors['name'])) { echo $errors['name']; } ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="mb-3">
                <label for="UserEmail" class="form-label">Enter Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="UserEmail" placeholder="Enter Email" name="email" value="<?php if (isset($old['email'])) { echo $old['email']; } ?>">
                <span class="text-danger" id="EmailFeedback"><?php if (isset($errors['email'])) { echo $errors['email']; } ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="mb-3">
                <label for="UserPhone" class="form-label">Enter Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="UserPhone" onkeypress="return restrictAlphabets(event)" placeholder="Enter Phone" name="phone" value="<?php if (isset($old['phone'])) { echo $old['phone']; } ?>">
                <span class="text-danger" id="PhoneFeedback"><?php if (isset($errors['phone'])) { echo $errors['phone']; } ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 mx-auto">
            <select class="form-select" aria-label="Select Hospital Name" id="Hospital" name="hospital">
                <option value="" selected>Select Hospital Name</option>
                <?php while ($hospital = $data->fetch_assoc()) { echo '<option value="'.$hospital['id'].'">'.$hospital['name'].'</option>'; } ?>
            </select>
            <span class="text-danger" id="HospitalFeedback"><?php if (isset($errors['hospital'])) { echo $errors['hospital']; } ?></span>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 mx-auto">
            <select class="form-select" aria-label="Select Hospital Name" id="Department" name="department"></select>
            <span class="text-danger" id="DepartmentFeedback"><?php if (isset($errors['department'])) { echo $errors['department']; } ?></span>
        </div>
    </div>
    <div class="container mt-4 text-center">
        <button type="button" class="btn btn-primary btm-sm" id="SubmitBTN">Submit</button>
    </div>
    </form>
    <div class="container mt-3 text-center">
        <span class="text-sm <?php if (isset($status['status']) == 'true') { echo 'text-success'; } else { echo 'text-danger'; } ?>"><?php if (isset($status['status'])) { echo $status['message']; } ?></span>
    </div>
</div>


<!-- Optional JavaScript; choose one of the two! -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    const DepartmentSelect = document.getElementById('Department');
    DepartmentSelect.style.display = 'none';
    const HospitalSelect = document.getElementById('Hospital');
    const current = window.location.href;
    HospitalSelect.addEventListener('change', function () {
        const id = HospitalSelect.value;
        if (id == "") {
            DepartmentSelect.style.display = 'none';
            return false;
        } else {
            DepartmentSelect.style.display = 'block';
        }
        $.ajax({
            type:"GET",
            url:current + "department.php?hospital_id=" + id,
            dataType: "text",
            error: function (request, error) {
                console.log(arguments);
                console.log(" Error Occurred: " + error);
            },
            success: function(response){
                $('#Department').empty().append('<option value="" selected>Select Department</option>');
                const data = $.parseJSON(response);
                $.each(data ,function(key, item){
                    $('#Department').append('<option value="' + item.id + '">' + item.name + '</option>');

                });
            }
        });
    });
</script>
<script type="text/javascript" src="management.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
<?php session_unset(); session_destroy(); ?>