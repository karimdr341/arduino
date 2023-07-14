<?php
include "./connection.php";
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_escape_string($connection, $_POST['user-email']);
    $user_password = mysqli_escape_string($connection, $_POST['user-password']);
    $sql = "SELECT * FROM `authentication` WHERE `username`='$username'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $slno = "";
        $password = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $password = $row['password'];
            $slno = $row['slno'];
        }
        $password = password_verify($user_password, $password);
        if ($password == true) {
            session_start();
            $_SESSION['logedin'] = true;
            $_SESSION['slno'] = $slno;
            $_SESSION['profile'] = true;
            header("location:./dashboard.php");
        } else {
            $error = '<p class="error">Password Not Match</p>';
        }
    } else {
        $error = '<p class="error">User Not found</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Zerox</title>
    <link rel="stylesheet" href="./style.css">
    <!-- <link rel="stylesheet" href="./assets/nav.css"> -->
</head>

<body>

    <div class="login-section">
        <h2 class="login-heading">Login</h2>
        <form action="./index.php" method="POST" class="login-form">

            <input type="email" name="user-email" id="email" class="login-inputs" placeholder="Please Enter User Id" maxlength="50" required>
            <input type="password" name="user-password" id="password" class="login-inputs" placeholder="Please Enter Password" maxlength="50" required>
            <?php echo $error; ?>
            <p style="position: relative;font-size: 0.8rem;color: red;text-align: left;width: 100%;
    margin-top: -1.8rem;">*note (',",`) these are not allowed</p>
            <button class="submit" type="submit">Submit</button>

        </form>
    </div>



    <script>
        let email = document.getElementById('email')
        let submitBtn = document.getElementsByClassName('submit')[0]
        email.addEventListener('input', () => {
            if (email.value.indexOf("'") != "-1" || email.value.indexOf("\"") != "-1" || email.value.indexOf("`") != "-1") {
                submitBtn.disabled = true
            } else {
                submitBtn.disabled = false
            }
        })
    </script>

</body>

</html>