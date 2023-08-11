<?php
session_start();
include '../includes/redirectstaff.php';

// print_r($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profle  -- Web-based Learning System, ADUN</title>
    <link rel="shortcut icon" href="../images/adunrbg.png" type="image/x-icon">
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
                <?php include '../includes/staffaside.php' ?>
            </div>

            <div class=" col-md-9 bg- ">
                <?php include '../includes/title.php' ?>

                <div class="card">
                    <main class="container-sm col-lg-12 my-3 bg-white px-3 pt-4 pb-2  position-relative ">

                        <div class="text-center">
                            <a href="#" class="text-center text-black">
                                <?php
                                if (!isset($_SESSION['image'])  || $_SESSION['image'] != '') {
                                    $image = "../images/default.jpg";
                                } else {
                                    $image = '../uploads/'.$_SESSION['image'];
                                }
                                ?>
                                <img src="<?= $image ?>" alt="" class="rounded my-2" width="130" height="130">
                            </a>
                            <div class="fs-4 fw-bold"><?php echo $_SESSION['lname'].' '.$_SESSION['fname'] ?></div>
                            <p class="mb-1"></p>
                        </div>

                        <div class="container fs-5">
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Firstname</div>
                                <div class="col-9 "><?php echo $_SESSION['fname'] ?></div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Lastname</div>
                                <div class="col-9 "><?php echo $_SESSION['lname'] ?></div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Email</div>
                                <div class="col-9 "><?php echo $_SESSION['email'] ?></div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Staff ID</div>
                                <div class="col-9 "><?php echo $_SESSION['staffid'] ?></div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Phone</div>
                                <div class="col-9 "><?php echo $_SESSION['phone'] ?></div>
                            </div>

                        </div>

                        <div class="text-center mt-4">
                        <a href="dashboard.php" class="btn btn-primary">Dashboaard</a>
                        </div>
                    </main>
                </div>


            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>