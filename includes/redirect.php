<?php
    if (empty($_SESSION['matric'])) {
        header('location:index.php', 'refresh');
    }    
    header("refresh, 3");
?>