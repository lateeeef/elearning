<?php
session_start();
include '../includes/config.php';
include '../includes/redirectstaff.php';

// print_r($_SESSION)

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location:dashboard.php');
}
$id = $_GET['id'];

$sql = "SELECT * FROM `lesson` WHERE id = '$id'";
$query = mysqli_query($connect, $sql);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql1 = "DELETE FROM `lesson` WHERE id =  '$id'";
    $query1 = mysqli_query($connect, $sql1);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboaard -- Admiralty University Of Nigeria Web-based system for distance learning</title>
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


                <div class="card mb-3">
                    <?php
                    $row = mysqli_fetch_assoc($query)
                    ?>
                    <div class="card my-1 p-3">
                        <div class="text-decoration-none text-dark row">
                            <div class="col-md-3"><span class="fw-bold">Course title: </span><?php echo $row['course'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Course code: </span><?php echo $row['code'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Department: </span><?php echo $row['department'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Level: </span><?php echo $row['level'] ?></div>
                            <div class="col-md-3"><span class="fw-bold">Topic: </span><?php echo $row['topic'] ?></div>
                            <div class="col-md-5"><span class="fw-bold">Date Uploaded: </span><?php echo $row['date_added'] ?></div>
                            <div class="my-2">
                                <div class="fs-5"><?php echo $row['note'] . $row['pdf'] ?></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" class="btn btn-outline-danger" onclick='if(confirm("Are you sure you want to delete lesson?"))
                            {location.href="<?=$_SERVER["PHP_SELF"]?>?delete=<?=$row["id"]?>"}'>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>