<?php
session_start();
include '../includes/config.php';
include '../includes/redirectstaff.php';

$courseTitle = '';
$note = '';
$sender = '';
$code = '';
$topic = '';
$error = [];
// print_r($_POST);
// print_r($_SESSION);
if(isset($_POST['submit'])){
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    $sender = $_SESSION['fname'] .' '. $_SESSION['lname'];
    $staffId = $_SESSION['staffid'];
    $courseTitle = cleaninput($_POST['title']);
    $code = cleaninput($_POST['code']);
    $department = cleaninput($_POST['department']);
    $level = cleaninput($_POST['level']);
    $topic = cleaninput($_POST['topic']);
    $note = mysqli_real_escape_string($connect,$_POST['note']);
    // $note = $_POST['note'];


    $check = "SELECT * FROM lesson WHERE lecturer = '$sender' AND note = '$note' AND department = '$department' AND level = '$level' ";
    $query = mysqli_query($connect, $check);
    if (mysqli_num_rows($query) > 0) {
        array_push($error, 'Note already sent');
    }

    if(count($error) == 0){
        $sql = "INSERT INTO `lesson`(`lecturer`, `staffid`, `course`, `code`, `department`, `level`, `topic`, `note`) 
        VALUES ('$sender', '$staffId', '$courseTitle', '$code', '$department', '$level', '$topic', '$note')";
        $query = mysqli_query($connect, $sql);

        echo "<script>alert('Note Uploaded successfully.')</script>";
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
    <title>Note -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="../images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/5m0npnrd98zj25mzm9cfmsg985g9dgq0s6ujgedh657y5vbh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                <?php  include '../includes/title.php' ?>
                
                <form class="p-3 card" action="#" method="POST">
                <div class="mt-3">
                    <?php foreach ($error as $errors) {
                        echo '
                            <div class="container-sm col-lg-7 mb-2 px-2 py-1 " style="border-left: 4px solid red; background-color: rgb(235, 219, 219);">
                                <b>Error: </b>' . $errors . '
                            </div>';
                        echo '';
                    } ?>
                </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-3 fw-bold" for="department">Department</label>
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
                        <label class="col-sm-3 fw-bold" for="level">Level</label>
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
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="title">Course Title</label>
                        <input class="form-control" name="title" type="text" id="title" value="<?=$courseTitle?>" placeholder="Title of the Report" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="code">Course Code</label>
                        <input class="form-control" name="code" type="text" id="code" value="<?=$code?>" placeholder="Course Code" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2"  for="topic">Topic</label>
                        <input class="form-control" name="topic" type="text"id="topic" value="<?=$topic?>" placeholder="Topic" required>
                    </div>
                    <div  class="form-group mb-3">
                        <label class="fw-bold mb-2" for="note">Note</label>
                        <textarea class="form-control" name="note" id="note" cols="30" rows="20" placeholder="Write your notes here..." value="<?=$note?>" required><?php echo $note ?></textarea>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary" name="submit" type="submit" value="Submit">
                    </div>
                </form>

            </div>

        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
    });
  </script>
</body>

</html>