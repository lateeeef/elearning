<?php
    if (empty($_SESSION['staffid'])) {
        header('location:index.php', 'refresh');
    }    
    header("refresh, 3");
?>