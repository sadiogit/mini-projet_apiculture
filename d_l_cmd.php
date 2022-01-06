<?php
if (isset($_GET['detail_liv_cli']))
		{
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

		<center>
			
				<article>
				

				
		
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><b>Detail de la livraison</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                <!--div class="bg tablescroll" style="height: 250%; height:250px;"!-->
                                                    <table class="table table-bordered table-striped"  >

                                                       
		
				<tr>
					<th><center>Client<center></th>
					<th><center>Date commande<center></th>
					<th><center>Montant commande<center></th>
					<th><center>Montant regle<center></th>
					<th><center>Montant reste a regle<center></th>					
				</tr>

	<?php

				$detail = $_GET['detail_liv_cli'];
				$req1=$pdo->query("select nom_cli,cmd.Mont_total_cmd,mont_regle,mont_reste_a_regler,enreg_le from client,cmd where cmd.Id_cli=client.Id_cli and cmd.Id_cmd='".$_GET['detail_liv_cli']."' ");
				while ($ta1=$req1->fetch()) 
				{
					$req=$pdo->query("select sum(Mont_fourni_cli_cmd) from regle_cmd where Id_cmd='".$_GET['detail_liv_cli']."' ");
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
                                          <h3 class="panel-title"><b>Detail</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%; height: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                         <div class="bg tablescroll" style="height: 400%; height:400px;">
                                                    <table class="table table-bordered table-striped"  >

                                                       
			  <tr>
				  
								<th><center>Categorie<center/></th>
								<th><center>Produit<center/></th>
								<th><center>Prix Unitaire<center/></th>
								<th><center>Quantite commandee<center/></th>
								<th><center>Quantite livree<center/></th>
								<th><center>Date livraison<center/></th>
								<?php
								if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectConfirme'])) )
								{
								?>
									<th><center>Confirmer</center></th>
								<?php

								}else
								{
								?>
										<th><center>Etat</center></th>
								<?php
								}
								?>

								
								
							</tr>

	<?php	

						$req1=$pdo->query("SELECT categ,nom_prod,prix_unit,quant_cmd_liv,date_liv_cmd,quant_cmd,etat,id_detail_liv_cmd

											FROM cat,prod,stock_prod,detail_cmd,detail_liv_cmd,liv_cmd

											WHERE cat.id_cat=prod.id_cat and prod.id_prod=stock_prod.id_prod and 

													stock_prod.id_stock_prod=detail_cmd.id_stock_prod and
																			        
													detail_liv_cmd.Id_detail_cmd=detail_cmd.Id_detail_cmd and
											        
											        detail_liv_cmd.Id_liv_cmd=liv_cmd.Id_liv_cmd and 

											        Id_cmd='".$_GET['detail_liv_cli']."' order by nom_prod,id_detail_liv_cmd ");


						while($ta1=$req1->fetch())
						{
							echo "<tr>";

								echo "<td>$ta1[0]</td>";
								echo "<td>$ta1[1]</td>";
								echo "<td>$ta1[2]</td>";
								echo "<td>$ta1[5]</td>";
								echo "<td>$ta1[3]</td>";
								echo "<td>$ta1[4]</td>";

					 if($ta1[6]==1)
						 {

						 	if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectConfirme'])) )
							{
							?>
								<td><input type=submit value=Confirmer disabled=disabled></center></td>
							<?php

							}else
							{
							?>
									<td> <center><b>Confirmer</b></center> </td>
							<?php
							}
						 	
						 	//echo "<td><input type=submit value=Confirmer disabled=disabled></center></td>";

						 }else
						 {
						 	if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectConfirme'])) )
							{
							?>
								<td> 
						<?php $cmd=$_GET['detail_liv_cli'];   echo" <a href=\"confirmation_d_l_cmd.php? id_detail_liv_cli=$ta1[7]&& cmd1=$cmd&& detail=$detail\" title=\"Voir les detail de la commande\">"?>

									
									<button type="button"  class="btn btn-primary ">Confirmer  </button>
							 </a>
						 </td>
							<?php

							}else
							{

							?>
									<td> <center><b>Non confirmer</b></center> </td>
							<?php
							}
						 	?>

						 	
<?php

						 }
								
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

		
		}

