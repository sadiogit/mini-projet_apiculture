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

		}if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectCmdApprov'])) )
		{
            require_once("menu_principale_cmdApprov.php");
		}
		/*else
		{
			header("location:deconnexion.php");
			
		}*/

		
        require_once("connexion.php");
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
					
						<!--td></td>
						<td><a href="menu_principale.php">Accueil</a></td>
						<td></td>
						<td><a href="deconnexion.php" >Deconnexion</a></td>
						<td></td><td></td-->

					<?php
					}


					?>
						

					</table>
			</form>
		</aside>
		<article>
			 

			 <!-- Debut tableau --> 
<br>

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Stock rupture<span style="color: white; font-weight: bold;"></span></h3>
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
				
				 
				 
					<th><center>Categorie</center></th>
					<th><center>Produit</center></th>
					<th><center>Quantite en stock</center></th>
					<th><center>Quantite commandee</center></th>
					<th><center>Quantite livree</center></th>
					<th><center>Prix d'achat</center></th>
					<!--th><center>Prix de vente</center></th!-->
					<th><center>Date stock</center></th>
					<th><center>Date d'expiration</center></th>		

				</tr>

							<?php

								
							$req=$pdo->query("select categ,Nom_prod,Quant_prod_stock,stock_prod.quant_demande,Quant_approv,stock_prod.Prix_achat_prod,stock_prod.Prix_vente_prod,date_enreg_prod,Date_exp from cat,prod,stock_prod where cat.id_cat=prod.id_cat and stock_prod.Id_prod=prod.Id_prod and stock_prod.id_magasin=1 and Quant_prod_stock=0 order by prod.Nom_prod");
							while ($ta=$req->fetch() )
							{
								
									echo "<tr>";
									echo "<td>$ta[0]</td>";
									echo "<td>$ta[1]</td>";
									echo "<td>$ta[2]</td>";
									echo "<td>$ta[3]</td>";
									echo "<td>$ta[4]</td>";
									echo "<td>$ta[5]</td>";
									//echo "<td>$ta[6]</td>";
									echo "<td>$ta[7]</td>";
									echo "<td>$ta[8]</td>";

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