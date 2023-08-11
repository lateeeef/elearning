<?php
session_start();
include '../includes/config.php';
include '../includes/redirectstaff.php';
// print_r($_SESSION)
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Students  -- Web-based Learning System</title>
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

                <div class="rounded p-3 bg-light">
                    <div>
                        <h5>Students</h5>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">Fullname</th>
                            <th scope="col">Matric</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Level</th>
                        </thead>
                        <?php
                        $department = $_SESSION['department'];

                        if ($_SESSION['department'] != '' && $_SESSION['level'] == '') {
                            // $level = $_SESSION['level'];    
                            $criteria = "department = '$department'";
                        } elseif ($_SESSION['department'] != '' && $_SESSION['level'] != '') {
                            $department = $_SESSION['department'];
                            $level = $_SESSION['level'];
                            $criteria = "department = '$department' AND level = '$level'";
                        } else {
                            $criteria = 1;
                        }

                        $sql = "SELECT * FROM `tblstudent` WHERE $criteria ORDER BY `fname` ";
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