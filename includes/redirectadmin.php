<?php
    if (empty($_SESSION['passphrase'])) {
        header('location:index.php', 'refresh');
    }    
    header("refresh, 3");
?>