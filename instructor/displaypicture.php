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
    <title>Staff Settings/Set a display picture -- Web-based Learning System, ADUN</title>
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

                <?php
                if ($_SESSION['image'] != '') {
                    echo "<script>
                    $(document).ready(function() {
                        $('label').addClass('text-secondary')
                        $('.btn-upload').addClass('disabled')
                    })
                    </script>
                    ";
                    $disable = 'disabled';
                } else {
                    $disable = '';
                }
                ?>

                <form class="card p-3" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="fw-bold mb-3" for="photo">Choose a decent profile picture or your account might be blocked by the admin</label>
                        <input class="form-control mb-3" type="file" name="photo" id="photo"  <?= $disable ?>>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary btn-upload" type="submit" value="Upload">
                    </div>
                    <p class="text-danger small">NOTE: Photos uploaded can not be changed</p>
                </form>


            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>