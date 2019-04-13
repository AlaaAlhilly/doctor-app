<?php 
  require_once('../config/db.php');
  require_once('../lib/pdo_db.php');
  require_once('../models/Customer.php');
  $customer = new Customer();
  include 'header.php';
  //Get Customer
  $customers = $customer->getPatientsInfo();
?>

 <div class='col-md-8'>
            <div class='card'>
                <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <h4>Patients details</h4>
                        </div>
                        <div  class='col-md-9'>
                            <form style='width:40%;float:right'class='form-group' method='post' action='charge.php'>
                            <label style='float:left'>Search by phone number<lable>
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
        </tr>
    </thead>
    <tbody>
        <?php foreach($customers as $c):?>
        <tr>
            <td><?php echo $c->fname;?></td>
            <td><?php echo $c->lname;?></td>
            <td><?php echo $c->email;?></td>
            <td><?php echo $c->contact; ?></td>
        </tr>   
        <?php endforeach;?>
    </tbody>
    </table>
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">First Name</th>
        <th scope="col">Street Address</th>
        <th scope="col">City</th>
        <th scope="col">Zip Code</th>
        <th scope="col">Country</th>
        <th scope="col">State</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach($customers as $c):?>
        <tr>
            <td><?php echo $c->fname;?></td>
            <td><?php echo $c->street;?></td>
            <td><?php echo $c->city;?></td>
            <td><?php echo $c->zip;?></td>
            <td><?php echo $c->country; ?></td>
            <td><?php echo $c->state; ?></td>
        </tr>   
        <?php endforeach;?>
    </tbody>
    </table>
    </div>

<?php include 'footer.php';?>
