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
				
  ?>

		<div class="row" style="margin-right: 10%; margin-left: 10%; ">		
				    <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Liste des Produits<span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
               

                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height: 250%; height:250px;">
                                                    <table class="table table-bordered table-striped"  >

				
				<tr>
					 
					 <th style="width: 20%; text-align: center;">
                                                        PRODUIT
                                                      </th>
					<th style="width: 15%; text-align: center;"><b>Prix-A<b></th>
					<td><b>Quant-S<b></td>
					<th style="width: 20%; text-align: center;"><b>Date-E<b></th>

					<th style="width: 15%; text-align: center;"><b>Quantite-C<b></th>
					<th style="width: 15%; text-align: center;"><b>Quantite-L<b></th>
          			<!--th style="width: 20%; text-align: center;"><b>Prix unitaire<b></th-->
					<td><b>Ajouter<b></td>

				</tr>

				<?php
				if (isset($_GET['catego']))
				{

							$req=$pdo->query("select Nom_prod,stock_prod.Prix_achat_prod,Quant_prod_stock,Date_exp,stock_prod.Id_prod,Id_stock_prod,stock_prod.Prix_vente_prod 

												from prod,stock_prod 

												where cat.Id_cat=prod.Id_cat and stock_prod.Id_prod=prod.Id_prod and Quant_prod_stock>0  order by prod.Nom_prod");
							while ($ta=$req->fetch()) 
							{
							?>

							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

							<?php
								echo "<tr>";
							 
								echo "<th style=\"width: 20%; text-align: center;\">$ta[0]</th>";
								echo "<th style=\"width: 15%; text-align: center;\">$ta[1]</th>";
								echo "<td>$ta[2]</td>";
								echo "<td>$ta[3]</td>";

								echo "<th style=\"width: 10%; text-align: center;\"><input type=\"number\" name=\"quantite\" class=\"form-control\" ></th>";
								echo "<td><input type=number name=quantite_liv required min=1 max=$ta[2]></td>";
								echo "<td><input type=text name=montant required value=$ta[6]></td>";

								echo "<input type=hidden name=produit value=$ta[5]>";

								echo "<td><input type=submit value=Ajout></td>";

								echo "</tr>";

								echo "</form>";
							}
				}else
				{

							$req=$pdo->query("select Nom_prod,stock_prod.Prix_achat_prod,Quant_prod_stock,Date_exp,stock_prod.Id_prod,Id_stock_prod,stock_prod.Prix_vente_prod,categ

												from prod,stock_prod,cat

												where cat.Id_cat=prod.Id_cat and stock_prod.Id_prod=prod.Id_prod and Quant_prod_stock>0 order by prod.Nom_prod");
							while ($ta=$req->fetch()) 
							{
							?>

							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

							<?php
								echo "<tr>";
							//	echo "<td>$ta[7]</td>";
								echo "<td>$ta[0]</td>";
								echo "<td>$ta[1]</td>";
								echo "<td>$ta[2]</td>";
								echo "<td>$ta[3]</td>";

								
								echo "<td><input type=\"number\" class=\"form-control\" name=\"quantite\" min=1 required></td>";
								echo "<td><input type=\"number\" class=\"form-control\"  max=$ta[2] name=\"quantite_liv\" min=1  required></td>";
								echo "<input type=hidden value=$ta[6] name=\"montant\" >";
								

								echo "<input type=hidden name=produit value=$ta[5]>";

								echo "<td><input type=submit class=\"btn btn-primary\"  value=Ajouter></td>";

								echo "</tr>";

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
          </div><!-- /.row -->

	<div class="row" style="margin-right: 10%; margin-left: 10%; ">
		    <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Liste des produits pre-selectionne<span style="color: white; font-weight: bold;"></span></h3>
          
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 
                                             </table>
                                              <div class="bg tablescroll" style="height: 180%; height:180px;">
                                                  <form action="confirme_vente.php" method="GET"> 
                                                    <table class="table table-bordered table-striped"  >

                                                      <tr>

					<th><center> <b>N° <b></center></th>
					<th><center> <b>Produit <b></center></th> 
					<th><center> <b>Quantite demandee <b></center></th> 
					<th><center> <b>Quantite en stock <b></center></th> 
					<th><center> <b>Quantite Livree <b></center></th> 
					<th><center> <b>Prix unitaire <b></center></th>	
					<th><center> <b>Total <b></center></th>
					
				</tr>
		<?php

			if((isset($_GET['produit']))&&(isset($_GET['quantite']))&&(isset($_GET['montant']))&&(isset($_GET['quantite_liv']))&&($_GET['quantite_liv']<=$_GET['quantite']))
			{
				$tableau_produit1=$_GET['produit'];
				//echo $tableau_produit1[1];
				$req=$pdo->query("select Quant_prod_stock,Nom_prod from stock_prod,prod where stock_prod.Id_prod=prod.Id_prod and `Id_stock_prod`='".$tableau_produit1."' and Quant_prod_stock >= '".$_GET['quantite_liv']."' ");
				while ($ta=$req->fetch())
				{
					if(!isset($_SESSION['stock']))
					{
						$_SESSION['stock']="@@".$ta[0];						
						$_SESSION['produit']="@@".$ta[1];

						$_SESSION['produit1']="@@".$_GET['produit'];

						$_SESSION['quantite']="//".$_GET['quantite'];
						$_SESSION['montant']="//".$_GET['montant'];
						$_SESSION['quantite_liv']="//".$_GET['quantite_liv'];

						$tableau_stock=explode("@@", $_SESSION['stock']);

						$tableau_produit=explode("@@", $_SESSION['produit']);
						$tableau_quantite=explode("//", $_SESSION['quantite']);
						$tableau_prix_unit=explode("//", $_SESSION['montant']);	
						$tableau_quantite_liv=explode("//", $_SESSION['quantite_liv']);	
						
					}else
					{
						$_SESSION['stock']=$_SESSION['stock']."@@".$ta[0];						
						$_SESSION['produit']=$_SESSION['produit']."@@".$ta[1];

						$_SESSION['produit1']=$_SESSION['produit1']."@@".$_GET['produit'];

						$_SESSION['quantite']=$_SESSION['quantite']."//".$_GET['quantite'];
						$_SESSION['montant']=$_SESSION['montant']."//".$_GET['montant'];
						$_SESSION['quantite_liv']=$_SESSION['quantite_liv']."//".$_GET['quantite_liv'];

						$tableau_stock=explode("@@", $_SESSION['stock']);

						$tableau_produit=explode("@@", $_SESSION['produit']);
						$tableau_quantite=explode("//", $_SESSION['quantite']);
						$tableau_prix_unit=explode("//", $_SESSION['montant']);	
						$tableau_quantite_liv=explode("//", $_SESSION['quantite_liv']);
					}

										
					


					
					echo "<input type=hidden name=verif>";

					$tt =0;
					for ($i=1; $i <count($tableau_quantite) ; $i++) {

						
					echo "
							<tr>
								<td><center>$i</center></td> 
						 ";

					echo "
							<td><center>$tableau_produit[$i]</center></td> 
						 ";
						 
						 echo "

						 		<td><center>$tableau_quantite[$i]</center></td>
						 ";
						 
						 echo "

						 		<td><center>$tableau_stock[$i]</center></td>
						 ";

						  echo "

						 		<td><center>$tableau_quantite_liv[$i]</center></td>
						 ";
						 
						 echo " 

						 		<td><center>$tableau_prix_unit[$i]</center></td>									
								
						 ";
						 $tt = $tt+($tableau_prix_unit[$i]*$tableau_quantite_liv[$i]);
						  echo " 

						 		<td><center>".$tableau_prix_unit[$i]*$tableau_quantite_liv[$i]."</center></td>									
								
						 ";
						 
						 echo "<input type=hidden name=verif></tr>";

						  
					}

					echo "<tr>
							<td colspan=6><center>Somme totale</center></td>
							<td><center>$tt</center></td></tr>";



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

	
	 <div class="col-lg-12 text-center">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Terminer la commande<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body" >
                                       <div class="col-lg-3 ">

                                  <div class="form-group">
                                      <select class="form-control" name="client">
                                  
                              						<option>Client</option> 
                              						<?php
                              								$req=$pdo->query("select Nom_cli,Contact_cli,Adr_cli,id_cli from client order by Nom_cli");
                              								while ($ta=$req->fetch())
                              								{
                              									echo "<option value=\"$ta[3]\" >$ta[0] | $ta[1] | $ta[2]</option>";
                              								}
                              								
                              							?>                           </select>                                
                                     


                                  </div>
                            </div>
                            <div class="col-lg-3 ">
                                  <div class="form-group">
                                    <input type="date" class="form-control" name="date_vente" required> 
                                  </div>
                            </div>

                            <div class="col-lg-3 ">
                                  <div class="form-group">
                                    <input type=hidden class="form-control" value="" placeholder="versement" name="versement" required>  
                                  </div>
                            </div>

                                    					 
                                    					 <div class="col-lg-1 ">
                                  <button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true">ENREGISTRER</span></button>

                           </div>

             <div class="col-lg-2">
                             <a href="annule.php? recu_vente=2 " title="Vider la pré-selection">

                  <button type="button"  class="btn btn-danger ">ANNULER</button>
                </a>
              </div>
                						</form>
                          						
                          				
                                 </div>
                             
                              </div>
                         <!--/div>            
                       </div-->
                    </div>
                      <!-- Fin formulaire -->
  
 
</body>