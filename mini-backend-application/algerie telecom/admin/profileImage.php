<?php include('db.php') ?>
<?php
    if(isset($_GET['id'])) {
        $sql = "SELECT imageType,imageData FROM profile_images WHERE id=" . $_GET['id'];
        $result = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($db));
        $row = mysqli_fetch_array($result);
        header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
    }
    mysqli_close($db);
?>