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
		if ((isset($_SESSION['UserConnect']))||(isset($_SESSION['UserConnectSimple'])))
		{

		if (isset($_GET['detail_vente']))
		{
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

			<center>
				 
			 
			  <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Commande<span style="color: white; font-weight: bold;"></span></h3>
                                          <!--div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                          </div-->
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      
                                                      
                                                  </tr>
                                             </table>
                       <div class="bg tablescroll" style="height:98px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
				 
					<th> <center>N Commande</center> </th>
					<th> <center>Entite</center> </th>
					<th><center>Date commande</center></th>
					<!--th><center>Montant commande</center></center></th>
					<th><center>Montant regle</center></th>
					<th><center>Montant reste a regle</center></th-->					
				</tr>

	<?php

				$req1=$pdo->query("select nom_cli,cmd.Mont_total_cmd,mont_regle,mont_reste_a_regler,enreg_le from client,cmd where cmd.Id_cli=client.Id_cli and cmd.Id_cmd='".$_GET['detail_vente']."' ");
				while ($ta1=$req1->fetch()) 
				{

					echo"	<tr>
								<td>$_GET[detail_vente]</td>
								<td>$ta1[0]</td>
								<td>$ta1[4]</td>
								

							</tr>";

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
                                          <h3 class="panel-title">Detail commande<span style="color: white; font-weight: bold;"></span></h3>
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
								<th><center>Quantite Commandee</center></th>
								<th><center>Quantite Livree</center></th>
								<th><center>Quantite Reste a livree</center></th>
								<th><center>Prix Unitaire</center></th>
								<th><center>Date d'expiration</center></th>

							</tr>
<?php
						$req1=$pdo->query("select nom_prod,quant_cmd,quant_livrer,quant_reste_a_livrer,prix_unit,date_exp from prod,stock_prod,detail_cmd where prod.id_prod=stock_prod.id_prod and stock_prod.id_stock_prod=detail_cmd.id_stock_prod and stock_prod.id_magasin=1 and detail_cmd.Id_cmd='".$_GET['detail_vente']."' order by detail_cmd.id_detail_cmd ");
						while($ta1=$req1->fetch())
						{
							echo "<tr>";

								echo "<td>$ta1[0]</td>";
								echo "<td>$ta1[1]</td>";
								echo "<td>$ta1[2]</td>";
								echo "<td>$ta1[3]</td>";
								echo "<td>$ta1[4]</td>";
								echo "<td>$ta1[5]</td>";
								
							echo "<tr>";
										
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
<?php
				}
					
						
// Debut Confirmation de la commande
		}else if (isset($_GET['detail_confirmatio_vente']))
		{
			require_once("connexion.php");
           require_once'menu_principale.php';
	?>

			<center>
				<!--aside>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
							<table style="float:right;">
								
								<td></td>
								<td><a href="menu_principale.php">Accueil</a></td>
								<td></td>
								<td><a href="deconnexion.php" >Deconnexion</a></td>
								<td></td><td></td>

							</table>
					</form>
				</aside-->
				<article>

		 

				<!--a href=consultation_vente.php>Retour</a-->
			  <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"> <b>Commande</b> <span style="color: white; font-weight: bold;"></span></h3>
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
                      <!--div class="bg tablescroll" style="height:80%; height:80px;"-->
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
				 
					<th> <center>Client</center> </th>
					<th><center>Date commande</center></th>
					<th><center>Montant commande</center></center></th>
					<th><center>Montant regle</center></th>
					<th><center>Montant reste a regle</center></th>					
				</tr>

	<?php

				$req1=$pdo->query("select nom_cli,cmd.Mont_total_cmd,mont_regle,mont_reste_a_regler,enreg_le from client,cmd where cmd.Id_cli=client.Id_cli and cmd.Id_cmd='".$_GET['detail_confirmation_vente']."' ");
				while ($ta1=$req1->fetch()) 
				{

					echo"	<tr>
								<td>$ta1[0]</td>
								<td>$ta1[4]</td>
								<td>$ta1[1]</td>
								<td>$ta1[2]</td>
								<td>$ta1[3]</td>

							</tr>";

					?>
				
	 </table>
                                                </div>
                                        </table>
                           
                              <!--/div>
                           
                           <! /div-->
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->	


                   <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                     <h3 class="panel-title"> <span style="color: white; font-weight: bold;">Detail de la commande a Confirmer</span></h3>
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
								<th><center>Quantite Commandee</center></th>
								<th><center>Quantite Livree</center></th>
								<th><center>Quantite Reste a livree</center></th>
								<th><center>Prix Unitaire</center></th>
								<th><center>Date d'expiration</center></th>

							</tr>
<?php
						$req1=$pdo->query("select nom_prod,quant_cmd,quant_livrer,quant_reste_a_livrer,prix_unit,date_exp from prod,stock_prod,detail_cmd where prod.id_prod=stock_prod.id_prod and stock_prod.id_stock_prod=detail_cmd.id_stock_prod and stock_prod.id_magasin=1 and detail_cmd.Id_cmd='".$_GET['detail_confirmation_vente']."' order by detail_cmd.id_detail_cmd ");
						while($ta1=$req1->fetch())
						{
							echo "<tr>";

								echo "<td>$ta1[0]</td>";
								echo "<td>$ta1[1]</td>";
								echo "<td>$ta1[2]</td>";
								echo "<td>$ta1[3]</td>";
								echo "<td>$ta1[4]</td>";
								echo "<td>$ta1[5]</td>";
								
							echo "<tr>";
										
						}
 
					?>
				
	 </table>
                                                </div>
                                        </table>
                          
                              </div>
                            
                               <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
 
                            <button type="submit" style="width: 100%;" class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true"> Confirmer</span></button>
                            </form>
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->	
<?php
				}
					
		 

		   require_once("connexion.php");

		if ((isset($_GET['detail_confirmation_vente'])) )
		{
			//echo $_GET['produit']." ".$_GET['cat']." ".$_GET['contact']." ".$_GET['codeprod'];
			
			$sql="UPDATE `gesto`.`cmd` SET `etat_cmd`= '1' WHERE `cmd`.`Id_cmd`='".$_GET['detail_confirmation_vente']."' ";
			if ($pdo->exec($sql))
			{
				?>
				
		<script type="text/javascript">
			
			document.location.href="recharrge_confirmation.html";
		</script>

<?php
			}
		 
		
		}else
		{
				?>
				
		<script type="text/javascript">
			
			document.location.href="recharrge_confirmation.html";
		</script>

<?php
			
		}

	?>


	 	<?php			

		}

// Fin Confirmation de la commande
		else if (isset($_GET['detail_approv']))
		{
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

		
		 
				<!--aside>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
							<table style="float:right;">
								
								<td></td>
						<td><a href="menu_principale.php">Accueil</a></td>
						<td></td>
						<td><a href="deconnexion.php" >Deconnexion</a></td>
						<td></td><td></td>

							</table>
					</form>
				</aside-->
				<article>

		 <!--a href=consultation_approv.php>Retour</a-->
			
			 <div class="row" style="margin-right: 10%; margin-left: 10%; ">
				     <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Fournisseur<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style="height: 98px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
			 
					<th> <center>Fournisseur<center/> </th>
					<th> <center>Date approv.<center/></th>
					<th><center>Montant approv.<center/></th>
					<th><center>Montant regle<center/></th>
					<th><center>Montant reste a regle<center/></th>					
				</tr>

	<?php

		$req1=$pdo->query("select nom_four,date_approv,mont_four,mont_regle from four,approv where four.id_four=approv.id_four and approv.id_approv='".$_GET['detail_approv']."'");

		while ($ta1=$req1->fetch()) 
		{
			$res = $ta1[2] - $ta1[3];
			echo"
					<tr>
						<td>$ta1[0]</td>
						<td>$ta1[1]</td>
						<td>$ta1[2]</td>
						<td>$ta1[3]</td>
						<td>$res</td>					
					</tr>";
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
                 <!-- Fin Premiere tableau -->
<br>
			 <div class="row" style="margin-right: 10%; margin-left: 10%; ">
			
			  <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Detail de l'approvisionnement<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style="height: 450%; height:450px;">
                                                    <table class="table table-bordered table-striped"  >

                                      
			

					 
					<tr>
						<th> <center> Produit</center></th>
						<th><center>Quantite Demandee</center></th>
						<th><center>Quantite approv.</center></th>
						<th><center>Prix Achat</center></th>
						<th><center>Prix Vente</center></th>
						<th><center>Date d'expiration</center></th>					
					</tr> 
<?php
			$req=$pdo->query("select nom_prod,quant_demande,quant_approv,prix_achat_prod,prix_vente_prod,date_exp from prod,stock_prod where prod.id_prod=stock_prod.id_prod and stock_prod.id_approv='".$_GET['detail_approv']."' and stock_prod.id_magasin=1 order by stock_prod.id_stock_prod");
			while ($ta=$req->fetch()) 
			{

				echo "<tr>";
				echo "<td>$ta[0]</td>";
				echo "<td>$ta[1]</td>";
				echo "<td>$ta[2]</td>";
				echo "<td>$ta[3]</td>";
				echo "<td>$ta[4]</td>";
				echo "<td>$ta[5]</td>";
				echo "<tr>";
																
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
			<?php

		}

		
		}else if (isset($_GET['detail_regle_cli']))
		{
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

		<center>
				<!--aside>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
							<table style="float:right;">
								
								<td><a href="menu_principale.php">Accueil</a></td>
								<td><a href="deconnexion.php" >Deconnexion</a></td><td></td>
						<td><a href="menu_principale.php">Accueil</a></td>
						<td></td>
						<td><a href="deconnexion.php" >Deconnexion</a></td>
						<td></td><td></td>

							</table>
					</form>
				</aside-->
			 

		  	<!--a href=consultation_reglement_cli.php>Retour</a-->
			
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
				      <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"> Reglement Entite<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style=" height:98px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	 
				<tr>
					<th><center>Entite</center></th>
					<th><center>Date commande</center></th>
					<th><center>Montant commande</center></th>
					<th><center>Montant regle</center></th>
					<th><center>Montant reste a regle</center></th>					
				</tr>

	<?php

				$req1=$pdo->query("select nom_cli,cmd.Mont_total_cmd,mont_regle,mont_reste_a_regler,enreg_le from client,cmd where cmd.Id_cli=client.Id_cli and cmd.Id_cmd='".$_GET['detail_regle_cli']."' ");
				while ($ta1=$req1->fetch()) 
				{
					$req=$pdo->query("select sum(Mont_fourni_cli_cmd) from regle_cmd where Id_cmd='".$_GET['detail_regle_cli']."' ");
					$ta=$req->fetch();

					$res = $ta1[1] - $ta[0];
					echo"	<tr>
								<td>$ta1[0]</td>
								<td>$ta1[4]</td>
								<td>$ta1[1]</td>
								<td>$ta[0]</td>
								<td>$res</td>

							</tr>";
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

					 <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><!--Detail Reglement Client--><span style="color: white; font-weight: bold;"></span></h3>
                                          <!--div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                          </div-->
                                          <h3 class="panel-title"> Detail Reglement Entite<span style="color: white; font-weight: bold;"></span></h3>
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
							 
								<th> <center>Date reglement</center> </th>
								<th><center>Montant total</center></th>
								<th><center>Montant reglé</center></th>
								<th><center>Montant reste a regle</center></th>
								
							</tr> 
<?php
						$req1=$pdo->query("select Mont_fourni_cli_cmd,Date_regle_cmd,Mont_reste_cmd,Mont_reste_cmd_apres_reglement from regle_cmd where Id_cmd='".$_GET['detail_regle_cli']."' order by id_regle_cmd ");
						while($ta1=$req1->fetch())
						{
							echo "<tr>";

								echo "<td>$ta1[1]</td>";
								echo "<td>$ta1[2]</td>";
								echo "<td>$ta1[0]</td>";
								echo "<td>$ta1[3]</td>";
								
							echo "<tr>";
										
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
					   
			<?php
				}
		
		}else if (isset($_GET['detail_liv_cli']))
		{
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

		<center>
			
				<article>
				

				<?php

					if (isset($_SESSION['UserConnect']))
					{
					?>
					<!--a href="menu_principale.php">Menu principal</a><br-->

					<?php
					}else if (isset($_SESSION['UserConnectSimple']))
					{
					?>
					<!--a href="menu_principale.php">Menu principal</a><br-->

					<?php
					}

					?>
				
		
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><b>Livraison de la commande</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                <!--div class="bg tablescroll" style="height: 250%; height:250px;"!-->
                                                    <table class="table table-bordered table-striped"  >

                                                       
		
				<tr>
					<th><center>N commande<center></th>
					<th><center>Entite<center></th>
					<th><center>Date commande<center></th>
					<!--th><center>Montant commande<center></th>
					<th><center>Montant regle<center></th>
					<th><center>Montant reste a regle<center></th-->					
				</tr>

	<?php

				$req1=$pdo->query("select nom_cli,cmd.Mont_total_cmd,mont_regle,mont_reste_a_regler,enreg_le from client,cmd where cmd.Id_cli=client.Id_cli and cmd.Id_cmd='".$_GET['detail_liv_cli']."' ");
				while ($ta1=$req1->fetch()) 
				{
					$req=$pdo->query("select sum(Mont_fourni_cli_cmd) from regle_cmd where Id_cmd='".$_GET['detail_liv_cli']."' ");
					$ta=$req->fetch();

					$res = $ta1[1] - $ta[0];
					echo"	<tr>
								<td>$_GET[detail_liv_cli]</td>
								<td>$ta1[0]</td>
								<td>$ta1[4]</td>
								 

							</tr>";
						?>
            </table>
                                                <!--/div-->
                                        </table>
                           
                              </div>
                            
                           </div>
                        </div>
                      </div>
                      <!-- Fin tableau -->
					
<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><b>Detail de la livraison</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%; height: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                         <div class="bg tablescroll" style="height: 400%; height:400px;">
                                                    <table class="table table-bordered table-striped"  >

                                                       
			  <tr>
				  
								<!--th><center>Categorie<center/></th-->
								<th><center>Produit<center/></th>
								<th><center>Prix Unitaire<center/></th>
								<th><center>Quantite commandee<center/></th>
								<th><center>Quantite livree<center/></th>
								<th><center>Date livraison<center/></th>
								<th><center>Etat<center/></th>
								
							</tr>
<?php
						$req1=$pdo->query("SELECT categ,nom_prod,prix_unit,quant_cmd_liv,date_liv_cmd,quant_cmd,detail_liv_cmd.etat

											FROM cat,prod,stock_prod,detail_cmd,detail_liv_cmd,liv_cmd

											WHERE cat.id_cat=prod.id_cat and prod.id_prod=stock_prod.id_prod and 

													stock_prod.id_stock_prod=detail_cmd.id_stock_prod and
																			        
													detail_liv_cmd.Id_detail_cmd=detail_cmd.Id_detail_cmd and
											        
											        detail_liv_cmd.Id_liv_cmd=liv_cmd.Id_liv_cmd and 

											        Id_cmd='".$_GET['detail_liv_cli']."' order by nom_prod,id_detail_liv_cmd ");

						while($ta1=$req1->fetch())
						{
							echo "<tr>";

								//echo "<td>$ta1[0]</td>";
								echo "<td>$ta1[1]</td>";
								echo "<td>$ta1[2]</td>";
								echo "<td>$ta1[5]</td>";
								echo "<td>$ta1[3]</td>";
								echo "<td>$ta1[4]</td>";
								$etat="confirmer";
								if ($ta1[6]==0) {
									$etat="Non confirmer";
								}
								echo "<td><b> $etat </b></td>";
								
							echo "<tr>";
										
						}

					?>
					
						            </table>
                                                </div>
                                        </table>
                           
                             
                            
                           </div>
                        </div>
                      </div>
                      <!-- Fin tableau -->
							
<?php
				}
		
		}else if (isset($_GET['detail_liv_four']))
		{
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

		
			

			
		

			<?php

					if (isset($_SESSION['UserConnect']))
					{
					?>
					

					<?php
					}else if (isset($_SESSION['UserConnectSimple']))
					{
					?>
					

					<?php
					}

					?>
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			<div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Livraison Fournisseur<span style="color: white; font-weight: bold;"></span></h3>
                                          <!--div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                          </div-->
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 
                                             </table>
                                              <div class="bg tablescroll" style="height:98px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
 					<td> <b>Fournisseur <b/></td>
					<td> <b>Date approv. </b></td>
					<td> <b>Montant approv. </b></td>
					<td> <b>Montant regle </b></td>
					<td> <b>Montant reste a regle </b></td>					
				</tr>

	<?php

		$req1=$pdo->query("select nom_four,date_approv,mont_four,mont_regle from four,approv where four.id_four=approv.id_four and approv.id_approv='".$_GET['detail_liv_four']."'");

		while ($ta1=$req1->fetch()) 
		{
			$req=$pdo->query("select sum(Mont_remis_four) from regle_four where id_approv='".$_GET['detail_liv_four']."' ");
			$ta=$req->fetch();

			$res = $ta1[2] - $ta[0];
			echo"
					<tr>
						<td>$ta1[0]</td>
						<td>$ta1[1]</td>
						<td>$ta1[2]</td>
						<td>$ta[0]</td>
						<td>$res</td>					
					</tr>

				
			  </table>
                                                </div>
                                        </table>
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->" ;
				echo "</article><footer>";
?>



<div class="row" style="margin-right: 10%; margin-left: 10%; ">
				  <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Detail Approvisionnement<span style="color: white; font-weight: bold;"></span></h3>
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
                         <div class="bg tablescroll" style="height: 500%; height:500px;">
                                                    <table class="table table-bordered table-striped"  >

                                  

							<tr>
								<th><b><center>Categorie</center></b></th>
								<th><b><center>Produit</center></b></th>
								<th><b><center>Prix achat</center></b></th>
								<!--th><b><center>Prix vente</center></b></th!-->
								<th><b><center>Date expiration</center></b></th>
								<th><b><center>Quantite commandee</center></b></th>
								<th><b><center>Quantite livree</center></b></th>
								<th><b><center>Date livraison</center></b></th>
								
							</tr> 
<?php
			$req=$pdo->query("SELECT categ,nom_prod,prix_achat_prod,prix_vente_prod,date_exp,quant_prod_liv_four,date_liv_four,quant_demande

								FROM cat,prod,stock_prod,detail_liv_four,liv_four

								WHERE cat.id_cat=prod.id_cat and prod.id_prod=stock_prod.id_prod and 

										stock_prod.id_stock_prod=detail_liv_four.id_stock_prod and
								        
								        detail_liv_four.Id_liv_four=liv_four.Id_liv_four and stock_prod.id_approv='".$_GET['detail_liv_four']."' order by date_liv_four,nom_prod");

			while ($ta=$req->fetch()) 
			{

				echo "<tr>";
				echo "<td>$ta[0]</td>";
				echo "<td>$ta[1]</td>";
				echo "<td>$ta[2]</td>";
				//echo "<td>$ta[3]</td>";
				echo "<td>$ta[4]</td>";
				echo "<td>$ta[7]</td>";
				echo "<td>$ta[5]</td>";
				echo "<td>$ta[6]</td>";
				echo "<tr>";
																
			}

			echo " 

			  </table>
                                                </div>
                                        </table>
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     
                          
                      
                 </div><!-- /.row -->";


		}

		
		}else if (isset($_GET['detail_regle_four']))
		{
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

		
                                                  
			

		<!--h1>Detail Reglement Fournisseur</h1-->

			<!--a href=consultation_reglement_four.php>Retour</a-->
			
			  <!-- Debut tableau --> 

			     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Reglement Fournisseur<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style=" height:98px;">
                                                    <table class="table table-bordered table-striped"  >

                                                     

				<tr>
					<th> <center> Fournisseur</center></th>
					<th><center>Date approv.</center></th>
					<th><center>Montant approv.</center></th>
					<th><center>Montant regle </center> </th>
					<th><center>Montant reste a regle </center> </th>					
				</tr>

	<?php

		$req1=$pdo->query("select nom_four,date_approv,mont_four,mont_regle from four,approv where four.id_four=approv.id_four and approv.id_approv='".$_GET['detail_regle_four']."'");

		while ($ta1=$req1->fetch()) 
		{
			$req=$pdo->query("select sum(Mont_remis_four) from regle_four where id_approv='".$_GET['detail_regle_four']."' ");
			$ta=$req->fetch();

			$res = $ta1[2] - $ta[0];
			echo"
					<tr>
						<td>$ta1[0]</td>
						<td>$ta1[1]</td>
						<td>$ta1[2]</td>
						<td>$ta[0]</td>
						<td>$res</td>					
					</tr>
				";
				?>
				     </table>
                                                </div>
                                        </table>
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                  </div><!-- /.row -->
                 
				

				 
				  <!-- Debut tableau --> 
     <div class="row" style="margin-right: 10%; margin-left: 10%; ">
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Detail Reglement Fournisseur<span style="color: white; font-weight: bold;"></span></h3>
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
								<th><center>Date reglement</center></th>
								<th><center>Montant total</center></th>
								<th><center>Montant reglé</center></th>
								<th><center>Montant reste a regle</center></th>
								
							</tr> 
		<?php
			$req=$pdo->query("select date_regle_four,Mont_total_reste_four,Mont_remis_four,Mont_reste_regle_four_apres_regle_four from regle_four where id_approv='".$_GET['detail_regle_four']."' order by id_regle_four ");
			while ($ta=$req->fetch()) 
			{

				echo "<tr>";
				echo "<td>$ta[0]</td>";
				echo "<td>$ta[1]</td>";
				echo "<td>$ta[2]</td>";
				echo "<td>$ta[3]</td>";
				echo "<tr>";
																
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



<?php

		}

		
		}else
		{
			header("location:menu_principale.php");
		}
	}else
	{
		header("location:deconnexion.php");
	}
		
		
	?>
</body>