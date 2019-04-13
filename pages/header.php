<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location:invalid.php');
}
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patients Details</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- local css -->
    <link rel="stylesheet" href="../assets/css/others.css">
    <!-- datetime picker-->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../assets/css/DateTimePicker.css">

    </head>
<body>
    <div class="jumbotron text-center">
        <div class="container admin">
            <h1>ADMINISTRATION PANEL</h1>
            <a href="./logout.php" class="btn btn-danger">Log out</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group" class="list-group" id="list-tab">
                    <a href="admin-panel.php" class="list-group-item list-group-item-action" id="ist-home-list">Appointment</a>
                    <a href="appointments-details.php" class="list-group-item list-group-item-action" id="list-profile-list">Doctor Appointments</a>
                    <a href="customer.php" class="list-group-item list-group-item-action" id="list-settings-list">Payment/Checkout</a>
                    <a href="patients-info.php" class="list-group-item list-group-item-action" id="list-profile-list">Patients Info</a>
                    <a href="remove-patient.php" class="list-group-item list-group-item-action" id="list-messages-list">Remove Patient</a>
                    <a href="update-patient.php" class="list-group-item list-group-item-action" id="list-messages-list">Update Patient info</a>
                    <a href="update-appointment.php" class="list-group-item list-group-item-action" id="list-messages-list">Update Appointment info</a>
                    <a href="remove-appointment.php" class="list-group-item list-group-item-action" id="list-messages-list">Remove Appointment</a>
                 </div>

            </div>
                
'
?>