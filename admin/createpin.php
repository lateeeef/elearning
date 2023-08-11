<?php
session_start();
include '../includes/config.php';
include '../includes/redirectadmin.php';
// print_r($_POST);

$error = [];
$idStaff = '';
$pin = '';

if(isset($_POST['generate'])){
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    $idStaff = cleaninput($_POST['staffid']);
    $pin = cleaninput($_POST['pin']);

    $check = "SELECT * FROM staffpin WHERE pin = '$pin' OR staffid = '$idStaff'";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'Staff already assigned a PIN/PIN already exist');
    }elseif(strlen($pin) != 6){
        array_push($error, 'PIN must contain 6 digits only');
    }
    $checkStaff = "SELECT * FROM tblstaff WHERE staffid = '$idStaff'";
    $queryIt = mysqli_query($connect, $checkStaff);
    if (mysqli_num_rows($queryIt) > 0) {
        array_push($error, 'Staff already has an account');
    }

    if(count($error) == 0){
        $sql = "INSERT INTO `staffpin`( `staffid`, `pin`) 
        VALUES ('$idStaff', '$pin')";
        $query = mysqli_query($connect, $sql);

        echo "<script> alert ('Successfully Generated a PIN ')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATIVE DASHBOARD ADUN -- Web-based Learning System</title>
    <link rel="shortcut icon" href="../images/adunlogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body style="background: #e4e2e2;">
    <header>
        <?php include '../includes/header.php' ?>
    </header>


    <main class="container-fluid">
        <div class="row">
            <div class="px-2 col-md-3">
                <?php include '../includes/adminaside.php' ?>
            </div>

            <div class=" col-md-9 bg- ">
                <?php include '../includes/title.php' ?>

                <div class="card px-3 py-2">
                    <p>Create a 6-digits Access PIN for a Staff </p>
                    <div class="mt-3">
                    <?php foreach ($error as $errors) {
                        echo '
                            <div class="container-sm col-lg-7  px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                <b>Error: </b>' . $errors . '
                            </div>';
                        echo '';
                    } ?>
                </div>

                    <form action="#" method="post">
                        <div>
                            <label class="mb-1" for="staffid">Staff ID</label>
                            <input class="form-control mb-3" type="number" name="staffid" id="" required placeholder="Staff Identification No." value="<?=$idStaff?>">
                        </div>
                        <div>
                            <label class="mb-1" for="pin">PIN</label>
                            <input class="form-control mb-3" type="number" name="pin" id="pin" required placeholder="******" value = "<?=$pin?>">
                        </div>
                        <div class="text-center">
                            <input class="btn btn-secondary" name="generate" type="submit" value="Generate">
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>