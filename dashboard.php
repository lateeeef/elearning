<?php
session_start();
include 'includes/redirect.php';

// print_r($_SESSION)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboaard -- Admiralty University Of Nigeria Web-based system for distance learning</title>
    <link rel="shortcut icon" href="images/adunrbg.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php include 'includes/studentheader.php' ?>
    </header>


    <main class="container-fluid">
        <div class="row ">
            <div class="px-2 col-md-2 text- " style="background-color: rgb(12,19,44);">
                <?php include 'includes/studentaside.php' ?>
            </div>


            <div class="col-md-10 px-3 mx- py-1 bg-white">
                <?php include 'includes/title.php' ?>

                <div class="p-3">
                    <div>
                        <h5>The University to you</h5>
                        <p>The Admiralty University of Nigeria The Admiralty University of Nigeria (ADUN) is owned by the Nigerian Navy (via its Navy Holdings Limited). The main campus of the Admiralty University of Nigeria is located on 100 hectares of land at Ibusa, about 20 kilometers from Asaba, the Delta State Capital.</p>
                        <p> The main objective of the University include: to expand the frontiers of knowledge in various unique specializations such as maritime, Logistics Management, Forensic and Cyber Security Sciences; to use university education as a tool towards development and the enhancement of human well being; to address the challenges of nation-building in Nigeria; and to raise exemplary leaders who serve humanity with distinction.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>ADUN Anthem</h5>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat consectetur molestias nemo iste minima accusantium libero facilis aut debitis blanditiis! Molestias quaerat dolore, adipisci earum ex nesciunt esse eius cum?</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Expectations for Students</h5>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo, suscipit, quasi, expedita non voluptatum nisi quod fuga velit et laborum optio. Eum illo ipsa dolore quidem libero enim a similique.</p>
                            <p> The main objective of the University include: to expand the frontiers of raise exemplary leaders.Read More</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Mission Statement</h5>
                            <p>To advance the frontieres of human knowledge by providing leadership in teaching and learning, researchand service using cutting edge technologies to meet current educational demands in order to sunmount the myriads of challenges fasing humanity.</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Implementation Strategy</h5>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo, suscipit, quasi, expedita non voluptatum nisi quod fuga velit et laborum optio. Eum illo ipsa dolore quidem libero enim a similique.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>