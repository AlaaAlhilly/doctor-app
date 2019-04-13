<?php 
  require_once('../config/db.php');
  require_once('../lib/pdo_db.php');
  require_once('../models/Customer.php');
  include 'header.php';
  $customer = null;
  $custmers = null;
    if(isset($_POST['patient_search'])){
        $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);

        $customer = new Customer();
        //Get Customer
         $customers = $customer->getPatient($POST);
    }
  
?>

 <div class='col-md-8'>
            <div class='card'>
                <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <h4>Patients details</h4>
                        </div>
                        
                    </div>
                </div>
                <hr>
    <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email id</th>
        <th scope="col">Contact phone</th>
        <th scope="col">Appointment time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($custmers as $c):?>
        <tr>
            <td>echo $c->fname</td>
            <td>echo $c->lname</td>
            <td>echo $c->email</td>
            <td>echo $c->contact</td>
            <td>echo $c->docapp</td>  
        </tr>   
        <?php endforeach;?>
    </tbody>
    </table>
        
    </div>
    <?php include 'footer.php';?>
