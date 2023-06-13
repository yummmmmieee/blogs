<?php 
$login_page = true; //set a variable as a trigger for the if statement on the header 
include 'header.php';

if(isset($_SESSION['logged_in'])){
    header('Location: blogs.php');
}


?>
<script>
    <?php 
        if (!isset($_GET['code']) OR !isset($_GET['password'])) {
    ?>
    $(document).ready(function() {
        $('#code_div').hide();
        $('#email_div').show();
    });
    <?php
        }
    ?>

    <?php 
        if (isset($_GET['code'])) {
    ?>
    $(document).ready(function() {
        $('#code_div').show();
        $('#email_div').hide();
        $('#pass_div').hide();
    });
    <?php
        }
    ?>

    <?php 
        if (isset($_GET['password'])) {
    ?>
    $(document).ready(function() {
        $('#pass_div').show();
        $('#email_div').hide();
        $('#code_div').hide();
    });
    <?php
        }
    ?>

    <?php 
        if (isset($_GET['success'])) {
    ?>
    $(document).ready(function() {
        $('#success_div').show();
        $('#pass_div').hide();
        $('#email_div').hide();
        $('#code_div').hide();
    });
    <?php
        }
    ?>

    
</script>
<div class="row justify-content-center">
    <h2 class="text-center mt-4">Reset Password</h2>
    <div id="email_div" class="col-4"  style="display:none">
        <form action="forgot-password.php?code" method="POST" class="shadow p-4 mt-3 rounded"style="background-color:#ddeedd;">
            <h4 class="text-center mt-1 mb-3">Enter Email</h4>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-2 mt-3">
                <button name="login" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <div id="code_div" class="col-4"  style="display:none">
        <form action="forgot-password.php?password" method="POST" class="shadow p-4 mt-5 rounded" >
            <h4 class="text-center mt-1 mb-3">Enter code</h4>
            <p>A 6-digit verification code has been sent to the Email.</p>
            <div class="form-group mb-1">
                <label for="password">Enter code</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="Enter code" required>
            </div>
            <div class="form-group mb-2 mt-3">
                <button name="login" class="btn btn-primary">Verify</button>
            </div>
        </form>
    </div>
    <div id="pass_div" class="col-4"  style="display:none">
        <form action="forgot-password.php?success" method="POST" class="shadow p-4 mt-5 rounded">
            <h4 class="text-center mt-1 mb-3">New Password</h4>
            <div class="form-group mb-3">
                <label for="password">Enter new password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
            </div>
            <div class="form-group mb-">

                <label for="password">Repeat new password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Repeat password" required>
            </div>
            <div class="form-group mb-2 mt-3">
                <button name="login" class="btn btn-primary">Verify</button>
            </div>
        </form>
    </div>
    <div id="success_div" class="col-4"  style="display:none">
        <form class="shadow p-4 mt-5 rounded">
            <h4 class="text-center mt-1 mb-3">Password changed!</h4>
            <div class="row justify-content-center mb-2 mt-4 px-3">
                <a href="login.php" class="btn btn-primary">Go back to Login Page</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>