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
/*
		session_start();

		if (!isset($_SESSION['UserConnect']))
				{
					header("location:deconnexion.php");
				}
*/

		$_SESSION['produit']="";
		$_SESSION['quantite']="";
		$_SESSION['prix_unit']="";
		$_SESSION['four']="";
		$_SESSION['produit']="";
		$_SESSION['quantite']="";
		$_SESSION['montant']="";
		$_SESSION['date_vente']="";
		$_SESSION['client']="";

		require_once'menu_principale.php';
		//include'location:menu_principale.php';
	?>

		  <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

              

            <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center" style=" margin-left: 0%; ">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Liste des Reglement Entites<span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 
                                             </table>
                                              <div class="bg tablescroll" style="height: 500%; height:500px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
					<th><center>Client</center></th>
					<th><center>Contact</center></th>
					<th><center>Mnt regle</center></th>
					<th><center>Mnt reste a regle</center></th>
					<th><center>Date Reglement</center></th>
					<th><center>Montant a regle</center></th>
					<th><center>Date Reglement</center></th>
					<th><center>Validation</center></th>


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
													echo "<td><input type=\"text\" name=\"montant\" required class=\"form-control\"></td>";
													echo "<td><input type=\"date\" name=\"date_regle\" required class=\"form-control\"></td>";

													//echo"<td><input type=text name=montant required></td>";
													
													//echo"<td><input type=date name=date_regle required></td>";

													echo"<input type=hidden name=id_cmd value=$ta[0]></td>";

													?>

														<td><button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true">VALIDER</span></button></td>


														<?php

													//echo "<td><input type=submit value=Valider></td>";
													echo "<tr>";
													echo "</form>";

												
												break;
											}
	
										}
										
										
									}

									
								}
					
						
						?>

			</table>
	 </div>
	 </div>

	
	
</body>

