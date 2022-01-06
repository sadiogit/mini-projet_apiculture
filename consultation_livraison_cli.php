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
        if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectConfirme'])) )
			{
	            require_once("menu_principale_confirme.php");

			}else if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectCmdApprov'])) )
			{
		        require_once("menu_principale_cmdApprov.php");

			}else
			{
				header("location:deconnexion.php");
			}

			
	        require_once("connexion.php");
	?>
	
	
	 <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

                <div class="col-lg-12 text-center">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Recherche entre deux dates<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body"  >


			
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">


					<table style="float:left;">

						<th>Date debut</th>
							<th>
							 
                		   		<input type=date class="form-control"  name=date_debut >
                		  
							</th>
							
							<th>Date Fin</th>
							<th><input type=date class="form-control" name=date_fin ></th>

							<th><input type=submit class="btn btn-primary" value=Rechercher> </th>
						
						 
					 
</table>

			</form>

 
                                  </div>
                             
                              </div>
                         <!--/div>            
                       </div-->
                    </div>
                    </div>
                      <!-- Fin formulaire -->

		<article>

		  
		
			
			<!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Consultation Livraison Entite<span style="color: white; font-weight: bold;"></span></h3>
                                          <!--div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                          </div-->
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      
                                                      <!--th rowspan="">
                                                        <input type="text" class="form-control" placeholder="Recherche par pseudo" disabled>
                                                      </th-->


                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height:405%; height:405px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
				 
					<th><CENTER>N Commande</CENTER></th>
					<th><CENTER>Entite</CENTER></th>
					<th><CENTER>Date commande</CENTER></th>
					<!--th><CENTER>Montant commande</CENTER></th>
					<th><CENTER>Montant regle</CENTER></th>
					<th><CENTER>Montant reste a regle</CENTER></th-->
					<th><CENTER>Detail</CENTER></th>
					
				</tr>
				
				<?php

					if ((isset($_GET['date_debut']))&&(isset($_GET['date_fin']))&&(!empty($_GET['date_debut']))&&(!empty($_GET['date_fin'])))
					{
						echo "Date debut ".$_GET['date_debut']."<br>";
						echo "Date fin ".$_GET['date_fin']."<br>";
						
						$req=$pdo->query("select cmd.Id_cmd,cmd.Id_cli,cmd.Mont_total_cmd from cmd,detail_cmd,stock_prod where cmd.Id_cmd=detail_cmd.Id_cmd and detail_cmd.id_stock_prod=stock_prod.id_stock_prod and stock_prod.id_magasin=1 order by cmd.Id_cmd");
								
								while ($ta=$req->fetch()) 
								{
									$req1=$pdo->query("select sum(Mont_fourni_cli_cmd) from regle_cmd where Id_cmd='".$ta[0]."' order by id_regle_cmd");
								
									while ($ta0=$req1->fetch()) 
									{
										
											$req3=$pdo->query("select Date_regle_cmd from regle_cmd where Id_cmd='".$ta[0]."' and Date_regle_cmd between '".$_GET['date_debut']."' and '".$_GET['date_fin']."' order by id_regle_cmd desc");
								
											while ($ta3=$req3->fetch()) 
											{
												$req2=$pdo->query("select nom_cli,contact_cli from client where id_cli='".$ta[1]."' ");
										
													$ta2=$req2->fetch();

													$res =  $ta[2]-$ta0[0];	
										?>

											<form action="detail.php" method="GET">

										<?php

													echo "<tr>";

													echo "<td>$ta[0]</td>";
													echo "<td>$ta2[0]</td>";
													echo "<td>$ta3[0]</td>";
													
													echo "<input type=hidden name=detail_liv_cli value=$ta[0] >";

													echo "<td> <input class=\"btn btn-primary\" type=submit value=\"Voir Detail\"> </td>";													
													
													echo "<tr>";
											echo "</form>";		
												break;
											}
	
										
									}

									
								}

					}else
					{
						$req=$pdo->query("select Id_cmd,Id_cli,Mont_total_cmd from cmd order by Id_cmd");
								
								while ($ta=$req->fetch()) 
								{
									$req1=$pdo->query("select sum(Mont_fourni_cli_cmd) from regle_cmd where Id_cmd='".$ta[0]."' order by id_regle_cmd");
								
									while ($ta0=$req1->fetch()) 
									{
										
											$req3=$pdo->query("select Date_regle_cmd from regle_cmd where Id_cmd='".$ta[0]."' order by id_regle_cmd desc");
								
											while ($ta3=$req3->fetch()) 
											{
												$req2=$pdo->query("select nom_cli,contact_cli from client where id_cli='".$ta[1]."' ");
										
													$ta2=$req2->fetch();

													$res =  $ta[2]-$ta0[0];	
										?>

											<form action="detail.php" method="GET">

										<?php

													echo "<tr>";

													echo "<td>$ta[0]</td>";
													echo "<td>$ta2[0]</td>";
													echo "<td>$ta3[0]</td>";
													

													echo "<input type=hidden name=detail_liv_cli value=$ta[0] >";

													echo "<td> <input type=submit class=\"btn btn-primary\" value=\"Voir Detail\"> </td>";													
													
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
                                        </table>
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->
</body>