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




	 
			<!--h1>Consultation Approvisionnement</h1-->
		
			     <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Consultation Approvisionnement<span style="color: white; font-weight: bold;"></span></h3>
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
					<!--th>Enregistrer par</th-->
					<th> <center>Numero</center> </th>
					<th> <center>Fournisseur</center> </th>
					<th> <center> Date approv.</center> </th>
					<th> <center> Montant approv.</center> </th>
					<th><center> Montant regle </center> </th>
					<th><center> Montant reste a regle</center> </th>
					<th><center> Voir detail</center> </th>
					
				</tr>
				
				<?php

					if ((isset($_GET['date_debut']))&&(isset($_GET['date_fin']))&&(!empty($_GET['date_debut']))&&(!empty($_GET['date_fin'])))
					{
						//echo "<b>Date debut</b> ".$_GET['date_debut']."<br>";
						//echo "<b>Date fin</b> ".$_GET['date_fin']."<br>";
						//echo "<hr>";
						
						$req=$pdo->query("select distinct nom_four,date_approv,mont_four,mont_regle,approv.id_approv,approv.enreg_par from four,approv,stock_prod where approv.id_approv=stock_prod.id_approv and four.id_four=approv.id_four and stock_prod.id_magasin=1 and date_approv between '".$_GET['date_debut']."' and '".$_GET['date_fin']."' order by approv.id_approv");
								
								while ($ta=$req->fetch()) 
								{
									$req00=$pdo->query("select pseudo from utilisateur where id_user='".$ta[5]."'");
									$ta00=$req00->fetch(); 
									
								?>

											<form action="detail.php" method="GET">

								<?php

													echo "<tr>";
													echo "<td><center>$ta[4]</center></td>";
													echo "<td>$ta[0]</td>";
													echo "<td>$ta[1]</td>";
													echo "<td>$ta[2]</td>";
													echo "<td>$ta[3]</td>";
													$res = $ta[2]-$ta[3];
													echo "<td>$res</td>";

													echo "<input type=hidden name=detail_approv value=$ta[4] >";

													echo "<td> <input type=submit class=\"btn btn-primary\" value=\"Voir Detail\"> </td>";													
													
													echo "<tr>";
											echo "</form>";		
												
								}
	
									

					}else
					{
						$req=$pdo->query("select distinct nom_four,date_approv,mont_four,mont_regle,approv.id_approv,approv.enreg_par from four,approv,stock_prod where approv.id_approv=stock_prod.id_approv and four.id_four=approv.id_four and stock_prod.id_magasin=1 order by approv.id_approv");
								
								while ($ta=$req->fetch()) 
								{
									$req00=$pdo->query("select pseudo from utilisateur where id_user='".$ta[5]."'");
									$ta00=$req00->fetch(); 
									
								?>

											<form action="detail.php" method="GET">

								<?php

													echo "<tr>";
												echo "<td><center>$ta[4]</center></td>";
													echo "<td>$ta[0]</td>";
													echo "<td>$ta[1]</td>";
													echo "<td>$ta[2]</td>";
													echo "<td>$ta[3]</td>";
													$res = $ta[2]-$ta[3];
													echo "<td>$res</td>";

													echo "<input type=hidden name=detail_approv value=$ta[4] >";

		echo "<td> <input type=submit class=\"btn btn-primary\" value=\"Voir Detail\"> </td>";													
													
													echo "<tr>";
											echo "</form>";		
												
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