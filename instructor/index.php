<?php
session_start();
include '../includes/config.php';
$staffid = '';
$error = [];

if (isset($_POST['signin'])) {

    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }


    $staffid = cleaninput($_POST['staffid']);
    $password = cleaninput($_POST['password']);

    $check = "SELECT * FROM tblstaff WHERE staffid = '$staffid'";
    $query = mysqli_query($connect, $check);

    $encryptpassword = md5($password);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    // print_r($row);
    // echo $encryptpassword;

    if (mysqli_num_rows($query) == 1 && $encryptpassword == $row['password']) {
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['department'] = $row['department'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['staffid'] = $row['staffid'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['image'] = $row['image'];

        header('location:dashboard.php');
    } else {
        array_push($error, 'Incorrect Password or staffid');
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Signin -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>
    <main class="container-sm col-lg-7 bg-white px-3 py-4 shadow text-center" style="margin-top: 100px;">
        <div class=" d-md-none">
            <img height="100" width="150" src="../images/adunlogo.jpg" alt="adunlogo">
        </div>
        <div class="d-flex align-items-center justify-content-around py-5">
            <div class="d-none d-md-block">
                <img height="250" width="300" src="../images/adunlogo.jpg" alt="adunlogo">
            </div>
            <div class="col-md-6 col-12">
                <h3 class="mb-4">Staff Login</h3>

                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="mt-3 mb-3">
                    <?php foreach ($error as $errors) {
                        echo '
                            <div class="container-sm  px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                <b>Error: </b>' . $errors . '
                            </div>';
                        echo '';
                    } ?>
                </div>

                    <div>
                        <input class="form-control mb-3" type="number" name="staffid" id="" required placeholder=" Staff ID" value="<?=$staffid?>">
                    </div>
                    <div>
                        <input class="form-control mb-3" type="password" name="password" id="" required placeholder="******">
                    </div>
                    <input class="btn btn-primary w-100 mb-3" type="submit" name="signin" value="Sign In">
                </form>
                <a class="text-decoration-none" href="signup.php">Create your account</a>
            </div>
        </div>
    </main>
</body>

</html>