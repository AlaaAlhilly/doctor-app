<?php 
  include 'header.php';
?>
            <div class='col-md-8'>
                <div class='card'>
                    <div class='card-body' style='background-color:#3498D8;color:#ffffff;border-color:#3498D8'>
                        <div class='row'>
                            <div class='col-md-4'>
                                <h4>Remove Patient</h4>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="charge.php" method="post">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="form-group">
                                    <input type="text" class="input-medium bfh-phone" name="phone" data-format="+1 (ddd) ddd-dddd" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <button name="remove_pat" class='btn btn-primary btn-block mt-4'>Remove Patient</button>
                            </div>
                        </form>
                        <?php include 'footer.php';?>
