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
		if (!isset($_SESSION['UserConnect']))
				{
					header("location:deconnexion.php");
				}
				require_once'menu_principale.php';
	?>
	
	
	 
   <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"> <span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style="height:350%; height:350px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
				
				
				 
					<th> <center>Produit</center> </th>
					<th><center>Quantite en stock</center></th>
					<th><center>Date d'expiration</center></th>
					<th><center>Quantite a purger</center></th>					
					<th><center>Date purge</center></th>
					<th><center>Motif</center></th>

				</tr>

							<?php
							$req=$pdo->query("select Nom_prod,Quant_prod_stock,Date_exp,Id_stock_prod from prod,stock_prod where stock_prod.Id_prod=prod.Id_prod and Quant_prod_stock>0 and id_magasin=1 order by prod.Nom_prod");
							while ($ta=$req->fetch()) 
							{
							?>

							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

							<?php
								echo "<tr>";
								echo "<td style=\"width: 25%; text-align: center;\">$ta[0]</td>";
								echo "<td>$ta[1]</td>";
								echo "<td>$ta[2]</td>";
								
								
								echo "<td><input type=number class=\"form-control\" name=quantite_purgee required min=1 max=$ta[1]></td>";
								echo "<td><input type=date class=\"form-control\" name=date_purge required></td>";
								echo "<td><input type=text class=\"form-control\" name=motif required></td>";
								
								echo "<input type=hidden name=produit value=$ta[3]>";
								echo "<input type=hidden name=quantite value=$ta[1]>";

								echo "<td><input  class=\"btn btn-primary\" type=submit value=Purger></td>";

								echo "</tr>";

								echo "</form>";

							}
						?>
				
			</table>			
		</form>

		 
				
	 
                                                </div>
                                        </table>
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->	

		<?php

			if (isset($_GET['produit']))
			{
				$q = $_GET['quantite'] - $_GET['quantite_purgee'];

				
				$req="INSERT INTO `purger`(`quantite_purgee`, `quantite_dispo`, `motif`, `date_purge`, `id_stock_prod`) VALUES ('".$_GET['quantite_purgee']."','".$_GET['quantite']."','".$_GET['motif']."','".$_GET['date_purge']."','".$_GET['produit']."')";
				$pdo->exec($req);

				$req="update stock_prod set Quant_prod_stock='".$q."' where  Id_stock_prod='".$_GET['produit']."' ";
				$pdo->exec($req);

				//header("location:purger.php");



			}


		?>
 
		
		   <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Produits purge<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style="height:300%; height:300px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
				
				
				 
					<th> <center>Produit</center> </th>
					<th><center>Quantite en stock</center></th>
					<th><center>Date d'expiration</center></th>
					<th><center>Quantite purgee</center></th>
					<th><center>Motif</center></th>
					<th><center>Date purge</center></th>

				</tr>

							<?php
							$req=$pdo->query("select prod.Nom_prod,quantite_dispo,Date_exp,quantite_purgee,motif,date_purge from purger,prod,stock_prod where purger.Id_stock_prod=stock_prod.Id_stock_prod and stock_prod.Id_prod=prod.Id_prod and id_magasin=1 order by prod.Nom_prod");
							while ($ta=$req->fetch()) 
							{
							
								echo "<tr>";
								echo "<td style=\"width: 25%; text-align: center;\">$ta[0]</td>";
								echo "<td>$ta[1]</td>";
								echo "<td>$ta[2]</td>";
								echo "<td>$ta[3]</td>";
								echo "<td>$ta[4]</td>";
								echo "<td>$ta[5]</td>";
								
								echo "</tr>";

								
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