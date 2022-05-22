<?php 

session_start();
$errors = array();
$db = mysqli_connect("localhost", "root", "mysql","algerietelecom");
// LOGIN USER
if ($_POST['LOGIN'] == 'LOGIN' && isset($_POST['LOGIN'])) {
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($password)) {
        array_push($errors, "champ mot du passe est obligatoire");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM admin WHERE username='kenyon.johnston@ethereal.email' AND password='$password'";
        
        $results = mysqli_query($db, $query);
        if($results)
        {
            $id = 0;
            while($row = mysqli_fetch_array($results))
            {
             $id = $row["id"];
            }

            if (mysqli_num_rows($results) == 1) {
                $_SESSION['admin'] = 'kenyon.johnston@ethereal.email';
                $_SESSION['isAdmin'] = 'TRUE';
                $_SESSION['ADMIN_ID'] = $id;
                header('Location: index.php');
            }else {
                array_push($errors, "nom utilisateur ou mot du passe sont incorrect");
            }
        }else
        {
            array_push($errors, "SERVER ERROR: desolé pour cette occurace");
        } 
    }
}

?>