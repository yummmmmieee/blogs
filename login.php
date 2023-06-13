<?php 
$login_page = true; //set a variable as a trigger for the if statement on the header 
include 'header.php';

if(isset($_SESSION['logged_in'])){
    header('Location: blogs.php');
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $data->execute([$email]);

    if ($data->rowCount() > 0) {
        foreach ($data as $row) {
            if (password_verify($password, $row['password'])) {
                
                $_SESSION['user_id'] = $row['u_id']; //create a session variable named user_id and set it to the user_id
                $_SESSION['logged_in'] = true; //create a session variable named logged_in and set it to true

                header("location: blogs.php");
            } else {
                header("location: login.php?incorrect=email_or_password");
            }
        }
    } else {
        header("location: login.php?incorrect=email_or_password");
    }
}
?>
<body style="background-color:lightgray;">
<div class="row justify-content-center">
    <div class="col-4">
        <?php
        if (isset($_GET['incorrect'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "Incorrect email or password" ?>
            </div>
        <?php   }
        ?>
        <form action="login.php" method="POST" class="shadow p-4 mt-5 rounded"style="background-color:#ddeedd;">
            <h2 class="text-center mt-1 mb-3">PLEASE LOGIN</h2>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-1">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div> 
             <div class="form-group mb-4 mt-4">
                <button name="login" class="btn btn-success" style="margin-left:100px; padding-right: 50px;padding-left: 50px;border-radius: 20px;">Login</button>
             </div>
             <a class="text-decoration-none" href="register.php">Don't have an account?</a>&nbsp;&nbsp;&nbsp;&nbsp;
             <a class="text-decoration-none" href="forgot-password.php">Forgot Password?</a>
           
        </form>
    </div>
    </div>
</body>
</html>