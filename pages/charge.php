<?php
require_once('../vendor/autoload.php');
require_once('../config/db.php');
require_once('../lib/pdo_db.php');
require_once('../models/Customer.php');
require_once('../models/Transaction.php');
require_once('../models/Login.php');
//Sanitizing post array
if(isset($_POST['login_submit'])){
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $login = new Login();
    $login->login($POST);
    return;
}
if(isset($_POST['save_pat'])){
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $customer = new Customer();
    $customer->savePatient($POST);
    echo '<div style ="margin:auto" class="container"><h2>Patient info saved successfully</h2>
        <a href="admin-panel.php" type="button">Go Back</a>
    </div>';
    return;
}
if(isset($_POST['remove_pat'])){
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $customer = new Customer();
    $customer->removePatient($POST['phone']);
    echo '<div style ="margin:auto" class="container"><h2>Patient info deleted successfully</h2>
        <a href="admin-panel.php" type="button">Go Back</a>
    </div>';
    return;
}
if(isset($_POST['remove_app_phone'])){
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $customer = new Customer();
    $customer->removeAppointment($POST['remove_app_phone']);
    echo '<div style ="margin:auto" class="container"><h2>appointment info deleted successfully</h2>
        <a href="admin-panel.php" type="button">Go Back</a>
    </div>';
    return;
}
if(isset($_POST['old_phone'])){
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $customer = new Customer();
    $customer->updatePatient($POST);
    echo '<div style ="margin:auto" class="container"><h2>Patient info updated successfully</h2>
        <a href="admin-panel.php" type="button">Go Back</a>
    </div>';
    return;
}

if(isset($_POST['update_app_phone'])){
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $customer = new Customer();
    $customer->updateAppointment($POST);
    echo '<div style ="margin:auto" class="container"><h2>appointment time and doctor updated successfully</h2>
        <a href="admin-panel.php" type="button">Go Back</a>
    </div>';
    return;
}
if(isset($_GET['q'])){
    $customer = new Customer();
    if(strpos($_GET['q'],'-') !== false){
        $GET = filter_var_array($_GET,FILTER_SANITIZE_STRING);
        $customer->fillAppointmentWith($GET['q']);
    }else if($_GET['q']==='first'){
        $customers = $customer->getFirstDoctor("");
        echo $customers->drname;
    }else{
        $GET = filter_var_array($_GET,FILTER_SANITIZE_STRING);
        $customers = $customer->getDoctor($GET['q']);
        echo $customers->drname;
    }
    return;
}
\Stripe\Stripe::setApiKey('sk_test_JmgyzjVGuTeP7zuBaBWeKPZ7');
$POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email = $POST['email'];
$contact = $POST['phone'];
$drname = $POST['drname'];
$appDate =$POST['app_date'];
$appTime = $POST['time_select'];
$token = $POST['stripeToken'];
//Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
    "email"=> $email,
    "source" => $token
));
$charge = \Stripe\Charge::create(array(
    "amount" => 5000,
    "currency" => "usd",
    "description" => "Doctor Appointment Payment",
    "customer" => $customer->id
));

//Instantiate Customer
$customer = new Customer();

//Customer Data
$customerData = [
    'id' => $charge->customer,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'phone' => $contact
];

//Add Customer To DB
$customer->addCustomer($customerData);
$customer->savePatient($POST);
//Add Appointment for the customer
$customer->addAppointment($POST);
//Instantiate Transaction
$transaction = new Transaction();

//Customer Data
$transactionData = [
    'id' => $charge->id,
    'customer_id' => $charge->customer,
    'product' => $charge->description,
    'amount' => $charge->amount,
    'currency' => $charge->currency,
    'status' => $charge->status
];
//Add Customer To DB
$transaction->addTransaction($transactionData);
//redirect to success
header('Location:success-payment.php?tid='.$charge->id.'&product='.$charge->description);



?>