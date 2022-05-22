<?php
  session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['ERROR'] = "You must log in first";
		header('location: ../login/login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
    unset($_SESSION['id']);
		header("location: ../login/login.php");
	}

    $clientID = $_SESSION['id'];
  ?>
<?php include("../../../server/firstdb.php"); ?>
<?php 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    if(isset($_POST["photo"]))
    {
        if(count($_FILES) > 0) {

            if(is_uploaded_file($_FILES['upload']['tmp_name'])) {
                
              $imgData =addslashes(file_get_contents($_FILES['upload']['tmp_name']));
              $imageProperties = getimageSize($_FILES['upload']['tmp_name']);
              $q = "SELECT * from clientaccount WHERE id= $clientID";
              $res = mysqli_query($conn, $q) or die("<b>Error:</b> Problem on fetch client<br/>" . mysqli_error($conn));
              $profileImage = 0;
              
              while($row = mysqli_fetch_array($res))
              {
                $profileImage = $row['imageProfile'];
              }
              $sql = "UPDATE profile_images SET imageType= '{$imageProperties['mime']}' ,imageData= '{$imgData}' WHERE id='$clientID'";
              $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
              if(isset($current_id)) {
                  header("Location: profile.php");
              }
            }
    }}else if(isset($_POST["pass"]))
        {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            if (empty($password)) {
              header("Location: profile.php");
            }
              $password = md5($password);
              $query = "SELECT * FROM clientaccount WHERE id='$clientID' AND password='$password'";
              
                    $results = mysqli_query($conn, $query);
                    if($results)
                    {
                      header("Location: resetpasswordP.php");
                        
                    }else
                    {
                      header("Location: profile.php");
                    }
                    
            }
          


?>