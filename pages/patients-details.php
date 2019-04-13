<?php 
  require_once('../config/db.php');
  require_once('../lib/pdo_db.php');
  require_once('../models/Customer.php');
  include 'header.php';
  $customer = new Customer();

  //Get Customer
  $customers = $customer->getPatients();
?>
 <div class='col-md-12'>
            <div class='card'>
                <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <h4>Patients details</h4>
                        </div>
                        <div  class='col-md-9'>
                            <form style='width:40%;float:right'class='form-group' method='post' action='charge.php'>
                            <label style='float:left'>Search by phone number<libxml_disable_entity_loader>
                            <div class='input-group mb-3'>
                                
                                <input type='text' class='input-medium bfh-phone' name='phone' data-format='+1 (ddd) ddd-dddd'>                                    <div  class='input-group-append'>
                                        <button name='patient_search' style='color:white' class='btn btn-outline-secondary' type='submit' id='button-addon2'><i class='fas fa-search'></i></button>
                                    </div>
                                </div>
                            </form>
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
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($customers as $c):?>
        <tr>
            <td><?php echo $c->fname;?></td>
            <td><?php echo $c->lname;?></td>
            <td><?php echo $c->email;?></td>
            <td><?php echo $c->contact; ?></td>
            <td><?php echo $c->drname; ?></td>  
            <td><button class="btn btn-primary">Update</button></td>
            <td><button class="btn btn-danger">delete</button></td>
        </tr>   
        <?php endforeach;?>
    </tbody>
    </table>
        
    </div>
    <?php include 'footer.php';?>
