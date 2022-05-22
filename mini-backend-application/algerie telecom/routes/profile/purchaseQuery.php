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
  <?php include("../../../server/seconddb.php"); ?>

  <?php 

  if(isset($_POST['ITEM']))
  {
    $commandPrice = 0;
      
      if(isset($_POST['this_item_id'])) $itemID = (int)$_POST['this_item_id'];
      else $itemID = 0;

      if(isset($_POST['quantite_acheter'])) $purchase_quantite = (int)$_POST['quantite_acheter'];
      else $purchase_quantite = 0;

      if(isset($_POST['purchase_date'])) $purchase_date = $_POST['purchase_date'];
      else $purchase_date = '';

     //get the money from the bank:
     $q1 = "SELECT * FROM clientaccount,clients WHERE clientaccount.id = clients.id AND clientaccount.id = $clientID";
     $res1 = mysqli_query($conn, $q1);
     $data_set1 = array();
     if($res1)
     {
       while($row1 = mysqli_fetch_array($res1))
       {
         $data_set1[] = $row1; 
       }
     }else
     {
       echo "error q1";
     }

     $idBank = $data_set1[0]["idBank"];
     
     $q2 = "SELECT * FROM bankccp WHERE numero_check = $idBank";
     $res2 = mysqli_query($connection,$q2);
     $data_set2 = array();
     if($res2)
     {
       while($row2 = mysqli_fetch_array($res2))
       {
         $data_set2[] = $row2; 
       }
     }else
     {
       echo "error q2";
     }

     $ccpAmount = (double)$data_set2[0]['compte'];
     //get the price of the product from product table:
     $q3 = "SELECT * FROM produits WHERE produits.id = $itemID";
     $res3 = mysqli_query($conn,$q3);
     $data_set3 = array();
     if($res3)
     {
       while($row3 = mysqli_fetch_array($res3))
       {
         $data_set3[] = $row3; 
       }
     }else
     {
       echo "error q3";
     }
     //perfome calculation and check if the bank amount is more or equal to commandprice:
      //never set a value as a place holder
    $commandPrice = $purchase_quantite * (double)$data_set3[0]["prix"];
    
    echo $commandPrice."<br>";
    echo $purchase_quantite."<br>";
    echo $data_set3[0]["prix"]."<br>";
    echo $data_set3[0]["quantite"]."<br>";
    
   
    if($commandPrice <= $ccpAmount && $purchase_quantite <= (int)$data_set3[0]["quantite"] && (int)$data_set3[0]["quantite"] != 0 && $purchase_quantite != 0 && $commandPrice != 0)
    {
        //continue a super huge logic
        //save the purchase in the purchase table (d'achat ):
    
     $q4 = "INSERT INTO achats(idClient,idProduct,date,quantite,prixCommand)VALUES ($clientID, $itemID, '$purchase_date',$purchase_quantite, $commandPrice)";
     $res4 = mysqli_query($conn,$q4);
     //no data_set4 for q4 :<
     if($res4)
     {
        //if the purchase is being add perfectly go to update the item table types ( modem or cards)
       //retreive all active items of the same products and change their status:
       
       $table = str_replace("'", '`', $data_set3[0]['type']);
     $q5 = "SELECT * FROM $table WHERE idproduit= $itemID AND status='Active'   ORDER BY n_serie ASC";
     $res5 = mysqli_query($conn,$q5);
     $data_set5 = array();
     if($res5 && mysqli_num_rows($res5) > 0)
     {
       while($row5 = mysqli_fetch_array($res5))
       {
         $data_set5[] = $row5; 
       }
       for($counter = 0; $counter < $purchase_quantite; $counter++)
       {
           echo $data_set5[$counter]['n_serie']."<br>";

           $q6 = "UPDATE $table SET status=".(string)$clientID." WHERE n_serie=".(int)$data_set5[$counter]['n_serie']."";
           $res6 = mysqli_query($conn,$q6);
         
       }
       //if we successfully updated all the items of the same products we need to change the quantite of that product
       if($counter == $purchase_quantite)
       {
            
           $updatePurchaseNumber = (int)$data_set3[0]['n_achats'] + $purchase_quantite; 
           $updateQuantite = count($data_set5) - $purchase_quantite;
           $updateBenifits = (double)$data_set3[0]['totalreveue'] + $commandPrice;
           echo $updateQuantite."<br>";
           echo $updatePurchaseNumber."<br>";
           echo $updateBenifits."<br>";
           echo count($data_set5);
      /*
           $q7 = "UPDATE produits SET quantite= $updateQuantite , n_achats= $updatePurchaseNumber , totalreveue= $updateBenifits WHERE id=$itemID";
           $res7 = mysqli_query($conn,$q7);

           if($res7)
           {
            //change all statistics of stat table:
            //there is another way to do that fast and easy but not that much sercure:
            //rather than the sum of all categories each time, you can add the last purchase made
            //as a change of statistics of revenue of each item change.

            //i choose the long way to do so:
            $revenue_modem_adsl = 0;
            $revenue_carte_adsl = 0;
            $revenue_modem_4glte = 0;
            $revenue_carte_4glte = 0;

            $s1 = "SELECT SUM(`totalreveue`) as total FROM produits WHERE nature='ADSL' AND type='modem'";
            $stat1 = mysqli_query($conn,$s1);
            
            if($stat1 && mysqli_num_rows($stat1) == 1)
            {
              $row = mysqli_fetch_assoc($stat1); 
              $revenue_modem_adsl = (double)$row['total'];
              
           
            $s2 = "SELECT SUM(`totalreveue`) as total FROM produits WHERE nature='ADSL' AND type='carte'";
            $stat2 = mysqli_query($conn,$s2);
            
            if($stat2 && mysqli_num_rows($stat2) == 1)
            {
              
              $row = mysqli_fetch_assoc($stat2); 
              $revenue_carte_adsl = (double)$row['total'];


            $s3 = "SELECT SUM(`totalreveue`) as total FROM produits WHERE nature='4GLTE' AND type='modem'";
            $stat3 = mysqli_query($conn,$s3);
           
            if($stat3 && mysqli_num_rows($stat3) == 1)
            {
              $row = mysqli_fetch_assoc($stat3); 
              $revenue_modem_4glte = (double)$row['total'];
            

            $s4 = "SELECT SUM(`totalreveue`) as total FROM produits WHERE nature='4GLTE' AND type='carte'";
            $stat4 = mysqli_query($conn,$s4);
            
            if($stat4 && mysqli_num_rows($stat4) == 1)
            {
              $row = mysqli_fetch_assoc($stat4); 
              $revenue_carte_4glte = (double)$row['total'];
           
            $total = $revenue_carte_4glte + $revenue_modem_4glte + $revenue_carte_adsl + $revenue_modem_adsl;
            
            //UPDATE:
            $statistics = "UPDATE `statistique` SET `revenueADSL_carte`=$revenue_carte_adsl,`revenue4G_carte`=$revenue_carte_4glte,`revenue_ADSL_m`=$revenue_modem_adsl, `revenue_4G_m`=$revenue_modem_4glte,`revenueTotal`=$total WHERE id=1";
            $results_statistics = mysqli_query($conn,$statistics);
        
        }}}} //fin statistics revenue !!

           }


           
           //consult the ccp account to retreive the cost:
           $compte = $ccpAmount - $commandPrice;
           $q8 = "UPDATE `bankccp` SET `compte`= $compte,`consultation`=$commandPrice,`consultationdate`= '$purchase_date' WHERE numero_check=".(int)$data_set1[0]['idBank']."";
           $res8 = mysqli_query($connection,$q8);
           if($res8)
           {
           
            //if we retreive money perfectly it's time to join that to paiement to make sure the user knows how much 
            //money is being spents as a algerie telecom subscriber
            //we can add directly the amount to paiement or go long and secure and calculate all purchases doing by same user
            //i go with the second long approach:
            $q9 = "SELECT SUM(`prixCommand`) as totalPaiement FROM achats WHERE idClient = $clientID";
            $res9 = mysqli_query($conn,$q9);
            if($res9 && mysqli_num_rows($res9) > 0)
            {
                
              $row = mysqli_fetch_assoc($res9); 
              $sum_total = (double)$row['totalPaiement'];
                //update client paiement:
                $q10 = "UPDATE clients SET paiement= $sum_total WHERE id = $clientID";
                $res10 = mysqli_query($conn,$q10);
                //if all purchase ends successfully:
                if($res10)
                  {
                    if($data_set3[0]['type'] == 'modem')
                    {
                        header("Location: profile.php");
                       
                    }else if($data_set3[0]['type'] == 'carte')
                    {
                       
                      header('Location: carte.php');
                    }
                 
                 
                  }
              


            }
           }
        }
    }}else
    {
        //if an error is occur purchase must be cancel back to status of if (commandprice > bank amount )
        //stop the transaction
        
        $_SESSION['ERROR'] = "Erreur connexion veuillez ressyez plus tard .";
        mysqli_close($conn);
        mysqli_close($connection);
        header("Location: purchase.php");

    }}else
    {
        //stop the transaction
        
        if($purchase_quantite <= (int)$data_set3[0]["quantite"])
        {
          $_SESSION['ERROR'] = "Impossible de continue l'achat quanitte produit insuffisant ..!";
        }else if($commandPrice <= $ccpAmount)
        {
          $_SESSION['ERROR'] = "Impossible de continue l'achat credit insuffisant ..! commandprice=".$commandPrice."ccp amount:".$ccpAmount."database quantite:".$data_set3[0]["quantite"]." purchased quantite:".$purchase_quantite;
        }else if($purchase_quantite == 0)
        {
          $_SESSION['ERROR'] = "Rien n'etait selectioner veuillez saisir les chose correctement";
        }else
        {
          $_SESSION['ERROR'] = "Produit pas disponible";
        }
        
        mysqli_close($conn);
        mysqli_close($connection);
        header("Location: purchase.php");

    }
}else
{
        
        header("Location: item.php");  
}
*/
  }}}}}
?>

