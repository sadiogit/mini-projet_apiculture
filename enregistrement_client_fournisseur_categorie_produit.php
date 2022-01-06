<?php
			
		session_start();
    	if( (!isset($_SESSION['UserConnect'])) || (!isset($_SESSION['UserConnectCmdApprov'])) )
        {
            header("location:deconnexion.php");
        }

        require_once("connexion.php");


			if((isset($_GET['cat1']))&&(isset($_GET['nom1']))&&(isset($_GET['contact1']))&&(isset($_GET['adresse1']))&&(isset($_GET['date1'])))
			{

					$sql="insert into four(Nom_four,Adr_four,Contact_four,Date_enreg_four,Categorie_four) value('".$_GET['nom1']."','".$_GET['adresse1']."','".$_GET['contact1']."','".$_GET['date1']."','".$_GET['cat1']."')";
					if ($pdo->exec($sql)) 
					{
						header("location:fournisseur.php");
					}
			}


			if((isset($_GET['nom']))&&(isset($_GET['contact']))&&(isset($_GET['adresse']))&&(isset($_GET['dateEnreg'])))
			{
				
					$sql="insert into client(Nom_cli,Adr_cli,Contact_cli,Date_enreg_cli) value('".$_GET['nom']."','".$_GET['adresse']."','".$_GET['contact']."','".$_GET['dateEnreg']."')";
					if ($pdo->exec($sql)) 
					{
						header("location:client.php");
					}
			}
			
			if((!empty($_GET['cat']))&&(isset($_GET['produit']))&&(isset($_GET['desc_prod'])))
			{
				
				$sql="insert into prod(Nom_prod,id_cat,Desc_prod) values('".$_GET['produit']."','".$_GET['cat']."','".$_GET['desc_prod']."')";

						if ($pdo->exec($sql)) 
					{
						header("location:produit.php");
					}
			}

			if(isset($_GET['categ']))
			{
				$sql="insert into cat(categ) value('".$_GET['categ']."')";
				if ($pdo->exec($sql)) 
				{
					header("location:categorie.php");
				}	
			}	

		?>