<?php

    ini_set('display_errors',0);
	session_start();
	// variable declaration
	$username = "";
	$errors = array(); 
    $errors_login = array();
    $errors_pass = array();
    $errors_tag = array();
    $id = 0;
	// connect to database
	$conn=mysqli_connect("localhost","root","mysql","bourse");


    // SIGNUP USER
    if ($_POST['SIGNUP'] == 'SIGNUP' && isset($_POST['SIGNUP'])) {
		$matricule = mysqli_real_escape_string($conn, $_POST['matricule']);
        $email     = mysqli_real_escape_string($conn, $_POST['email']);
		$password  = mysqli_real_escape_string($conn, $_POST['password']);
        
		if (empty($matricule)) {
			array_push($errors, "champ matricule est obligatoire");
		}
		if (empty($email)) {
			array_push($errors, "champ email est obligatoire");
        }
        if (empty($password)) {
			array_push($errors, "champ mot du passe est obligatoire");
		}

		if (count($errors) == 0) {
			$query = "SELECT matricule FROM compte WHERE matricule='$matricule'";
            $results = mysqli_query($conn, $query);
 
            if(mysqli_num_rows($results) == 0)
            {
                $password = md5($password);
                $code = md5($matricule);
                $query = "INSERT INTO compte(`matricule`,`email`,`password`,`code`, `Isdeleted`) VALUE('$matricule', '$email', '$password', '$code', 'false')";
                $results = mysqli_query($conn, $query);

                if($results)
                {
   
                    $q = "INSERT INTO etudiants(`nom`, `prenom`, `address`, `telephone`, `pays`, `banque`, `specilite`, `matricule`, `general`, `type`, `status`, `image`) VALUES ('','','','','','','','$matricule','','','start','')";
                    $r1 = mysqli_query($conn, $q);
 
                    if($r1)
                    {
                        $q2 = "INSERT INTO formations(`s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `pfe`, `m1`, `m2`, `m3`, `m4`, `MG`, `MM`, `MME`, `auto_decision`, `decision`) VALUES (0,0,0,0,0,0,0,0,0,0,0,0,0,0,'null', 'null')";
                        $r2 = mysqli_query($conn, $q2);
                        if($r2)
                        {
                            $_SESSION['username'] = $matricule;
                            $_SESSION['code'] = $code;
                            header('location: ./ajouter_bourse.php');
                        }else
                        {
                            array_push($errors, "un problem dans serveur.. veuillez reessayez plus tard.");
                        }
                        
                    }else
                    {
                        array_push($errors, "un problem dans serveur.. veuillez reessayez plus tard.");
                    }

                }else 
                {
                    array_push($errors, "un problem dans serveur.. veuillez reessayez plus tard.");
                
                }
                
                
            }else
            {
                   array_push($errors, "vous etes deja inscrit dans notre service");
            }}
        }


    // LOGIN USER
    if ($_POST['LOGIN'] == 'LOGIN' && isset($_POST['LOGIN'])) {
		
        $matricule  = mysqli_real_escape_string($conn, $_POST['matricule']);
		$pwd        = mysqli_real_escape_string($conn, $_POST['password']);
        
		if (empty($matricule)) {
			array_push($errors_login, "champ matricule est obligatoire");
        }
        if (empty($pwd)) {
			array_push($errors_login, "champ mot du passe est obligatoire");
		}

		if (count($errors_login) == 0) {
			$query = "SELECT * FROM compte WHERE matricule='$matricule'";
            $results = mysqli_query($conn, $query);
            if(mysqli_num_rows($results) == 1)
            {
                $pwd = md5($pwd);

                while($row = mysqli_fetch_array($results))
                {
                 $res  = $row["id"];
                 $pass = $row["password"];
                 $code = $row['code'];
                 $matricule = $row['matricule'];
                 $state = $row['Isdeleted'];
                }
                if($state == "false")
                {
                    if($pwd == $pass)
                    {
                         $_SESSION['username'] = $matricule;
                         $_SESSION['code'] = $code;
                         $_SESSION['id'] = $res; 
                         header('location: ./ajouter_bourse.php');
                    }else 
                    {
                        array_push($errors_login, "mot du passe sont incorrect");
                    
                    }
                }else
                {
                    array_push($errors_login, "vous avez deja supprimez votre compte");
                }
                
                
                
            }else
            {
                   array_push($errors_login, "vous n'etes pas inscrit dans notre service");
            }}
        }

    // REST PASSWORD USER
    if ($_POST['PASSWORD'] == 'PASSWORD' && isset($_POST['PASSWORD'])) {
		
        $code  = mysqli_real_escape_string($conn, $_POST['code']);
		$pwd1        = mysqli_real_escape_string($conn, $_POST['password']);
        $pwd2        = mysqli_real_escape_string($conn, $_POST['password_confirme']);

		if (empty($code)) {
			array_push($errors_pass, "champ code est obligatoire");
        }
        if (empty($pwd1)) {
			array_push($errors_pass, "champ mot du passe est obligatoire");
		}
        if (empty($pwd2)) {
			array_push($errors_pass, "champ confirmation de mot de passe est obligatoire");
        }
        if($pwd1 != $pwd2)
        {
            array_push($errors_pass, "faux mot de passe de confirmation");
        }

		if (count($errors_pass) == 0) {
			$query = "SELECT * FROM compte WHERE code='$code'";
            $results = mysqli_query($conn, $query);
            if(mysqli_num_rows($results) == 1)
            {
                $pwd1 = md5($pwd1);
                $sql = "UPDATE compte SET `password` = '$pwd1' WHERE code='$code'";
                $updated = mysqli_query($conn, $sql);
                if($updated)
                {

                while($row = mysqli_fetch_array($results))
                {
                 $res  = $row["id"];
                 $code = $row['code'];
                 $matricule = $row['matricule'];
                }

                $_SESSION['username'] = $matricule;
                $_SESSION['code'] = $code;
                $_SESSION['id'] = $res; 
                header('location: ./ajouter_bourse.php');
                
                }else
                {
                    array_push($errors_pass, "server error, veuillez resseyez plus tard!");
                }
 
            }else
            {
                   array_push($errors_pass, "un tag de securité n'est pas valide");
            }}
        }

?>


