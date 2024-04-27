<?php
    session_start();
    if(isset($_SESSION["user"])) {
        header("Location: dashboard.php");
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vehicle Registration</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>

    <body>
        <div class="container">
            <?php
                if(isset($_POST["login"])){
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    require_once "database.php";
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if($user) {
                        if(password_verify($password, $user["password"])){
                            header("Location: dashboard.php");
                            session_start();
                            $_SESSION["user"] = "yes";
                            header("Location: dashboard.php");
                            die();
                        } else {
                            echo "<div class='alert alert-danger'>Password does not match</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email does not match</div>";
                    }
                }
            ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter Email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter Password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </div>
            </form>
            <div><p>Don't Have an account yet?<a href="register.php"> Signup</a></p></div>
        </div>
    </body>
    <script src="assets/js/index.js"></script>
</html>