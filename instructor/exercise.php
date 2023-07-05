<?php
session_start();
include '../includes/redirect.php';
include '../includes/config.php';

$question = '';
$answer = '';
$department = '';
$level = '';
$courseTitle = '';
$code = '';
$sender = '';
$error = [];

// print_r($_SESSION);
if (isset($_POST['submit'])) {
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    $question = cleaninput($_POST['question']);
    $answer = cleaninput($_POST['answer']);
    $department = cleaninput($_POST['department']);
    $level = cleaninput($_POST['level']);
    $courseTitle = cleaninput($_POST['title']);
    $code = cleaninput($_POST['code']);
    $sender = $_SESSION['fname'];


    $check = "SELECT * FROM tblquestion WHERE lecturer = '$sender' AND question = '$question'";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'Question already exist');
    }

    if (count($error) == 0) {
        $sql = "INSERT INTO `tblquestion`(`lecturer`, `department`, `course`, `code`, `level`, `question`, `answer`) 
        VALUES ('$sender','$department', '$courseTitle', '$code', '$level', '$question', '$answer')";
        $query = mysqli_query($connect, $sql);

        echo "<script> alert('Sent successfully.')</script>";
        // header("location:dashboard.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body style="background: #e4e2e2">
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
                <div class="card d-none">
                    <?php
                    $sender = $_SESSION['fname'] . ' ' . $_SESSION['lname'];
                    $check = "SELECT * FROM tblquestion WHERE lecturer = '$sender' ";
                    $query = mysqli_query($connect, $check);
                    $totalQuestion = mysqli_num_rows($query);
                    ?>
                    <p>Total Questions Uploaded</p>
                    <div><?php echo $totalQuestion ?></div>
                </div>
                <ul class="list-group list-group-flush ">
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none text-dark stretched-link d-flex align-items-center my-2">
                            <iconify-icon class="me-2" icon="iconoir:send-dollars" width="28" height="28"></iconify-icon>
                            <div>Set Question</div>
                        </a>
                    </li>
                    <li class="list-group-item ">
                        <a href="#" class="text-decoration-none text-dark stretched-link d-flex align-items-center my-2">
                            <iconify-icon class="me-2" icon="ph:money" width="28" height="28"></iconify-icon>
                            <div>Start Test</div>
                        </a>
                    </li>
                </ul>
                <div class="card p-3">
                    <h5>Analysis</h5>
                    <?php
                    $sender = $_SESSION['fname'] . ' ' . $_SESSION['lname'];
                    $check = "SELECT * FROM tblquestion WHERE lecturer = '$sender' ";
                    $query = mysqli_query($connect, $check);
                    $totalQuestion = mysqli_num_rows($query);
                    ?>

                    <div class="row">
                        <div class="col-md-6">Total Questions Uploaded</div>
                        <div class="fs-5 fw-bold col-md-6"><?php echo $totalQuestion ?></div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>