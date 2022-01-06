<?php
	
	session_start();

	$_SESSION['quantite_liv']=$_SESSION['quantite_liv']."//".$_GET['quantite_liv'];

							$_SESSION['code_prod']=$_SESSION['code_prod']."//".$_GET['code_prod'];

							$_SESSION['produit']=$_SESSION['produit']."//".$_GET['produit'];
							
							

							$_SESSION['quantite']=$_SESSION['quantite']."//".$_GET['quantite'];
							$_SESSION['prix_achat']=$_SESSION['prix_achat']."//".$_GET['prix_achat'];
							$_SESSION['prix_vente']=$_SESSION['prix_vente']."//".$_GET['prix_vente'];

							$_SESSION['date_exp']=$_SESSION['date_exp']."//".$_GET['date_exp'];
							header('location:approvision.php');


?>