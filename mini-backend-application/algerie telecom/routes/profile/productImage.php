<?php
    $conn = mysqli_connect("localhost", "root", "mysql", "algerietelecom");
    if(isset($_GET['id'])) {
        $sql = "SELECT imageType,imageData FROM output_images  WHERE id=" . $_GET['id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
	}
	mysqli_close($conn);
?>