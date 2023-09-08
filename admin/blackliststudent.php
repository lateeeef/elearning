<?php
session_start();
include '../includes/config.php';
include '../includes/redirectadmin.php';
$error = [];
$matric = '';



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
        $('#studentDetails').removeClass('d-none')
    })
    </script>
    ";

    $matric = cleaninput($_GET['matric']);
    // $detail = cleaninput($_GET['detail']);

    $check = "SELECT * FROM `tblstudent` WHERE matric = '$matric'";
    $query = mysqli_query($connect, $check);


    if ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $student = $row['fname'];
    }


    if (mysqli_num_rows($query) == 0) {
        array_push($error, 'This student does not exist');
    }
    $checkStudent = "SELECT * FROM `blacklilststudent` WHERE matric = '$matric' ";
    $queryStudent = mysqli_query($connect, $checkStudent);
    if (mysqli_num_rows($queryStudent) > 0) {
        array_push($error, 'This Student is already blocked');
    }
};
if (isset($_GET['block'])) {
    $matric = $_GET['matric'];

    $check = "SELECT * FROM `tblstudent` WHERE matric = '$matric'";
    $query = mysqli_query($connect, $check);


    if ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $student = $row['fname'];
    }



    $sql = "INSERT INTO `blacklilststudent`(`name`, `matric`)
    VALUES ('$student', '$matric')";
    $queryIt = mysqli_query($connect, $sql);


    if ($queryIt) {
        // header('location:dashboard.php');
        echo "<script> if(alert('You have successfully blocked " . $student . " Student cannot access his/her account again unless you umblock him/her')){</script>";
    } else {
        echo "<script>alert('Unsuccessful')</script>";
    }
}
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
                    <p>Blocked Students will not be able to access their account until you unblock them.</p>
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
                                <label class="fw-bold" for="matric"></label>
                                <div class="col-md- ">
                                    <input class="form-control " type="text" name="matric" id="matric" placeholder="Enter Matric No. " value="<?= $matric ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-">
                            <input type="submit" value="Search" name="search" class="btn btn-primary">
                        </div>
                        <div class="d-none card mt-4" id="studentDetails">
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
                                    <div class="fw-bold"> <?php echo $student ?></div>
                                </div>

                                <div class="px-5">

                                    <p><span class="fw-bold">Email: </span><?php echo $row['email'] ?></p>
                                    <p><span class="fw-bold">Phone: </span><?php echo $row['phone'] ?></p>
                                    <p><span class="fw-bold">Department: </span><?php echo $row['department'] ?></p>
                                    <p><span class="fw-bold">Level: </span><?php echo $row['level'] ?></p>
                                </div>
                                <div class="text-center mb-4">
                                    <input class="btn btn-outline-danger" type="submit" value="Block" name="block">
                                    <!-- <a href="<?= $_SERVER['PHP_SELF'] ?>?block=1" class="btn btn-outline-danger" type="submit" name="block" value="Block"> Block Student</a> -->
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
        $('#studentDetails').removeClass('d-none')
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