<?php
session_start();
include '../includes/config.php';
include '../includes/redirectadmin.php';


if (isset($_GET['clear']) == 1) {
    $sql = "DELETE FROM `report` ";
    $query = mysqli_query($connect, $sql);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Reports WBLS ADUN -- Web-based Learning System</title>
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
                <?php include '../includes/adminaside.php' ?>
            </div>

            <div class=" col-md-9 bg- ">
                <?php include '../includes/title.php' ?>

                <div class="d-flex align-items-center justify-content-center p-5 text-secondary d-none" id="noReport">
                    <p class="fs-4">No Report Found</p>
                </div>

                <div class="card px-3 py-2" id="nav">
                    <div class="my-2 row ">
                        <p class="col-md-6 fs-5">Staff and their reports</p>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Clear all</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <div>
                                                <h6>Are you sure you want to clear reports?</h6>
                                                <p>This can neither be undone nor recovered.</p>
                                            </div>
                                            <hr class="mx-5 my-3">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                            <a class="btn btn-danger" href="<?= ($_SERVER['PHP_SELF']) ?>?clear=1">Clear</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php
                        $sql = "SELECT * FROM `report` ORDER BY date_added DESC";
                        $query = mysqli_query($connect, $sql);

                        $count = mysqli_num_rows($query);
                        if ($count == 0) {
                            $sender = '';
                            $title = '';
                            $staffId = '';
                            echo "
                            <script>
                            $(document).ready(function(){
                                $('#noReport').removeClass('d-none')
                                $('#nav').css('display', 'none')
                            })
                            </script>
                            ";
                        } else {
                            $sender = 'Staff: ';
                            $title = 'Title: ';
                            $staffId = 'StaffID: ';
                        }
                        while ($row = mysqli_fetch_assoc($query)) :
                        ?>
                            <div class="card p-3 mb-1">
                                <div class="card-title fw-bold row">
                                    <div class="col-md-4 text-start">
                                        <?php echo $sender . $row['sender'] ?>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <?php echo $title . $row['title'] ?>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <?php echo $staffId . $row['staffid'] ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <?php echo $row['message'] ?>
                                    </p>
                                </div>
                                <div class="fw-bold text-end">
                                    <?php echo $row['date_added'] ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

            </div>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>