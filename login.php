 <?php
session_start();
include 'includes/config.php';
$matric = '';
$error = [];
// print_r($_POST);
if (isset($_POST['login'])) {

    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }


    $matric = cleaninput($_POST['matric']);
    $password = cleaninput($_POST['password']);

    $check = "SELECT * FROM tblstudent WHERE matric = '$matric'";
    $query = mysqli_query($connect, $check);

    $encryptpassword = md5($password);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    // print_r($row);
    // echo $encryptpassword;

    if (mysqli_num_rows($query) == 1 && $encryptpassword == $row['password']) {
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['department'] = $row['department'];
        $_SESSION['matric'] = $row['matric'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['image'] = $row['image'];
        $_SESSION['password'] = $row['password'];

        header('location:dashboard.php');

    } else {
        array_push($error, 'Incorrect Password or Matric Number');
    }

    // setcookie('email', $email, time() + 1579, '/');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students login</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>
<body> 
    <main class="container-sm col-lg-7 bg-white px-3 py-4 shadow text-center" style="margin-top: 100px;">
        <div class=" d-md-none">
            <a href="index.php" title="Go Home">
                <img height="100" width="150" src="images/adunlogo.jpg" alt="adunlogo">
            </a>
        </div>
        <div class="d-flex align-items-center justify-content-around py-5">
            <div class="d-none d-md-block">
                <a href="index.php" title="Go Home">
                    <img height="250" width="300" src="images/adunlogo.jpg" alt="adunlogo">
                </a>
            </div>
            <div class="col-md-6 col-12">
                <h3 class="mb-4">Student Login</h3>
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
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
                        <input class="form-control mb-3" type="text" name="matric" id="" required placeholder="Reg/Matric No." value="<?=$matric?>">
                    </div>
                    <div>
                        <input class="form-control mb-3" type="password" name="password" id="" required placeholder="******">
                    </div>
                    <input class="btn btn-primary w-100 mb-3" type="submit" name="login" value="Login">
                </form>
                <a class="text-decoration-none" href="register.php">Create your account</a>
            </div>
        </div>
    </main>
</body>
</html>