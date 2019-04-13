<?php
if(!empty($_GET['tid']) && !empty($_GET['product'])){
    $GET = filter_var_array($_GET,FILTER_SANITIZE_STRING);

    $tid = $GET['tid'];
    $product = $GET['product'];
}else{
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Success Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="main.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Payment Processed Successfully <?php echo $product;?></h2>
        <h3>check your email for payment transaction</h3>
        <a href="admin-panel.php" class="btn">Go Back</a>
    </div>
</body>
</html>