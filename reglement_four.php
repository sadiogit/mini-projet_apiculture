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
                       

              

            <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center" >
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Liste des fournisseurs a regle<span style="color: white; font-weight: bold;"></span></h3>
                                          <!--div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                          </div-->
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                  
                                             </table>
                                              <div class="bg tablescroll" style="height: 500%; height:500px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
					<th><center>Fournisseur</center></th>
					<th><center>Contact</center></th>
					<th><center>Montant Remi</center></th>
					<th><center>Montant reste</center></th>
					<th><center>Date reglement</center></th>
					<th><center>Montant</center></th>
					<th><center>Date reglement</center></th>
					<th><center>Validation</center></th>


                                                    </tr>
                                                        
                                                       
					<?php

							$req=$pdo->query("select id_approv,id_four,mont_four from approv order by id_approv");
								
								while ($ta=$req->fetch()) 
								{
									$req1=$pdo->query("select sum(Mont_remis_four) from regle_four where id_approv='".$ta[0]."' order by id_regle_four");
								
									while ($ta0=$req1->fetch()) 
									{
										if ($ta[2]>$ta0[0])
										{
											$req3=$pdo->query("select Date_regle_four from regle_four where id_approv='".$ta[0]."' order by id_regle_four desc");
								
											while ($ta3=$req3->fetch()) 
											{
												$req2=$pdo->query("select nom_four,contact_four from four where id_four='".$ta[1]."' ");
										
													$ta2=$req2->fetch() ;

													$res =  $ta[2]-$ta0[0];	

										?>

											<form action="confirme_reglement_four.php" method="GET"> 

										<?php

													echo "<tr>";

														echo "<td>$ta2[0]</td>";
														echo "<td>$ta2[1]</td>";
														echo "<td>$ta0[0]</td>";
														echo "<td>$res</td>";
														echo "<td>$ta3[0]</td>";

														echo "<td><input type=\"text\" name=\"montant\" required class=\"form-control\"></td>";
														echo "<td><input type=\"date\" class=\"form-control\" name=\"date_regle\" required></td>";
														?>

														<td><button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true">VALIDER</span></button></td>


														<?php
														echo "<input type=hidden name=id_approv value=$ta[0]>";


													echo "<tr>";

											echo "</form>";
													//echo "<option value=\"$ta[0]\" >$ta2[0]	$ta2[1]	$ta0[0]	$res $ta3[0]</option>";
												
												break;
											}
	
										}
										
										
									}

									
								}
															
							
					?>
       </table>
                                                </div>
                                        </table>
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->
	
</body>

