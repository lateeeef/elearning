<?php 
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
    $redirect = '../dashboard.php';
    $where = 'Go to dashboard';
}else{
    $redirect = '../index.php';
    $where = 'Go home';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h1 class="text-danger">Error</h1>
    <p>The url address you entered does not exist, please check well and try again.</p>
    <a href="<?=$redirect?>" class="btn btn-outline-primary"><?php echo $where ?></a>
</body>
</html>