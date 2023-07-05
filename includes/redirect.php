<?php
    if (count($_SESSION) == 0) {
        header('location:index.php', 'refresh');
    }    
    header("refresh, 3");
?>