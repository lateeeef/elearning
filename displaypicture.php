<?php
session_start();
include 'includes/redirect.php';

// print_r($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings/Upload a passport -- Web-based Learning System, ADUN</title>
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
        <div class="row">
            <div class="px-2 col-md-2 text- " style="background-color: rgb(12,19,44);">
                <?php include 'includes/studentaside.php' ?>
            </div>

            <div class=" col-md-10 bg- ">
                <?php include 'includes/title.php' ?>

                <form class="card p-3" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="fw-bold mb-3" for="photo">Choose a decent photo or your account might be blocked by the admin</label>
                        <input class="form-control mb-3" type="file" name="photo" id="photo">
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" value="Upload">
                    </div>
                    <p class="text-danger small">NOTE: Photos uploaded can not be changed</p>
                </form>


            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>