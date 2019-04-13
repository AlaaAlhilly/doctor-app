<?php 

 include 'header.php';
 
?>

        <div class='col-md-8'>
        <div class='card'>
            <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>

                 <h4>Register Appointment</h4>
            </div>
            <div class="card-body">
                 <form action="charge.php" method="post" id="payment-form">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter patient first name" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter patient last name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
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
                            <select id="country" name ="country"></select>             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">State</label>
                        <div class="form-group">
                        <select name ="state" id ="state"></select> 
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                                <label>Date</label>    
                                <div class="form-group">
                                    <input id="date" type="text" readonly="" data-field="datetime">&nbsp;<i style='display:none' id="reset" class="fas fa-undo"></i>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="select">Select Time</label>
                                        <select id="time_av" class="form-control">      
                                        </select>
                                    </div>
                                </div>
                                <div  class="col-md-6">
                                    <h5><strong>Doctor</strong></h5>
                                    <h3 id="doc"></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display:none" class="form-group">
                        <label for="phone">doctor</label>
                        <div class="form-group">
                        <input type="text" class="form-control" id="doctor" name="drname" readonly placeholder="Appointment Doctor" required>
                        </div>
                    </div>
                    <div style="display:none" class="form-group">
                        <label for="phone">date</label>
                        <div class="form-group">
                        <input type="text" class="form-control" id="docdate" name="app_date" readonly placeholder="Appointment Doctor" required>
                        </div>
                    </div>
                    <div style="display:none" class="form-group">
                        <label for="phone">time</label>
                        <div class="form-group">
                        <input type="text" class="form-control" id="doctime" name="time_select" placeholder="Appointment Doctor" required>
                        </div>
                    </div>
                    
                    <div id="card-element" class="form-control">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    <div class="form-group">
                    <button name="save_pat" class='btn btn-primary btn-block mt-4' >Register Appointment</button>
                    </div>
                </form>
                    <div id="dtBox" class="dtpicker-overlay dtpicker-mobile" style="display: none;"><div class="dtpicker-bg"><div class="dtpicker-cont"><div class="dtpicker-content"><div class="dtpicker-subcontent"></div></div></div></div></div>
                    </div>
                    </div>
    </div>
    <div class="col-md-1"></div>
    </div>
    </div>
    <!--external scripts-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--moment js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script><!--local scripts-->
    <!--phone field helper script-->
    <script src="../assets/js/formhelper.js"></script>
    <!--date and time picker script-->
    <script src="../assets/js/DateTimePicker.js"></script>
    <script type= "text/javascript" src = "../assets/js/countries.js"></script>
    <!--create address countries -->
    <script>
        populateCountries("country", "state"); // first parameter is id of country drop-down and second parameter is id of state drop-down
    </script>
    <!-- pament js-->
    <script src="https://js.stripe.com/v3/"></script>
    <!--app script-->
    <script src="../assets/js/app.js"></script>
</body>
</html>
                