<?php
session_start();
include '../includes/config.php';
include '../includes/redirectstaff.php';
$criteria = '0';
$detail = '';
$searchby = '';
$check = '';
$article = '';
$studentInfo = [];

$symbol = '';


// print_r($_SESSION);

if (isset($_GET['search'])) {
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    $searchby = cleaninput($_GET['searchby']);
    $detail = cleaninput($_GET['detail']);

    $symbol = '&CirclePlus;';
    $criteria = "`$searchby` = '$detail'";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Block Student ADUN -- Web-based Learning System</title>
    <link rel="shortcut icon" href="../images/adunlogo.jpg" type="image/x-icon">
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

            <div class=" col-md-9 bg-white ">
                <?php include '../includes/title.php' ?>

                <div class="mb-2 p-2">
                    <p>Blocked students will not be able to access your course untill you unblock them.</p>

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" class="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="search" class="ms-2" style="font-size: 13px; color: blue; text-transform: capitalize;"><?php echo $symbol . ' ' . $searchby ?></label>
                                <select class="form-select" name="searchby" id="search" required>
                                    <option value="">Search Student by</option>
                                    <option value="fname">Fullname</option>
                                    <option value="matric">Matric Number</option>
                                    <option value="email">Email</option>
                                    <option value="phone">Phone</option>
                                    <option value="department">Department</option>
                                    <option value="level">Level</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold" for="detail"></label>
                                <div class="col-md-">
                                    <input class="form-control" type="text" name="detail" id="detail" placeholder="Enter Detail" value="<?= $detail ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Search" name="search" class="btn btn-primary">
                        </div>
                    </form>
                </div>




                <div class="rounded p-3 bg-light" id="tbody">
                    <div>
                        <h5>Students</h5>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <th scope="col">Fullname</th>
                            <th scope="col">Matric</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Level</th>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM `tblstudent` WHERE $criteria ";
                        $query = mysqli_query($connect, $sql);
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            echo "
                            <script>
                            $(document).ready(function(){
                                 $('#tbody').addClass('d-none')
                                 $('#null').removeClass('d-none')
                            })
                            </script>
                            ";
                        }
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $row['fname'] ?></td>
                                    <td style="text-transform: uppercase;"><?= $row['matric'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['department'] ?></td>
                                    <td><?= $row['level'] ?></td>
                                    <td class="text-center">
                                        <?php
                                        $matric = $row['matric'];

                                        if (isset($_GET['block'])) {
                                            $staffId = $_SESSION['staffid'];

                                            $sql = "INSERT INTO `staffblacklist`(`staffid`, `matric`) VALUES ('$staffId', '$matric')";
                                            $query = mysqli_query($connect, $sql);

                                            if ($query) {
                                                echo "<script> alert ('Student Blocked ')</script>";
                                            }else{
                                                echo "<script> alert ('unsuccesful ')</script>";
                                            }
                                        }
                                        ?>
                                        <a href="" onclick='if(confirm("Are you sure you want to block this Student?")){location.href="<?= $_SERVER["PHP_SELF"] ?>?block=<?= $row["id"] ?>"}' class="btn btn-danger btn-sm">
                                            Block
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                        endwhile;

                        ?>
                    </table>
                </div>

                <div class="d-none p-2 text-danger" id="null">
                    <p class="">Student record might not be found if details provided do not match. Please provide adequate information </p>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>