<?php 
  require_once('../config/db.php');
  require_once('../lib/pdo_db.php');
  require_once('../models/Customer.php');
  include 'header.php';
  //Instaniate Customer
  $customer = new Customer();

  //Get Customer
  $customers = $customer->getCustomers();

?>

 <div class='col-md-8'>
            <div class='card'>
                <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
                    <div class='row'>
                        <div class='col-md-2'>
                            <h4>Customers</h4>
                        </div>
                        <div  class='col-md-10'>
                            <form style='width:40%;float:right' class='form-group' method='post' action='patient-search.php'>
                            <label style='float:left'>Search by phone number<label>
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
    <div class="row">
        <div class="col-md-6">
           <a href="customer.php"  class='btn btn-primary btn-block mt-4' >Check Customers</a>
        </div>
        <div class="col-md-6">
           <a href="transactions.php"  class='btn btn-primary btn-block mt-4' >Check Transactions</a>
        </div>
   </div>
   <div class="row">
       <div class="col-md-12"><hr></div>
   </div>
    <table class="table table-bordered">
    <thead>
        <tr>
        <th scope="col">Customer ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($customers as $c):?>
        <tr>
        <td><?php echo $c->id; ?></td>
        <td><?php echo $c->fname; ?></td>
        <td><?php echo $c->lname; ?></td>
        <td><?php echo $c->created_at; ?></td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
        <p><a class="btn btn-primary" href="admin-panel.php">Back</a>
        </div>
        <?php include 'footer.php';?>
