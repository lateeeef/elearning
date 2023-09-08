<?php
session_start();
include '../includes/config.php';
include '../includes/redirectadmin.php';
// print_r($_SESSION);
if (isset($_GET['unblock'])) {
    $id = $_GET['unblock'];
    $sql1 = "DELETE FROM `blacklist` WHERE id =  '$id'";
    $query1 = mysqli_query($connect, $sql1);
}
if (isset($_GET['unblockstudent'])) {
    $id = $_GET['unblockstudent'];
    $sql1 = "DELETE FROM `blacklilststudent` WHERE id =  '$id'";
    $query1 = mysqli_query($connect, $sql1);
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql1 = "DELETE FROM `staffpin` WHERE id =  '$id'";
    $query1 = mysqli_query($connect, $sql1);
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
        <?php include '../includes/adminheader.php' ?>
    </header>


    <main class="container-fluid">
        <div class="row">
            <div class="px-2 col-md-3">
                <?php include '../includes/adminaside.php' ?>
            </div>

            <div class=" col-md-9 bg- ">
                <div class="rounded p-3 bg-light" id="unusedPins">
                    <div>
                        <h5>Blocked Staff</h5>
                    </div>
                    <table class="table table-striped">
                        <?php
                        $sql = "SELECT * FROM `blacklist` ORDER BY `date_added` ";
                        $query = mysqli_query($connect, $sql);
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            $sender = '';
                            $title = '';
                            $staffId = '';
                            echo "
                            <script>
                            $(document).ready(function(){
                                // $('#noReport').removeClass('d-none')
                                $('#unusedPins').css('display', 'none')
                            })
                            </script>
                            ";
                        }

                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td id=""><?= $row['fname'] ?></td>
                                    <td><?= $row['staffid'] ?></td>
                                    <td class="small"><?= $row['date_added'] ?></td>
                                    <td class="small text-danger text-center">
                                        <button class="btn btn-sm btn-primary" onclick='if(confirm("Are you sure you want to unblock Staff?")){location.href="dashboard.php?unblock=<?= $row["id"] ?>"}'>Unblock</button>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>

                <div class="rounded p-3 bg-light" id="unusedPins">
                    <div>
                        <h5>Blocked Students</h5>
                    </div>
                    <table class="table table-striped">
                        <?php
                        $sql = "SELECT * FROM `blacklilststudent` ORDER BY `dateadded` ";
                        $query = mysqli_query($connect, $sql);
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            $sender = '';
                            $title = '';
                            $staffId = '';
                            echo "
                            <script>
                            $(document).ready(function(){
                                // $('#noReport').removeClass('d-none')
                                $('#unusedPins').css('display', 'none')
                            })
                            </script>
                            ";
                        }

                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td id=""><?= $row['name'] ?></td>
                                    <td><?= $row['matric'] ?></td>
                                    <td class="small"><?= $row['dateadded'] ?></td>
                                    <td class="small text-danger text-center">
                                        <button class="btn btn-sm btn-primary" onclick='if(confirm("Are you sure you want to unblock Staff?")){location.href="dashboard.php?unblockstudent=<?= $row["id"] ?>"}'>Unblock</button>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>

                <div class="rounded p-3 bg-light" id="unusedPins">
                    <div>
                        <h5>Unused PINs</h5>
                    </div>
                    <table class="table table-striped">
                        <?php
                        $sql = "SELECT * FROM `staffpin` ORDER BY `dateadded` ";
                        $query = mysqli_query($connect, $sql);
                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            $sender = '';
                            $title = '';
                            $staffId = '';
                            echo "
                            <script>
                            $(document).ready(function(){
                                // $('#noReport').removeClass('d-none')
                                $('#unusedPins').css('display', 'none')
                            })
                            </script>
                            ";
                        }

                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td id="unusedpin"><?= $row['staffid'] ?></td>
                                    <td><?= $row['pin'] ?></td>
                                    <td class="small"><?= $row['dateadded'] ?></td>
                                    <td class="small text-danger text-center">
                                        <iconify-icon icon="carbon:delete" width="25" height="25" style="cursor: pointer;" onclick='if(confirm("Are you sure you want to delete this PIN? Staff will not be able to use it again")){location.href="dashboard.php?delete=<?= $row["id"] ?>"}' data-bs-toggle="modal" data-bs-target="#exampleModal"></iconify-icon>
                                        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content text-dark">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <div>
                                                            <p class="fs-6">Are you sure you want to delete this PIN? <br> Staff will not be able to use it again</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-danger" href="<?= $_SERVER['PHP_SELF'] ?>?delete=<?= $row["id"] ?>">Delete</a>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </td>
                                </tr>
                            </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>

                <div class="rounded p-3 bg-light">
                    <div class="d-flex justify-content-between pe-3">
                        <h5>Staff</h5>
                        <a class="text-decoration-none text-dark fw-bold" href="mystaff.php">View All</a>
                    </div>
                    <table class="table table-striped">
                        <?php
                        $sql = "SELECT * FROM `tblstaff` ORDER BY `fname` LIMIT 7";
                        $query = mysqli_query($connect, $sql);
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $row['fname'] ?></td>
                                    <td><?= $row['staffid'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <!-- <td><?= $row['level'] ?></td> -->

                                </tr>
                            </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>

                <div class="rounded p-3 bg-light">
                    <div class="d-flex justify-content-between pe-3">
                        <h5>Student</h5>
                        <a class="text-decoration-none text-dark fw-bold" href="mystudent.php">View All</a>
                    </div>
                    <table class="table table-striped">
                        <?php
                        $sql = "SELECT * FROM `tblstudent` ORDER BY `fname` LIMIT 7";
                        $query = mysqli_query($connect, $sql);
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $row['fname'] ?></td>
                                    <td><?= $row['matric'] ?></td>
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