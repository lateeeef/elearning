<?php
session_start();
include '../includes/redirect.php';
include '../includes/config.php';

$title = '';
$message = '';
$sender = '';
$error = [];

// print_r($_SESSION);
if(isset($_GET['submit'])){
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    $title = cleaninput($_GET['title']);
    $message = cleaninput($_GET['message']);
    $sender = $_SESSION['fname'] .' '. $_SESSION['lname'];
    $staffId = $_SESSION['staffid'];


    $check = "SELECT * FROM report WHERE sender = '$sender' AND message = '$message'";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'Message already sent');
    }

    if(count($error) == 0){
        $sql = "INSERT INTO `report`(`sender`, `title`, `message`, `staffid`) VALUES ('$sender','$title', '$message', '$staffId')";
        $query = mysqli_query($connect, $sql);

        echo "<script> alert('Message sent successfully.')</script>";
        header("location:dashboard.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
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

            <div class=" col-md-9 bg-white ">
                <?php  include '../includes/title.php' ?>
                
                <form class="p-3" action="#" method="get">
                <div class="mt-3">
                    <?php foreach ($error as $errors) {
                        echo '
                            <div class="container-sm col-lg-7 mb-2 px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                <b>Error: </b>' . $errors . '
                            </div>';
                        echo '';
                    } ?>
                </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="title">Title</label>
                        <input class="form-control" name="title" type="text" placeholder="Title of the Report" required>
                    </div>
                    <div  class="form-group mb-3">
                        <label class="fw-bold mb-2" for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary" name="submit" type="submit" value="Submit">
                    </div>
                </form>

            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>