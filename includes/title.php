<?php
$title = '';

if ($_SERVER['PHP_SELF'] == '/elearning/lecture.php') {
    $title = 'Lecture';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/dashboard.php' || $_SERVER['PHP_SELF'] == '/elearning/dashboard.php') {
    $title = 'Dashboard';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/lecture.php') {
    $title = 'Choose a method';
}
if ($_SERVER['PHP_SELF'] == '/elearning/admin/createpin.php') {
    $title = 'Generate PIN ';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/handoutupload.php') {
    $title = 'Upload a file ';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/students.php') {
    $title = 'Search Students';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/report.php') {
    $title = 'Report';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/settings.php' || $_SERVER['PHP_SELF'] == '/elearning/admin/settings.php' || $_SERVER['PHP_SELF'] == '/elearning/settings.php') {
    $title = 'Settings';
}
if ($_SERVER['PHP_SELF'] == '/elearning/admin/reports.php') {
    $title = 'Staff Reports';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/note.php') {
    $title = 'Upload a Note';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/profile.php' || $_SERVER['PHP_SELF'] == '/elearning/admin/profile.php') {
    $title = 'Profile';
}
if ($_SERVER['PHP_SELF'] == '/elearning/admin/displaypicture.php') {
    $title = 'Upload a profile picture';
}
if ($_SERVER['PHP_SELF'] == '/elearning/lessons.php') {
    $title = 'Lessons';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/exercise.php') {
    $title = 'Set questions';
}
if ($_SERVER['PHP_SELF'] == '/elearning/instructor/blacklist.php') {
    $title = 'Blacklist';
}

?>

<body>
    <div class="d-flex justify-content-between align-items-center sticky-top bg-white border py-2 container-fluid" id="titlebar">
        <h5 class=""><?php echo $title ?></h5>
        <div class="d-flex align-items-center">
            <a href="#" class="position-relative text-dark" id="notification">
                <iconify-icon class="" icon="ri:notification-3-line" width="25" height="25" title="Notifications" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable"></iconify-icon>
                <!-- <div class="badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle " style="font-size: 9px;" id="notify">&nbsp;</div> -->
            </a>
        </div>
    </div>
</body>