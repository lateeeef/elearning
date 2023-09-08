<?php
session_start();
include '../includes/redirectadmin.php';

// print_r($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATIVE Settingsc ADUN -- Web-based Learning System</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
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
                <?php include '../includes/staffaside.php' ?>
            </div>

            <div class=" col-md-9 bg- ">
                <?php include '../includes/title.php' ?>

                <div class="card">
                    <main class="container-sm col-lg-12 my-3 bg-white px-3 pt-4 pb-2  position-relative ">

                        <div class="text-center">
                            <a href="#" class="text-center text-black">
                                <img src="../images/adunlogo.jpg" alt="" class="rounded my-2" width="130" height="130">
                            </a>
                            <p class="mb-1"></p>
                        </div>

                        <div class="container fs-5">
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Name</div>
                                <div class="col-9 "><?php echo $_SESSION['name'] ?></div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Year Established</div>
                                <div class="col-9 ">1999</div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Current Chancellor</div>
                                <div class="col-9 ">Dr Astalamingo Buchika</div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Vice Chancellor</div>
                                <div class="col-9 ">Dr Bahbanluba Timisu</div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 text-secondary">Brief History</div>
                                <div class="col-9 ">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe nostrum fuga, praesentium nihil, vero laborum voluptatum aperiam accusantium voluptates eius mollitia odit alias sequi nemo hic sed aut quam deleniti.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe nostrum fuga, praesentium nihil, vero laborum voluptatum aperiam accusantium voluptates eius mollitia odit alias sequi nemo hic sed aut quam deleniti.</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe nostrum fuga, praesentium nihil, vero laborum voluptatum aperiam accusantium voluptates eius mollitia odit alias sequi nemo hic sed aut quam deleniti.</p>
                                </div>
                            </div>

                        </div>

                        <div class="text-center mt-4">
                            <a href="dashboard.php" class="btn btn-primary">Dashboaard</a>
                        </div>
                    </main>
                </div>


            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>