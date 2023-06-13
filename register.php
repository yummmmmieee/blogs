<?php 
$register_page = true; //set a variable as a trigger for the if statement on the header 
include 'header.php'; 

if(isset($_SESSION['logged_in'])){
    header('Location: blogs.php');
}

if (isset($_POST['register'])) {
    //get the data from the registration form
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $row = $conn->prepare("SELECT * FROM users WHERE email = ? ");
    $row->execute([$email]);

    if ($row->rowCount() >= 1) { //check if email is already in the database
        $message = "Email Already registered"; //error message
    } elseif ($password != $confirm_password) { //test if password is the same
        $message = "Password do not match";
    } else {
        //encrypt the password before saving to database
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        //insert to DB
        $insert = $conn->prepare("INSERT INTO users(first_name, last_name, email, password) VALUES(?, ?, ?, ?)");
        //data binding
        $insert->execute([
            $first_name,
            $last_name,
            $email,
            $hashed
        ]);

        $message = "Successfully registered!";
    }
}
?>
<body style="background-color:lightgray;">
<div class="row justify-content-center">
    <div class="col-5 mt-4 mb-5 shadow p-4" style="background-color:#ddeedd;">
        <?php
        if (isset($message)) { ?>
            <div class="alert alert-info" role="alert">
                <?= $message; ?>
            </div>
        <?php   }
        ?>
        <h2 class="text-center" >REGISTER</h2>
        <form action="register.php" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">First name</label>
                <input type="text" class="form-control" id="validationCustom01" name="fname" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustom02" class="form-label">Last name</label>
                <input type="text" class="form-control" id="validationCustom02" name="lname" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="email" required>
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Password</label>
                <input type="password" class="form-control" id="validationCustom01" name="password" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationCustom01" class="form-label">Confirm-Password</label>
                <input type="password" class="form-control" id="validationCustom01" name="confirm_password" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="register">Register</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>