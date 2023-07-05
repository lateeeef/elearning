<?php
session_start();
include 'includes/redirect.php';
include 'includes/config.php';
$error = [];

$filename = '';
// print_r($_SESSION);
// print_r($_FILES);

if (isset($_POST['submit'])) {

    $student = $_SESSION['fname'];
    $matric = $_SESSION['matric'];

    $filename = $_FILES['photo']['name'];
    $filesize = $_FILES['photo']['size'];
    $filepath = 'uploads/' . $filename;
    $ext = pathinfo($filepath, PATHINFO_EXTENSION);

    $extArray = ['png', 'jpg', 'jpeg'];
    if (!in_array($ext, $extArray)) {
        array_push($error, 'Invalid Extension');
    }
    if ($filesize > 5000000) {
        array_push($error, 'File is too large');
    }
    if (file_exists($filepath)) {
        array_push($error, 'The file alredy exists');
    }

    if (count($error) == 0) {
        $sql = "UPDATE `tblstudent` SET `image`='$filename' WHERE fname = '$student' AND matric = '$matric'";
        $query = mysqli_query($connect, $sql);

        // upload the file
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
            echo "<script> alert ('Photo Successfully Uploaded. Photo will appear when you login again.')</script>";
        } else {
            echo "<script> alert ('Failed')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Student -- Web-based Learning System, ADUN</title>
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
                <div class="card p-3">
                    <div class="mb-3">
                        <div>
                            <h5>Personal Details</h5>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between p-2" style="background-color: whitesmoke;">
                                <h6>Personal Details</h6>
                                <a style="font-size: 8px;" class="btn  btn-primary disabled" href="#">EDIT</a>
                            </div>
                            <div class="px-2">
                                <div>
                                    <h6>Name</h6>
                                    <p><?php echo $_SESSION['fname'] ?></p>
                                </div>
                                <div>
                                    <h6>Department</h6>
                                    <p><?php echo $_SESSION['department'] ?></p>
                                </div>
                                <div>
                                    <h6>Matric Number</h6>
                                    <p style="text-transform: uppercase;"><?php echo $_SESSION['matric'] ?></p>
                                </div>
                                <div>
                                    <h6>Level</h6>
                                    <p><?php echo $_SESSION['level'] ?></p>
                                </div>
                                <div>
                                    <h6>Email</h6>
                                    <p><?php echo $_SESSION['email'] ?></p>
                                </div>
                                <div>
                                    <h6>Phone</h6>
                                    <p><?php echo $_SESSION['phone'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5" id="upload">
                        <div class="mt-3 mb-3">
                            <?php foreach ($error as $errors) {
                                echo '
                            <div class="container-sm  px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                <b>Error: </b>' . $errors . '
                            </div>';
                                echo '';
                            } ?>
                        </div>
                        <?php
                        if($_SESSION['image'] != ''){
                            $disable = 'disabled';
                            $secondary = 'text-secondary';
                            $upload = 'Uploaded';
                        }else{
                            $disable = '';
                            $secondary = '';
                            $upload = 'Upload';
                        }
                        ?>
                        <div class="<?=$secondary?>">
                            <h5>Update Profile Picture</h5>
                        </div>
                        <form class="px-2" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="fw-bold mb-3 p-2 w-100 <?=$secondary?> " for="photo" style="background-color: whitesmoke;">Choose a decent photo else your account might be blocked by the admin</label>
                                <input class="form-control mb-3" type="file" name="photo" id="photo" <?=$disable?>>
                            </div>
                            <div class="text-center">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?=$upload?>" <?=$disable?> required>
                            </div>
                            <p class="text-danger small ">NOTE: Photos uploaded can not be changed</p>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </main>
    <!-- <script>
        $(document).ready(function() {
            $('form').addClass('text-seondary')

        })
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>