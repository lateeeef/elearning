<?php
session_start();
include '../includes/config.php';
$detail = ' ';
$searchby = ' ';
$check = '';
$article = '';
$studentInfo = [];

$result = '';
$fullname = '';
$matric = '';
$email = '';
$phone = '';
$department = '';
$level = '';
$symbol = '';


// print_r($studentInfo);
if (isset($_GET['search'])) {
    function cleaninput($formdata)
    {
        $data = trim($formdata);
        $data = stripslashes($formdata);
        $data = htmlspecialchars($formdata);
        return $data;
    }
    $detail = cleaninput($_GET['detail']);
    $searchby = cleaninput($_GET['searchby']);

    // $select = "SELECT * FROM `tblstudent` WHERE fname = '$detail' OR email = '$detail' 
    // OR department = '$detail' OR phone = '$detail' 
    // OR matric = '$detail' OR level = '$detail'";

    $result = 'Search Result(s)';
    $fullname = 'Fullname';
    $matric = 'Matric';
    $email = 'Email';
    $phone = 'Phone';
    $department = 'Department';
    $level = 'Level';
    $symbol = '&CirclePlus;';


    $article = '<div class="rounded p-3 bg-light">
    <div>
        <h5>' . $result . '</h5>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <th scope="col">' . $fullname . '</th>
            <th scope="col">' . $matric . '</th>
            <th scope="col">' . $email . '</th>
            <th scope="col">' . $phone . '</th>
            <th scope="col">' . $department . '</th>
            <th scope="col">' . $level . '</th>
        </thead>
        ';
    $select = "SELECT * FROM `tblstudent` WHERE `$searchby` = '$detail' ";
    $check = mysqli_query($connect, $select);

    // $studentInfo = mysqli_fetch_assoc($check);
    while ($studentInfo = mysqli_fetch_assoc($check)) {
        '
            <tbody>
                <tr>
                    <td>' . $studentInfo["fname"] . '</td>
                    <td>' . $studentInfo["matric"] . '</td>
                    <td>' . $studentInfo["email"] . '</td>
                    <td>' . $studentInfo["phone"] . '</td>
                    <td>' . $studentInfo["department"] . '</td>
                    <td>' . $studentInfo["level"] . '</td>
                </tr>
            </tbody>
        ';
    }
    '
    </table>
</div>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATIVE DASHBOARD ADUN -- Web-based Learning System</title>
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

                <div class="">
                    <!-- <?php echo $article ?> -->
                    <!-- <table class="d-none">

                    </table> -->
                    <div class="rounded p-3 bg-light ">
                        <div>
                            <h5><?php echo $result ?></h5>
                        </div>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <th scope="col"><?php echo $fullname ?></th>
                                <th scope="col"><?php echo $matric ?></th>
                                <th scope="col"><?php echo $email ?></th>
                                <th scope="col"><?php echo $phone ?></th>
                                <th scope="col"><?php echo $department ?></th>
                                <th scope="col"><?php echo $level ?></th>
                            </thead>
                            <?php
                            $select = "SELECT * FROM `tblstudent` WHERE `$searchby` = '$detail' ";
                            $check = mysqli_query($connect, $select);
 
                            $count = mysqli_num_rows($check);
                            // echo $count;

                            while ($studentInfo = mysqli_fetch_assoc($check)) : ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $studentInfo["fname"] ?></td>
                                        <td><?php echo $studentInfo["matric"] ?></td>
                                        <td><?php echo $studentInfo["email"] ?></td>
                                        <td><?php echo $studentInfo["phone"] ?></td>
                                        <td><?php echo $studentInfo["department"] ?></td>
                                        <td><?php echo $studentInfo["level"] ?></td>
                                    </tr>
                                </tbody><?php
                                    endwhile ?>
                        </table>
                    </div>
                </div>


                <div class="rounded p-3 bg-light">
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
                        $sql = "SELECT * FROM `tblstudent` ORDER BY `fname` ";
                        $query = mysqli_query($connect, $sql);
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
                                </tr>
                            </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>

            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>