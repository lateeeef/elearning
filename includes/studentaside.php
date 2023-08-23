<?php
if ($_SERVER['PHP_SELF'] == '/elearning/dashboard.php') {
    echo "<script>
        $(document).ready(function(){
            $('#dashboard').addClass('bg-primary');
        })
    </script>";
}
if ($_SERVER['PHP_SELF'] == '/elearning/lessons.php' || $_SERVER['PHP_SELF'] == '/elearning/lecture.php') {
    echo "<script>
        $(document).ready(function(){
            $('#lessons').addClass('bg-primary');
        })
    </script>";
}
if ($_SERVER['PHP_SELF'] == '/elearning/settings.php') {
    echo "<script>
        $(document).ready(function(){
            $('#settings').addClass('bg-primary');
        }) 
    </script>";
}
?>

<style>
    .mouseleaver {
        background-color: #E4E2E2;
    }
</style>

<body>
    <div class="px-1 col-md- sticky-top py-4 " style="background: rgb(12,19,44); height: 693px;">
        <div>
            <a href="dashboard.php" class="btn d-flex align-items-center text-decoration-none text-white my-2 fw-bold" id="dashboard">
                <iconify-icon class="me-2" icon="material-symbols:dashboard-outline" width="30" height="30"></iconify-icon>
                <div style=" font-size: 16px;">Dasboard</div>
            </a>
            <a href="lessons.php" class="btn d-flex align-items-center text-decoration-none text-white my-2 fw-bold" id="lessons">
                <iconify-icon class="me-2" icon="ic:baseline-play-lesson" width="30" height="30" ></iconify-icon>
                <div style=" font-size: 16px;">Lessons</div>
            </a>
            <a href="#" class="btn d-flex align-items-center text-decoration-none text-white my-2 fw-bold" onclick="alert('Available Soon')" id="excercises">
                <iconify-icon class="me-2" icon="simple-line-icons:question" width="30" height="30" ></iconify-icon>
                <div style=" font-size: 16px;">Excercises</div>
            </a>
            <a href="#" class="btn d-flex align-items-center text-decoration-none text-white my-2 fw-bold" onclick="alert('Available Soon')" id="scores">
                <iconify-icon class="me-2" icon="fluent:textbox-16-regular" width="30" height="30"></iconify-icon>
                <div style=" font-size: 16px;">Scores</div>
            </a>
            <a href="settings.php" class="btn d-flex align-items-center text-decoration-none text-white my-2 fw-bold" id="settings">
                <iconify-icon class="me-2" icon="ant-design:setting-outlined" width="30" height="30"></iconify-icon>
                <div style=" font-size: 16px;">Settings</div>
            </a>
            <a href="<?= $_SERVER['PHP_SELF'] ?>?logout=1" class="btn d-flex align-items-center text-decoration-none text-danger my-2 fw-bold" id="logout">
                <iconify-icon class="me-2" icon="clarity:logout-line" width="30" height="30" rotate="180deg"></iconify-icon>
                <div style=" font-size: 16px;">Logout</div>
            </a>
        </div>

        <div class="text-white mb-3 fw-" style="font-size: 12px; color: rgb(155,164,191); margin-top: 190px">
            <div class="">
                <ul class="nav ">
                    <li class="nav-item mx-1"><a href="#" class="text-white"><iconify-icon class="me-2" icon="mdi:twitter" width="30" height="30"></iconify-icon></a></li>
                    <li class="nav-item mx-1"><a href="#" class="text-white"><iconify-icon class="me-2" icon="basil:instagram-solid" width="30" height="30"></iconify-icon></a></li>
                    <li class="nav-item mx-1"><a href="#" class="text-white"><iconify-icon class="me-2" icon="ic:outline-facebook" width="30" height="30"></iconify-icon></a></li>
                    <li class="nav-item mx-1"><a href="#" class="text-white"><iconify-icon class="me-2" icon="ic:sharp-email" width="30" height="30"></iconify-icon></a></li>
                </ul>
            </div>
            <div class="mt-3 px-1">
                <p><a href="#" class="text-white text-decoration-none">Privacy Policy - Terms of Use</a></p>
            </div>
            <div class="px-1">
                &copy; <?php echo date('Y') ?> <span>WEB-BASED LEARNING SYSTEM, ADUN</span>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.bg-primary').siblings().mouseover(function() {
                $(this).addClass('bg-secondary')

            })

            $('.bg-primary').siblings().mouseleave(function() {
                $(this).removeClass('bg-secondary')
            })
        })
    </script>
</body>