<?php
session_start();
include '../includes/redirect.php';
include '../includes/config.php';
// print_r ($_GET);     


$error = [];
$department = '';
$level = '';
$courseTitle = '';
$code = '';
$topic = '';


if(isset($_POST['submit'])){
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    // print_r ($_FILES);
    $sender = $_SESSION['fname'] .' '. $_SESSION['lname'];
    $staffId = $_SESSION['staffid'];
    $department = cleaninput($_POST['department']);
    $level = cleaninput($_POST['level']);
    $courseTitle = cleaninput($_POST['title']);
    $code = cleaninput($_POST['code']);
    $topic = cleaninput($_POST['topic']);


    $filename = $_FILES['handout']['name'];
    $filesize = $_FILES['handout']['size'];
    $filepath = '../uploads/'.$filename;
    $ext = pathinfo($filepath, PATHINFO_EXTENSION);

    $extArray = ['pdf', 'txt', 'xlsx', 'docx'];
    if (!in_array($ext, $extArray)) { 
        array_push($error, 'Invalid Extension');
    }
    if ($filesize > 5000000) {
        array_push($error, 'File is too large');
    }
    if (file_exists($filepath)) {
        array_push($error, 'The file alredy exists');
    }
    $check = "SELECT * FROM lesson WHERE lecturer = '$sender' AND pdf = '$filename' AND department = '$department' AND level = '$level' ";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'File already sent');
    }



    if(count($error) == 0){
        $sql = "INSERT INTO `lesson`(`lecturer`, `staffid`, `course`, `code`, `department`, `level`, `topic`, `pdf`) 
        VALUES ('$sender', '$staffId', '$courseTitle ', '$code', '$department', '$level', '$topic', '$filename')";
        $query = mysqli_query($connect, $sql);

        // upload the file
        if(move_uploaded_file($_FILES['handout']['tmp_name'], $filepath)){
            echo "<script> alert ('File Uploaded Successfully')</script>";
        }else{
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
    <title>Lecturer Dashboaard -- Admiralty University Of Nigeria Web-based system for distance learning</title>
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

            <div class="col-md-9 bg-">
            <?php  include '../includes/title.php' ?>

                <div class="card" style="border-top: none;">

                    <form class="p-3" action="<?=$_SERVER ['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                        <div class="mt-3">
                            <?php foreach ($error as $errors) {
                                echo '
                                    <div class="container-sm col-lg-7 mb-2 px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                        <b>Error: </b>' . $errors . '
                                    </div>';
                                echo '';
                                } 
                            ?>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="mb-1 fw-bold" for="handout">Upload a PDF handout for yuor students </label>
                            <div class="m">
                                <input class="form-control " type="file" name="handout" id="handout" >
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                        <label class="mb-1 fw-bold" for="department">Department</label>
                        <div class="">
                            <select class="form-select" name="department" id="department"  required>
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
                    
                    <div class="form-group row mb-3">
                        <label class="mb-1 fw-bold" for="level">Level</label>
                        <div class="">
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
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="title">Course Title</label>
                        <input class="form-control" name="title" type="text" id="title" value="<?=$courseTitle?>" placeholder="Course Title" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="code">Course Code</label>
                        <input class="form-control" name="code" type="text" id="code" value="<?=$code?>" placeholder="Course Code" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="topic">Topic</label>
                        <input class="form-control" name="topic" type="text"id="topic" value="<?=$topic?>" placeholder="Topic" required>
                    </div>

                    <div class="text-center">
                            <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                    </div>
                </form>
                </div>
     
    
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>