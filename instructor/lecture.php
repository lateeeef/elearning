<?php
session_start();
include '../includes/redirectstaff.php';

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
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
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

            <div class="col-md-9 bg-">
            <?php  include '../includes/title.php' ?>

                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="note.php" class="text-decoration-none text-dark stretched-link d-flex align-items-center my-2">
                                <iconify-icon class="me-2" icon="iconoir:send-dollars" width="28" height="28"></iconify-icon>
                                <div>Write Notes</div>
                            </a>
                        </li>
                        <li class="list-group-item ">
                            <a href="handoutupload.php" class="text-decoration-none text-dark stretched-link d-flex align-items-center my-2">
                                <iconify-icon class="me-2" icon="ph:money" width="28" height="28"></iconify-icon>
                                <div>Upload a file</div>
                            </a>
                        </li>
    
                    </ul>
                </div>
    
    
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>