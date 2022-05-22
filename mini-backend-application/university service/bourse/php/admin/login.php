<?php 

if ($_POST['ADMIN'] == 'ADMIN' && isset($_POST['ADMIN'])) {

    session_start();
    $conn=mysqli_connect("localhost","root","mysql","bourse");        
    $password  = mysqli_real_escape_string($conn, $_POST['password']);
    
    if (empty($password)) {
        header('Location: ./login.php');
    }

    $q = "SELECT `password` FROM `admin` WHERE id=1";
    $r = mysqli_query($conn, $q);

        if($r)
        {
            $password = md5($password);
            while($row = mysqli_fetch_array($r))
            {
            $pass  = $row["password"];
            }
            
            if($password == $pass)
            {
                $_SESSION['admin'] = 'admin';
                header('Location: ./admin.php');
            }else
            {
                session_destroy();
                header("location: ./login.php");
            }
        }
    }


?>
<?php
    //$_SESSION['username'] = 'admin';
	if (isset($_SESSION['admin'])) {
		header('location: ./admin.php');
	}       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <style>
        body
        {
            font-family: 'consolas', sans-serif;
        }
    </style>
    <title>FSE - Admin Login</title>
</head>
<body>
    
    <main>
        <form action="./login.php" method="POST">
            <div class="user-icon">
                <i class="fa fa-user fa-3x"></i>
            </div>
            <div class="input-goup">
                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="password">
                <div class="input-group-prepend">
                    <div class="password_visibility">
                        <span class="pass-icon" data-visible="hidden">
                            <i class="fas fa-eye-slash"></i>
                        </span>
                        <span class="pass-icon d-none" data-visible="visible">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div> 
                </div>
            </div>
            <div class="form-group">
            <a class="btn" href="../../index.html">retour principal</a>
            <button class="btn" name="ADMIN" value="ADMIN">connectez</button>
            </div>
            
        </form>
    </main>


    <script src="./js/login.js"></script>
</body>
</html>