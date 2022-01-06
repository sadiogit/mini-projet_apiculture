<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Accueil</title>
	<link rel="stylesheet" href="css3.css" type="text/css">
	

</head>
<body>

	<?php 

		require_once("connexion.php");
		session_start(); 
		if ((isset($_SESSION['UserConnect']))||(isset($_SESSION['UserConnectSimple'])))
		{
		
		$_SESSION['produit']="";
		$_SESSION['quantite']="";
		$_SESSION['prix_unit']="";
		$_SESSION['four']="";
		$_SESSION['produit']="";
		$_SESSION['quantite']="";
		$_SESSION['montant']="";
		$_SESSION['date_vente']="";
		$_SESSION['client']="";

		$_SESSION['xx']="";
	?>
	
	
	<center>
		<aside>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
					<table style="float:right;">

					<?php

					if (isset($_SESSION['UserConnect']))
					{
					?>
					
						<!--td></td>
						<td><a href="menu_principale.php">Accueil</a></td>
						<td></td>
						<td><a href="deconnexion.php" >Deconnexion</a></td>
						<td></td><td></td-->

					<?php
					}else if (isset($_SESSION['UserConnectSimple']))
					{
					?>
					
						<td></td>
						<td><a href="menu_principale.php">Accueil</a></td>
						<td></td>
						<td><a href="deconnexion.php" >Deconnexion</a></td>
						<td></td><td></td>

					<?php
					}

					?>
						
						

					</table>
			</form>
		</aside>
		<article>

			<b>Reglement Client</b><br><br>
				
			<table border=1>

				<tr>
					<th>Client</th>
					<th>Contact</th>
					<th>Montant regle</th>
					<th>Montant reste a regle</th>
					<th>Date Reglement Commande</th>
					<th>Montant a regle</th>
					<th>Date Reglement</th>
				</tr>
				
				<?php


					$req=$pdo->query("select Id_cmd,Id_cli,Mont_total_cmd from cmd order by Id_cmd");
								
								while ($ta=$req->fetch()) 
								{
									$req1=$pdo->query("select sum(Mont_fourni_cli_cmd) from regle_cmd where Id_cmd='".$ta[0]."' order by id_regle_cmd");
								
									while ($ta0=$req1->fetch()) 
									{
										if ($ta[2]>$ta0[0])
										{
											$req3=$pdo->query("select Date_regle_cmd from regle_cmd where Id_cmd='".$ta[0]."' order by id_regle_cmd desc");
								
											while ($ta3=$req3->fetch()) 
											{
												$req2=$pdo->query("select nom_cli,contact_cli from client where id_cli='".$ta[1]."' ");
										
													$ta2=$req2->fetch();

													$res =  $ta[2]-$ta0[0];		

											?>

											<form action="confirme_reglement_cli.php" method="GET"> 

											<?php
													echo "<tr>";
													echo "<td>$ta2[0]</td>";
													echo "<td>$ta2[1]</td>";
													echo "<td>$ta0[0]</td>";
													echo "<td>$res</td>";
													echo "<td>$ta3[0]</td>";
													echo"<td><input type=text name=montant required></td>";
													echo"<td><input type=date name=date_regle required></td>";

													echo"<input type=hidden name=id_cmd value=$ta[0]></td>";

													echo "<td><input type=submit value=Valider></td>";
													echo "<tr>";
													echo "</form>";

												
												break;
											}
	
										}
										
										
									}

									
								}
					
						
						?>
				
	</table>
	</article>

</center>	

	<?php
	}else
	{
		header("location:deconnexion.php");
	}
	?>
</body>