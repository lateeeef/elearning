<?php
include '../includes/config.php';

$error = [];
$fname = '';
$lname = '';
$email = '';
$phone = '';
$staffid = '';
$password = '';
$conpassword = '';

// print_r($_FILES);

if (isset($_POST['signup'])) {
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }

    $fname = cleaninput($_POST['fname']);
    $lname = cleaninput($_POST['lname']);
    $email = cleaninput($_POST['email']);
    $phone = cleaninput($_POST['phone']);
    $department = cleaninput($_POST['department']);
    $level = cleaninput($_POST['level']);
    $pin = cleaninput($_POST['pin']);
    $staffid = cleaninput($_POST['staffid']);
    $password = cleaninput($_POST['password']);
    $conpassword = cleaninput($_POST['conpassword']);

    $filename = $_FILES['photo']['name'];
    $filesize = $_FILES['photo']['size'];
    $filepath = '../uploads/' . $filename;
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


    $check = "SELECT * FROM tblstaff WHERE email = '$email' OR staffid = '$staffid'";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'StaffID No./Email already exist');
    } elseif ($password != $conpassword) {
        array_push($error, 'Password mismatch');
        if (strlen($password) < 8) {
            array_push($error, 'Password should consist at least 8 characters');
        }
    }
    $checkpin = "SELECT * FROM staffpin WHERE pin = '$pin' AND staffid = '$staffid'";
    $checker = mysqli_query($connect, $checkpin);
    if (mysqli_num_rows($checker) == 0) {
        array_push($error, 'Incorrect StaffID/Access PIN');
    }

    if (count($error) == 0) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $filepath)) {
            echo "<script> alert ('Photo Successfully Uploaded. .')</script>";
        } else {
            echo "<script> alert ('Failed')</script>";
        }

        $password = md5($password);
        $reg = "INSERT INTO `tblstaff`(`fname`,`lname`,`email`,`phone`,`department`, `level`,  `staffid`, `password`, `image`) 
        VALUES ('$fname', '$lname', '$email', '$phone', '$department', '$level', '$staffid', '$password', '$filename')";

        if (mysqli_query($connect, $reg)) {
        } else {
            echo "<script> alert ('Failed to upload passport')</script>";
        }

        $deletePin = "DELETE FROM `staffpin` WHERE pin = '$pin'";
        $deleter = mysqli_query($connect, $deletePin);

    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Signup -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="../images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<style>
    label {
        font-weight: bold;
    }
</style>

<body>

    <article class="container-sm col-lg-6 bg-white px-3 py-1 mt-4 shadow">
        <div>
            <div class="text-center">
                <img height="100" width="150" src="../images/adunlogo.jpg" alt="adunlogo">
            </div>

            <div class=" text-center">
                <h4>SIGN UP FOR WEB BASED LEARNING, ADUN</h4>
            </div>
            <div class="mt-3 mb-2">
                <?php foreach ($error as $errors) {
                    echo '
                        <div class="container-sm col-lg-7  px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                            <b>Error: </b>' . $errors . '
                        </div>';
                    echo '';
                } ?>
            </div>


            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="fname">Firstname</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="fname" id="fname" value="<?= $fname ?>" required placeholder="e.g, John">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="fname">Lastname</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="lname" id="lname" value="<?= $lname ?>" required placeholder="e.g, Wick">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="email">Email address</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="email" name="email" id="email" value="<?= $email ?>" required placeholder="name@example.com">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="phone">Contact</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="phone" id="phone" value="<?= $phone ?>" required placeholder="+234">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="department">Department</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="department" id="department">
                            <option value="">Select Department (Optional)</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Science, Laboratory & Technology">Science, Laboratory & Technology</option>
                            <option value="Farming">Farming</option>
                            <option value="Cyber Security">Cyber Security</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="Electrical Engineering">Electrical Engineering</option>
                            <option value="Banking & Finance">Banking & Finance</option>
                            <option value="Law">Law</option>
                            <option value="Medicine & Surgery">Medicine & Surgery</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                            <option value="Economics">Economics</option>
                            <option value="Sports Management">Sports Management</option>
                            <option value="Physical & Health Education">Physical & Health Education</option>
                            <option value="Linguistics">Linguistics</option>
                            <option value="Quantity Survry">Quantity Survey</option>
                            <option value="Office Technology Management">Office Technology Management</option>
                            <option value="Music">Music</option>
                            <option value="Literature">Literature</option>
                            <option value="Food">Food</option>
                            <option value="Fashion & Textile">Fashion & Textile</option>
                            <option value="Animal Husbandary">Animal Husbandary</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2" id="level">
                    <label class="col-sm-3 fw-bold" for="level">Level</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="level" id="department">
                            <option value="">Select Level (Optional)</option>
                            <option value="100L">100Level</option>
                            <option value="200L">200Level</option>
                            <option value="300L">300Level</option>
                            <option value="400L">400Level</option>
                            <option value="500L">500Level</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="staffid">StaffID</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" name="staffid" id="staffid" value="<?= $staffid ?>" required placeholder="ID Number">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="pin">Access PIN</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" name="pin" id="pin" value="<?= $pin ?>" required placeholder="6 digits">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3 " for="photo" >Upload Passport</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="file" name="photo" id="photo" required>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="password">Password</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="password" id="password" required placeholder="min 8 characters">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3" for="conpassword">Confirm Password</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="conpassword" id="conpassword" required placeholder="min 8 characters">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label class="col-sm-3 invisible" for="password" class="d-none">hidden</label>
                    <div class="col-sm-3">
                        <input class="form-control btn btn-secondary" type="submit" name="signup" style="background: #00007F;">
                    </div>
                    <div class="col-sm-3">
                        <a class="text-decoration-none btn btn-outline-secondary" href="index.php">Back to login</a>
                    </div>
                    <div class="col-sm-3 text-end">
                        <iconify-icon icon="ph:question-light" width="30" height="30" data-bs-toggle="modal" data-bs-target="#exampleModal"></iconify-icon>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Help</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <div>
                                            <h6>Don't have an access PIN?</h6>
                                            <p>Send a mail to the admin ADUN on support@adun.org.ng with your ID number to get an accesss PIN</p>
                                        </div>
                                        <hr class="mx-5 my-3">
                                        <div>
                                            <h6>Forgot Password?</h6>
                                            <p>Visit the admin building, Admiralty University of Nigeria for appropriate proceedures to reset your password</p>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok!</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </article>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>