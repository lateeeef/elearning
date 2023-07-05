<?php
include 'includes/config.php';

$error = [];
$fname = '';
$email = '';
$phone = '';
$matric = '';
$password = '';
$conpassword = '';

if (isset($_POST['register'])) {
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }

    $fname = cleaninput($_POST['fname']);
    $email = cleaninput($_POST['email']);
    $phone = cleaninput($_POST['phone']);
    $matric = cleaninput($_POST['matric']);
    $department = cleaninput($_POST['department']);
    $level = cleaninput($_POST['level']);
    $password = cleaninput($_POST['password']);
    $conpassword = cleaninput($_POST['conpassword']);


    $check = "SELECT * FROM tblstudent WHERE email = '$email' OR matric = '$matric'";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'Matric No., Email already exist');
    } elseif ($password != $conpassword) {
        array_push($error, 'Password mismatch');
        if (strlen($password) < 8) {
            array_push($error, 'Password should consist at least 8 characters');
        }
    }

    if (count($error) == 0) {
        $password = md5($password);
        $reg = "INSERT INTO `tblstudent`(`fname`, `email`,`phone`,`department`, `matric`, `level`, `password`) 
        VALUES ('$fname', '$email', '$phone', '$department', '$matric', '$level', '$password')";

        if (mysqli_query($connect, $reg)) {
            echo "<script> if(confirm('You have successfully created an account, proceed to login?')){location.href='login.php'}</script>";
            if (isset($_GET['ok'])) {
                header("location:login.php");
            }
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
    <title>Register || Create an account </title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
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
    <main >

        <article class="container-sm col-lg-6 bg-white px-3 py-1 mt-4 shadow">
            <div>
                <div class="text-center">
                    <img height="100" width="150" src="images/adunlogo.jpg" alt="adunlogo">
                </div>

                <div class=" text-center">
                    <h4>SIGN UP FOR WEB BASED LEARNING, ADUN</h4> 
                </div>
                <div class="mt-3">
                    <?php foreach ($error as $errors) {
                        echo '
                            <div class="container-sm col-lg-7 mb-2 px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                <b>Error: </b>' . $errors . '
                            </div>';
                        echo '';
                    } ?>
                </div>


                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="form-group row mb-2">
                        <label class="col-sm-3" for="fname">Name on ID card</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="fname" id="fname" value="<?= $fname ?>" required placeholder="e.g, John">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3" for="email">Email address</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" name="email" id="email" value="<?= $email ?>" required placeholder="ola*****2@gmail.com">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3" for="phone">Contact</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="tel" name="phone" id="phone" value="<?= $phone ?>" required placeholder="+234">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3" for="matric">Reg/Matric No.</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="matric" id="matric" value="<?= $matric ?>" required placeholder="CS23...">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3" for="department">Department</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="department" id="department" required>
                                <option value="">Select Department</option>
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
                    <div class="form-group row mb-2">
                        <label class="col-sm-3" for="level">Level</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="level" id="department" required>
                                <option value="">Select Level</option>
                                <option value="100L">100Level</option>
                                <option value="200L">200Level</option>
                                <option value="300L">300Level</option>
                                <option value="400L">400Level</option>
                                <option value="500L">500Level</option>
                            </select>
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
                            <input class="form-control btn btn-secondary" type="submit" name="register" style="background: #00007F;">
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="text-decoration-none" href="login.php">Back to login</a>
                        </div>
                    </div>
                </form>
            </div>
        </article>

        <!-- <footer class=" text-white px-2" style="background: #00007F; padding-bottom: 16px;">
            <span class="">&copy;  2023 Admiralty University Of Nigeria Student Online Academic Portal | For technical support, email: support@adun.edu.ng </span>
        </footer> -->
    </main>
</body>

</html>