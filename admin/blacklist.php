<?php
session_start();
include '../includes/config.php';
include '../includes/redirectadmin.php';
$error = [];
$staffid = '';



// print_r($_SESSION);q

if (isset($_GET['search'])) {
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    echo "<script>
    $(document).ready(function() {
        $('#staffDetails').removeClass('d-none')
    })
    </script>
    ";

    $staffid = cleaninput($_GET['staffid']);
    // $detail = cleaninput($_GET['detail']);

    $check = "SELECT * FROM `tblstaff` WHERE staffid = '$staffid'";
    $query = mysqli_query($connect, $check);


    if ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $staffFullname = $row['fname'] . ' ' . $row['lname'];
    }


    if (mysqli_num_rows($query) == 0) {
        array_push($error, 'This Staff does not exist');
    }
    $checkStaff = "SELECT * FROM `blacklist` WHERE staffid = '$staffid' ";
    $queryStaff = mysqli_query($connect, $checkStaff);
    if (mysqli_num_rows($queryStaff) > 0) {
        array_push($error, 'This Staff is already blocked');
    }
};
if (isset($_GET['block'])) {
    $staffid = $_GET['staffid'];

    $check = "SELECT * FROM `tblstaff` WHERE staffid = '$staffid'";
    $query = mysqli_query($connect, $check);


    if ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $staffFullname = $row['fname'] . ' ' . $row['lname'];
    }



    $sql = "INSERT INTO `blacklist`(`fname`, `staffid`)
    VALUES ('$staffFullname', '$staffid')";
    $queryIt = mysqli_query($connect, $sql);



    if ($queryIt) {
        // header('location:dashboard.php');
        echo "<script>if(alert('You have successfully blocked " . $staffFullname . " Staff cannot access his/her account again unless you umblock him/her')){</script>";
    } else {
        echo "<script>alert('Unsuccessful')</script>";
    }
}
// echo count($error);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Block Student ADUN -- Web-based Learning System</title>
    <link rel="shortcut icon" href="../images/adunlogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body style="background: #e4e2e2;">

    <header>
        <?php include '../includes/adminheader.php' ?>
    </header>


    <main class="container-fluid">
        <div class="row">
            <div class="px-2 col-md-3">
                <?php include '../includes/adminaside.php' ?>
            </div>

            <div class=" col-md-9 bg-white ">
                <?php include '../includes/title.php' ?>

                <div class="mb-2 p-2">
                    <p>Blocked Staff will not be able to access your course until you unblock them.</p>
                    <div class="my-3">
                        <?php foreach ($error as $errors) {
                            echo '
                                <div class="container-sm col-lg-4 px-2 py-2 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                    <b>Error: </b>' . $errors . '
                                </div>';
                            echo '';
                        } ?>
                    </div>


                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" class="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fw-bold" for="staffid"></label>
                                <div class="col-md- ">
                                    <input class="form-control " type="text" name="staffid" id="staffid" placeholder="Enter StaffId " value="<?= $staffid ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-">
                            <input type="submit" value="Search" name="search" class="btn btn-primary">
                        </div>
                        <div class="d-none card mt-4" id="staffDetails">
                            <div id="content">
                                <?php

                                if ($row['image'] == '') {
                                    $image = '../images/default.jpg';
                                } else {
                                    $image = "../uploads/" . $row['image'];
                                }
                                // echo $image
                                ?>

                                <div class=" p-3 d-flex align-items-center justify-content-center mb-4">
                                    <div><img src="<?= $image ?>" alt="" class="rounded-pill me-2 " width="55" height="55"></div>
                                    <div class="fw-bold"> <?php echo $staffFullname ?></div>
                                </div>

                                <div class="px-5">

                                    <p><span class="fw-bold">Email: </span><?php echo $row['email'] ?></p>
                                    <p><span class="fw-bold">Phone: </span><?php echo $row['phone'] ?></p>
                                    <p><span class="fw-bold">Department: </span><?php echo $row['department'] ?></p>
                                    <p><span class="fw-bold">Level: </span><?php echo $row['level'] ?></p>
                                </div>
                                <div class="text-center mb-4">
                                    <input class="btn btn-outline-danger" type="submit" value="Block" name="block">
                                    <!-- <a href="<?= $_SERVER['PHP_SELF'] ?>?block=1" class="btn btn-outline-danger" type="submit" name="block" value="Block"> Block Staff</a> -->
                                </div>

                            </div>

                        </div>
                    </form>

                </div>
            </div>



            <?php
            if (isset($_GET['search'])  && count($error) == 0) {
                echo "<script>
    $(document).ready(function() {
        $('#staffDetails').removeClass('d-none')
    })
    </script>
    ";
            }


            ?>

        </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>