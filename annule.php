<?php
session_start();
require_once("connexion.php");

if (isset($_GET['annule'])) {
	
	$_SESSION['num_stock']="";
	$_SESSION['liv1']="";
	$_SESSION['t']=$_SESSION['gg'];
	$_SESSION['gg']="";
	

	header("location:livraison_approvision_detail.php");
}

if (isset($_GET['cmd'])) {
	
	$_SESSION['detail']="";
	$_SESSION['liv']="";

	
	header("location:livraison_cmd_detail1.php");
}

if (isset($_GET['recu_approv'])) {
	
	$_SESSION['produit']="";
	$_SESSION['four']="";
	$_SESSION['date_approv']="";

	$_SESSION['quantite']="";
	$_SESSION['prix_achat']="";
	$_SESSION['prix_vente']="";

	$_SESSION['date_exp']="";
	$_SESSION['quantite_liv']="";
	$_SESSION['code_prod']="";
					

	header("location:approvision.php");
}

if (isset($_GET['recu_vente']))  {
	
	$_SESSION['produit']="";
	$_SESSION['quantite']="";
	$_SESSION['quantite_liv']="";
	$_SESSION['montant']="";
	$_SESSION['date_vente']="";
	$_SESSION['client']="";
	$_SESSION['stock']="";
	$_SESSION['produit1']="";
	header("location:vente.php");
}

if((isset($_GET['dateEnreg']))&&(isset($_GET['modif']))&&(isset($_GET['nunero']))&&(isset($_GET['nom']))&&(isset($_GET['contact']))&&(isset($_GET['adresse'])))
{
	$sql="update client set Nom_cli='".$_GET['nom']."',Contact_cli='".$_GET['contact']."',Adr_cli='".$_GET['adresse']."', date_enreg_cli='".$_GET['dateEnreg']."' where Id_cli='".$_GET['nunero']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_client.php");
	}

	header("location:modification_suppression_client.php");
}

if((isset($_GET['sup']))&&(isset($_GET['numero1'])))
{
	echo "string";
	$sql="delete from client where Id_cli='".$_GET['numero1']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_client.php");
	}

	header("location:modification_suppression_client.php");
}

if((isset($_GET['dateEnregFour']))&&(isset($_GET['modiffour']))&&(isset($_GET['nunerofour']))&&(isset($_GET['nomfour']))&&(isset($_GET['contactfour']))&&(isset($_GET['adressefour']))&&(isset($_GET['categoriefour'])))
{
	$sql="update four set date_enreg_four='".$_GET['dateEnregFour']."', Nom_four='".$_GET['nomfour']."',Contact_four='".$_GET['contactfour']."',Adr_four='".$_GET['adressefour']."',Categorie_four='".$_GET['categoriefour']."' where Id_four='".$_GET['nunerofour']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_fournisseur.php");
	}

	header("location:modification_suppression_fournisseur.php");
}

if((isset($_GET['supfour']))&&(isset($_GET['numero1four'])))
{
	$sql="delete from four where Id_four='".$_GET['numero1four']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_fournisseur.php");
	}

	header("location:modification_suppression_fournisseur.php");
}

if ((isset($_GET['numerocat']))&&(isset($_GET['cat']))&&(isset($_GET['modifcat']))) 
{
	
	$sql="update cat set categ='".$_GET['cat']."' where id_cat='".$_GET['numerocat']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_categorie.php");
	}

	header("location:modification_suppression_categorie.php");

}

if ((isset($_GET['numero1cat']))&&(isset($_GET['supcat'])))
{
	$sql="delete from cat where id_cat='".$_GET['numero1cat']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_categorie.php");
	}

	header("location:modification_suppression_categorie.php");	
}

if((isset($_GET['modifProd']))&&(isset($_GET['nuneroProd']))&&(isset($_GET['produit']))&&(!empty($_GET['cat1']))&&(isset($_GET['cat1']))&&(isset($_GET['desc_prod'])))
{
	
	$sql="UPDATE `prod` SET `Nom_prod`='".$_GET['produit']."',`id_cat`='".$_GET['cat1']."',`Desc_prod`='".$_GET['desc_prod']."' WHERE `Id_prod`='".$_GET['nuneroProd']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_produit.php");
	}

	//header("location:modification_suppression_produit.php");
}

if((isset($_GET['supProd']))&&(isset($_GET['numero1Prod'])))
{
	$sql="delete from prod where Id_prod='".$_GET['numero1Prod']."'";
	if(mysql_query($sql))
	{
		header("location:modification_suppression_produit.php");
	}

	header("location:modification_suppression_produit.php");
}


?>