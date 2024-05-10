<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'partials/_dbconnect.php';
    $userName = $_POST["userName"];
    $password = $_POST["password"];

    //$sql = "SELECT * FROM `userdata` WHERE username = '$userName' AND password = '$password'";
    $sql = "SELECT * FROM `userdata` WHERE username = '$userName'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $userName;
                header("location: welcome.php");
            } else {
                $showError = "Invalid credentials";
            }
        }
    } else {
        $showError = "Invalid credentials";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require 'partials/_nav.php';  ?>

    <?php
    if ($login) {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hurray!</strong> You are logged in...
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
        <h1 class="text-center">Login to our website</h1>
        <form action="/login_sys/login.php" method="POST">
            <div class="mb-3 col-md-6">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="userName" name="userName" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>