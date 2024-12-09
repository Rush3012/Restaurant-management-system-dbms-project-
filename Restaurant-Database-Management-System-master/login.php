
<?php
require('db.php'); // Include the database connection
session_start(); // Start the session

// If the form is submitted
if (isset($_POST['email'])) {

    // Fetch and sanitize user inputs
    $email = stripslashes($_REQUEST['email']); // Remove backslashes
    $email = mysqli_real_escape_string($con, $email); // Escape special characters
    $password = stripslashes($_REQUEST['password']); // Remove backslashes from password
    $password = mysqli_real_escape_string($con, $password); // Escape special characters in password

    // Debugging (Optional: Remove in production)
    // echo "Email: " . $email . "<br>";
    // echo "Password: " . $password . "<br>";

    // **Check Admin Table**: If the user is an admin, redirect them to the admin page
    $query_admin = "SELECT * FROM `admin` WHERE email='$email' AND password='" . md5($password) . "'";
    $result_admin = mysqli_query($con, $query_admin) or die(mysqli_error($con));

    if (mysqli_num_rows($result_admin) == 1) {
        $_SESSION['email'] = $email; // Store email in session
        $_SESSION['role'] = 'admin'; // Set role to admin
        header("Location: control.php"); // Redirect to admin control page
        exit();
    }

    // **Check Customer Table**: If the user is a customer, redirect them to the customer page
    $query_customer = "SELECT * FROM `customer` WHERE email='$email' AND password='" . md5($password) . "'";
    $result_customer = mysqli_query($con, $query_customer) or die(mysqli_error($con));

    if (mysqli_num_rows($result_customer) == 1) {
        $_SESSION['email'] = $email; // Store email in session
        $_SESSION['role'] = 'customer'; // Set role to customer
        header("Location: index.php"); // Redirect to customer homepage
        exit();
    }

    // **Error Message**: If no match is found in both tables
    echo "<div class='form'><h3>Invalid email or password.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="./css/style1.css">
    <title>Login</title>
</head>

<body>
    <div data-aos="fade-down" class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="post" action="" name="login">
                <h1 style="padding-bottom: 20px">Sign in</h1>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <a href="#">Forgot your password?</a>
                <span style="padding-top: 10px"><button>Login</button></span>
                <p>Not registered yet? <a href='registration.php' style="color:#FF0000;font-weight:bold;">Register Here</a></p>
            </form>
        </div>
    </div>

    <div class="landing"> <!---background-->
        <div class="opac"></div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="index.html">Baker's Street</a>
        </p>
    </footer>
    <script src="./js/main.js"></script>
</body>

</html>

