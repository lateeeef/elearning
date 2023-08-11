<?php
session_start();
include 'includes/redirect.php';
include 'includes/config.php';

// print_r($_SESSION)
$id = $_GET['id'];

//redirect users if they try to access this page without a car id
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location:dashboard.php');
}

// $department = $_SESSION['department'];
// $level = $_SESSION['level'];
$id = $_GET['id'];

$sql = "SELECT * FROM `lesson` WHERE id = '$id' ";
$query = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessons -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php include 'includes/studentheader.php' ?>
    </header>


    <main class="container-fluid">
        <div class="row ">
            <div class="px-2 col-md-2 text- " style="background-color: rgb(12,19,44);">
                <?php include 'includes/studentaside.php' ?>
            </div>

            <div class="col-md-10 px-3">0----
                <?php
                include 'includes/title.php'
                ?>

                <?php
                while ($row = mysqli_fetch_assoc($query)) :
                ?>
                    <div class="card p-3" id="lesson">
                        <div class="row mb-1" style="text-transform: uppercase;">
                            <div class="col-md-3"><span class="fw-bold">Course: </span><?php echo $row['course'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Course code: </span><?php echo $row['code'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Department: </span><?php echo $row['department'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Lecturer: </span><?php echo $row['lecturer'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Topic: </span><?php echo $row['topic'] ?></div>
                            <div class="col-md-5"><span class="fw-bold">Date Uploaded: </span><?php echo $row['date_added'] ?></div>
                        </div>
                        <div class="my-2">
                            <div class=""><?php echo $row['note'] . $row['pdf'] ?></div>
                        </div>
                        <div>
                            <!-- <hr class="mx-5 "> -->
                        </div>
                    </div>
                <?php endwhile; ?>

                <div>
                </div>
            </div>
    </main>

    <script>
        $(document).ready(function() {

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>