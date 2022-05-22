<?php
    
    ini_set('display_errors',0);
	session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	// variable declaration
	$username = "";
	$password    = "";
	$errors = array(); 
	// connect to database
	include("firstdb.php");
    

    // LOGIN USER
    if ($_POST['LOGIN'] == 'LOGIN' && isset($_POST['LOGIN'])) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
        
		if (empty($username)) {
			array_push($errors, "champ utilisateur est obligatoire");
		}
		if (empty($password)) {
			array_push($errors, "champ mot du passe est obligatoire");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM clientaccount WHERE username='$username' AND password='$password'";
			
            $results = mysqli_query($conn, $query);
            if($results)
            {
                $id = 0;
                $reset = '';
                while($row = mysqli_fetch_array($results))
                {
                 $id = $row["id"];
                 $reset = $row["isReset"];
                }
    
                if (mysqli_num_rows($results) == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $id;
                    $_SESSION['isReset'] = $reset;
                    header('location: ../profile/profile.php');
                }else {
                    array_push($errors, "nom utilisateur ou mot du passe sont incorrect");
                }
            }else
            {
                array_push($errors, "SERVER ERROR: desolé pour cette occurace");
            }
            
		}
	}


    // reset USER
    if ($_POST['RESET'] == 'RESET' && isset($_POST['RESET']) ) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);

		if (empty($username)) {
			array_push($errors, "champ utilisateur est obligatoire");
		}

		if (count($errors) == 0) {
			
			$cmd = "SELECT * FROM clientaccount WHERE username='$username'";
			$racords = mysqli_query($conn, $cmd);
            if(mysqli_num_rows($racords) == 1 && $racords)
            {
                
                $id = 0;
                $reset = '';
                while($row = mysqli_fetch_array($racords))
                {
                 $id = $row["id"];
                 $reset = $row["isReset"];
                }
                //$_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                $_SESSION['isReset'] = $reset;

                $cmd2 = "SELECT * FROM clientaccount,clients WHERE clientaccount.id =clients.id AND clientaccount.id = '$id'";
			    $racords2 = mysqli_query($conn, $cmd2);
                
                
                if (mysqli_num_rows($racords2) == 1) {
                    
                    while($row = mysqli_fetch_array($racords2))
                    {
                    $authentication = $row["auth"];
                    $email = $row["email"];
                    }

                    $code = rand(10000,99999);
                    require 'php-mailer/src/Exception.php';
                    require 'php-mailer/src/PHPMailer.php';
                    require 'php-mailer/src/SMTP.php';

                    //Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.ethereal.email';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = $email ;                     //SMTP username
                        $mail->Password   = $authentication;                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587; 
                        //Recipients
                        $mail->setFrom('algerie.telecom@mailer.dz', 'algerie telecom');
                        $mail->addAddress($email);          //Add a recipient            //Name is optional
                        $mail->addReplyTo('no-reply-algerie.telecom@mailer.dz', 'no-reply');


                        //Attachments
                        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Here is the subject';
                        $mail->Body    = '<p>votre code de reninitialisation:</p>
                        <div style="background-color:#2c5eaa; padding: 50px; text-align:center;">
                        <img src="https://www.algerietelecom.dz/assets/front/img/logo.svg" style="margin-right:870px; border-radius: 10px; width: 9em; heigth:11em; background-color:white;">
                        <p style="background-color:#20b471; border-radius:20px; padding:10px;"><b><code style="color:white; font-size:100px;">'.$code.'</code></b></p>
                        <br><a href="https://www.algerietelecom.dz/fr/" style="border-left: 5px solid #20b471; padding-left:10px; color:#eee;font-size:20px; text-decoration:none; font-family:monospace;">site officiel.</a>
                        </div>                ';
                        $mail->AltBody = 'votre code: '.$code;

                        $mail->send();
                        $_SESSION['success'] = 'GCwUveguBGr4eDsYyzfINmP6JDpTdiKFJ0iElYHVO5I';
                        $_SESSION['code'] = $code;
                        
                        header("Location: ../login/resetpassword.php");
                    } catch (Exception $e) {
                        array_push($errors, $mail->ErrorInfo);
                    }


                    
                }else {
                    
                    array_push($errors, "SERVER ERROR: erreur du connexion ! verifier plustard");
                }
            }else
            {
                array_push($errors, "votre nom utilisateur n'existe pas, verifier une nouvelle fois !");
            }
            
		}
	}

    if (isset($_POST['PASSWORD'])) {
		$password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $ID = mysqli_real_escape_string($conn, $_POST['PASSWORD']);

		if (empty($password1)) {
			array_push($errors, "champ mot du passe est obligatoire");
		}
        if (empty($password2)) {
			array_push($errors, "champ mot du confirmation mot de passe est obligatoire");
		}
        if($password1 != $password2)
        {
            array_push($errors, "mot passe n'est pas confirmer correctement");
        }

		if (count($errors) == 0) {
			
			$password1 = md5($password1);
            $cmdPassword = "UPDATE clientaccount SET password= '$password1', isReset= 'true' WHERE id='$ID'";
			$resetPassword = mysqli_query($conn, $cmdPassword);
            if($resetPassword)
            {
                $queryDB = "SELECT * FROM clientaccount WHERE id='$ID' AND password='$password1'";
                $dataDB = mysqli_query($conn, $queryDB);
                $_id = 0;
                $_reset = '';
                $_username = '';

                if($dataDB && mysqli_num_rows($dataDB) == 1)
                {
                    while($row = mysqli_fetch_array($dataDB))
                    {
                     $_id = $row["id"];
                     $_reset = $row["isReset"];
                     $_username= $row['username'];
                    }
                    if (mysqli_num_rows($dataDB) == 1) {
                        $_SESSION['username'] = $_username;
                        $_SESSION['id'] = $_id;
                        $_SESSION['isReset'] = $_reset;
                        header('location: ../profile/profile.php');
                    }else {
                        array_push($errors, "ERROR: problem d'authentification client/serveur, veuillez resseyez plus tard");
                    }

                }
            }else
            {
                array_push($errors, "votre nom utilisateur n'existe pas, verifier une nouvelle fois !");
            }
            
		}else
        {
            header("Location: ../login/resetpassword.php");
        }
	}
   
   
    
?>
