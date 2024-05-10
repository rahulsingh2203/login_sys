<?php
$showAlert = false; //default
$showError = false; //default

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'partials/_dbconnect.php';
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $exist = false; //default
    $existSql = "SELECT * FROM `userdata` WHERE username = '$userName'"; //check whether username exist or not
    $result = mysqli_query($conn, $existSql);
    $numExistRow = mysqli_num_rows($result);

    if ($numExistRow > 0) {
        $exist = true;
        $showError = "Username already exist...";
    } else {
        $exist = false;
        if ($password == $cpassword) // condition to check both passwords are correct or not
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `userdata` (`username`, `password`, `dateandtime`) VALUES ('$userName', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match...";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php';  ?>

    <?php
    if ($showAlert) {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hurray!</strong> Your account has been created...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }
    if ($showError) {

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Opps!</strong> ' . $showError . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Signup to our website</h1>
        <form action="/login_sys/signup.php" method="POST">
            <div class="mb-3 col-md-6">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" maxlength="11" class="form-control" id="userName" name="userName" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Set Password</label>
                <input type="password" maxlength="260" minlength="8" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="260" minlength="8" class="form-control" id="cpassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>