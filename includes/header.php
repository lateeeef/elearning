<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header("location:index.php");
    // echo "<script>location = 'index.php')</script>";
    //     echo "<script>
    //     $(document).ready(function(){
    //         location.reload(true)
    //     })
    // </script>
    // ";
}

if($_SESSION['image'] != ''){
    $image = '../uploads/'.$_SESSION['image'];
}else{
    $image = '../images/default.jpg';
}


?>

<nav class="px-3 py-0 mb-1 navbar navbar-white bg-white justify-content-between ">
    <a class="navbar-brand fs-3 d-flex align-items-center me-2" href="index.php">
        <img src="../images/adun.jpg" alt="finix" width="" height="" class="me-1">
    </a>
        <div>
        <span class="fw-bold fs-5">WBLS, ADUN</span>
    </div> 
    <div class="d-md-flex align-items-center">
        <div class="me-2 d-flex align-items-center fw-bold">
            <div class="d-flex align-items-center me-2">
                <img src="<?=$image?>" alt="" height="40" width="40" class="me-2 rounded-pill">
                <?php echo $_SESSION['fname'] ?>
            </div>
            <a href="<?= $_SERVER['PHP_SELF'] ?>?logout=1" class="text-decoration-none text-danger ms-2">
                <div class="d-flex align-items-center">
                    <iconify-icon class="me-2" icon="clarity:logout-line" width="30" height="30" rotate="180deg"></iconify-icon>
                    <span>Logout</span>
                </div>
            </a>
        </div>
    </div>
</nav>