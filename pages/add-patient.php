
<?php
include 'header.php';
?>
 <div class='col-md-8'>
 <div class='card'>
    <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
        <div class='row'>
            <div class='col-md-12'>
                <h4>New Patient</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-group" method="post" action="charge.php">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter patient first name" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter patient last name" required>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" vlue="@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <div class="form-group">
                <input type="text" class="input-medium bfh-phone" name="phone" data-format="+1 (ddd) ddd-dddd" required>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label style="margin-bottom:0px">Address</label>
            <hr>
        </div>
        <div class="form-group">
            <label for="phone">Street address</label>
            <div class="form-group">
                <input type="text" class="form-control" name="street" placeholder="Ex: 4242 N Kimball av" required>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">City</label>
            <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="Ex: skokie...etc" required>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Zip</label>
            <div class="form-group">
            <input type="text" class="input-medium bfh-phone" name="zip" data-format="ddddd" required>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Country</label>
            <div class="form-group">
            <select id="country" name ="country"></select>             </div>
        </div>
        <div class="form-group">
            <label for="phone">State</label>
            <div class="form-group">
            <select name ="state" id ="state"></select> 
        </div>
        <div class="form-group">
            <input id="save_patient" type="submit" class="btn btn-primary" value="Save"/>
        </div>
        </form>
        </div>
        <?php include 'footer.php';?>
