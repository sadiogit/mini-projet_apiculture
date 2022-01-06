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
    	if( (!isset($_SESSION['UserConnect'])) || (!isset($_SESSION['UserConnectCmdApprov'])) )
        {
            header("location:deconnexion.php");
        }

        require_once("menu_principale_cmdApprov.php");
        require_once("connexion.php");


		if((isset($_SESSION['t'])))
		{
			unset($_SESSION['t']);					
		}

		if((isset($_SESSION['num_stock'])))
		{
			$_SESSION['num_stock']="";					
		}

		if((isset($_SESSION['liv1'])))
		{
			$_SESSION['liv1']="";					
		}

		if((isset($_SESSION['gg'])))
		{
			unset($_SESSION['gg']);					
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
			//require_once'menu_principale.php';
	?>

			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><b>Liste des approvisionnement non entierement livree</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height: 500%; height:500px;">
                                                    <table class="table table-bordered table-striped"  >

                                                       
			  <tr>
				  	 <th><center>Fournisseur</center></th>
				  	 <th><center>Contact</center></th>
					 <th><center>Adresse</center></th> 
					 <th><center>Montant regle</center></th> 
					 <th><center>Montant reste a regle</center></th>
			 
					 <th><center>Acte</center></th>
					
					 
					
					
				</tr>

				<?php

						$sql="select distinct id_approv from stock_prod where Quant_reste_a_livrer_approv > 0 ";
						$req=$pdo->query($sql);

						while ($tableau=$req->fetch()) 
						{
							$sql1="select sum(Mont_remis_four) from regle_four where id_approv=".$tableau[0]." ";
							$req1=$pdo->query($sql1);
							$tab1=$req1->fetch();

							$sql2="select Mont_four,nom_four,contact_four,adr_four from approv,four where approv.id_four=four.id_four and id_approv=".$tableau[0]." ";
							$req2=$pdo->query($sql2);
							$tab2=$req2->fetch();



							
								echo "
										<tr>
											<td><center>$tab2[1]</center></td> 
									 ";
									 
									 echo "

									 		<td><center>$tab2[2]</center></td>
									 ";
									 
									 echo " 

									 		<td><center>$tab2[3]</center></td>									
											
									 ";

									 		echo " 

									 		<td><center>$tab1[0]</center></td>									
										
											 ";

											 $res = $tab2[0] - $tab1[0];

											 echo " 

											 		<td><center>$res</center></td>									
												
											 ";
										

	echo " 
<td><a href=\"detail.php?detail_liv_four=$tableau[0]\"><input type=button class=\"btn btn-primary\" value=Detail></a>
<a href=\"livraison_approvision_detail.php?num=$tableau[0]\"><input type=button class=\"btn btn-primary\" value=Livrer></a></td>								
											
										</tr>
									 ";
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
</body>