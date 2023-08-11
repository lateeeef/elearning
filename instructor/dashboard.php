<?php
session_start();
include '../includes/config.php';
include '../includes/redirectstaff.php';

// print_r($_SESSION)
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
                    <div class="row d-md-flex align-items-center justify-content-around ">
                        <div class="card col-md-5 m-4 p-4  text-center d-flex align-items-center justify-content-center ">
                            <iconify-icon icon="ic:baseline-play-lesson" width="90" height="90"></iconify-icon>
                            <a href="lecture.php" class="stretched-link text-decoration-none text-dark card-title fw-bold">Lecture</a>
                        </div>
                        <div class="card col-md-5 m-4 p-4 text-center d-flex align-items-center justify-content-center">
                            <iconify-icon icon="fa6-solid:users" width="90" height="90"></iconify-icon>
                            <a href="students.php" class="stretched-link text-decoration-none text-dark card-title fw-bold">Students</a>
                        </div>
                        <div class="card col-md-5 m-4 p-4 text-center d-flex align-items-center justify-content-center">
                            <iconify-icon icon="fluent:textbox-16-regular" width="90" height="90"></iconify-icon>
                            <a href="report.php" class="stretched-link text-decoration-none text-dark card-title fw-bold">Report</a>
                        </div>
                        <div class="card col-md-5 m-4 p-4 text-center d-flex align-items-center justify-content-center">
                            <iconify-icon icon="simple-line-icons:question" width="90" height="90"></iconify-icon>
                            <a href="#" class="stretched-link text-decoration-none text-dark card-title fw-bold">Excercise</a>
                        </div>
                    </div>

                </div>
                <div class="card p-3" id="materials">
                    <div class="fw-bold fs-5">Your Materials
                        <hr>
                    </div>
                    <div class="">
                        <div class="p-1 d-none" id="noMaterial" style="margin: 10px 0 ;">
                            <div class="fs-4 text-secondary fw-bold text-center">
                                You have no material uploaded yet
                            </div>
                        </div>
                        <div class="">
                            <?php
                            $staffId = $_SESSION['staffid'];
                            $sql = "SELECT * FROM `lesson` WHERE staffid = '$staffId' ORDER BY date_added DESC";
                            $query = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($query);
                            if ($count == 0) {
                                $sender = '';
                                $title = '';
                                $staffId = '';
                                echo "
                            <script>
                            $(document).ready(function(){
                                 $('#noMaterial').removeClass('d-none')
                            })
                            </script>
                            ";
                            };
                            while ($row = mysqli_fetch_assoc($query)) :
                            ?>
                                <div class="card my-1 p-3">
                                    <a class="text-decoration-none text-dark row" href="mybook.php?id=<?=$row['id']?>">
                                        <div class="col-md-3"><span class="fw-bold">Course title: </span><?php echo $row['course'] ?></div>
                                        <div class="col-md-3"><span class="fw-bold">Course code: </span><?php echo $row['code'] ?></div>
                                        <div class="col-md-3"><span class="fw-bold">Department: </span><?php echo $row['department'] ?></div>
                                        <div class="col-md-3"><span class="fw-bold">Level: </span><?php echo $row['level'] ?></div>
                                        <div class="col-md-3"><span class="fw-bold">Topic: </span><?php echo $row['topic'] ?></div>
                                        <div class="col-md-5"><span class="fw-bold">Date Uploaded: </span><?php echo $row['date_added'] ?></div>
                                        <div class="my-2">
                                            <div class="text-truncate"><?php echo $row['note'] . $row['pdf'] ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>

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