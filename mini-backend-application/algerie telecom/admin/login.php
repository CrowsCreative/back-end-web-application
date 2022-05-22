<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon"  href="https://www.algerietelecom.dz/assets/front/img/favicon.png" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    
    <main>
        <form action="login.php" method="POST">
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
            <a class="btn" href="../index.php">retour principal</a>
            <button class="btn" name="LOGIN" value="LOGIN">connectez</button>
            </div>
            
        </form>
    </main>


    <script src="./js/login.js"></script>
</body>
</html>