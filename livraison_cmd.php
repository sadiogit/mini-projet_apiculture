<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Accueil</title>
	<link rel="stylesheet" href="css3.css" type="text/css">
	
</head>
<body>
	<?php 

		session_start();
        if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectCmdApprov'])) )
		{
	        require_once("menu_principale_cmdApprov.php");

		}else
		{
			header("location:deconnexion.php");
		}

		
        require_once("connexion.php");
				
		if((isset($_SESSION['t1'])))
		{
			unset($_SESSION['t1']);					
		}
		
		
		$_SESSION['produit']="";
		$_SESSION['quantite']="";
		$_SESSION['prix_unit']="";
		$_SESSION['four']="";
		$_SESSION['produit']="";
		$_SESSION['quantite']="";
		$_SESSION['montant']="";
		$_SESSION['date_vente']="";
		$_SESSION['client']="";

	?>



	<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><b>Liste des commandes non entierement livree</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height: 500%; height:500px;">
                                                    <table class="table table-bordered table-striped"  >

                                                       
			  <tr>
				  
					<th><center>N Commande</center></th> 
					<th><center>Entite</center></th> 
					<th><center>Contact</center></th>	
				 
					<!--th><center>Montant regle</center></th> 
					<th><center>Montant reste a regle</center></th--> 
					<th><center>Detail</center></th> 
					<th><center>Livree</center></th> 
					
				</tr>
		<?php

				$sql="select id_cmd,id_cli,mont_total_cmd from cmd ";
				$req=$pdo->query($sql);

				while ($tableau=$req->fetch()) 
				{
					$sql2="select sum(`Quant_reste_a_livrer`) from detail_cmd where id_cmd= '".$tableau[0]."' ";
					$req2=$pdo->query($sql2);
					while ($tab2 = $req2->fetch())
					{
						if($tab2[0]>0)
						{
							$sql1="select nom_cli,adr_cli,Contact_cli from client where id_cli='".$tableau[1]."' ";
							$req1=$pdo->query($sql1);
							$tab1=$req1->fetch();

							$sql3="select sum(mont_fourni_cli_cmd) from regle_cmd where id_cmd= '".$tableau[0]."' ";
							$req3=$pdo->query($sql3);
							$tab3=$req3->fetch();

							$res = $tableau[2] - $tab3[0];

							echo"

									<tr>
									<td><center>$tableau[0]</center></td> 
									<td><center>$tab1[0]</center></td> 
									<td><center>$tab1[2]</center></td> 
									 
									<td>
									<a href=\"detail.php?detail_liv_cli=$tableau[0]\"><input type=button class=\"btn btn-primary\"  value=Detail></a></td>

									<td><a href=\"livraison_cmd_detail1.php?num=$tableau[0]\"><input class=\"btn btn-primary\"  type=button value=Livrer></a></td>								
									
									</tr>
							 ";


						}
					}
				}
			

		?>
				

			
                                               
                                                    </table>
                                                </div>
                                        </table>
                           
                              </div>
                            
                           </div>
                        </div>
                      </div>
                      <!-- Fin tableau --> 			
			 
	<?php
	//}else
	//{
	 //	header("location:deconnexion.php");
	//}
	?>
</body>