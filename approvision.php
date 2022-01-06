<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Accueil</title>
	<link rel="stylesheet" href="css3.css" type="text/css">
	
</head>
<body>

	<script type="text/javascript">
  	
  		function cmbo()
  		 {
  		 	
  		 	var cd = document.getElementById('combo').value.split('/');
  		 	document.getElementById('code_prod1').value= cd[0];
  		 	document.getElementById('produit1').value = cd[1];
  		 	

  		 }

  </script>


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
	?>
	<div class="row" style="margin-right: 10%; margin-left: 10%; ">
	 <!-- debut forme entete -->
                <div class="col-lg-12 text-center">
                  <div class="panel panel-default">

                  <form action="t.php" method="GET">

                    <div class="panel-body">
                      
                            <div class="col-lg-3 ">

                                  <div class="form-group">
                                      <select class="form-control" id="combo" onclick="cmbo()">
                                          <option>Selectionner un produit</option>

                                          <?php

                                          	$req=$pdo->query("select Nom_prod,Id_prod from prod,cat where cat.id_cat=prod.id_cat order by Nom_prod");

											while ($ta=$req->fetch()) 
											{
												echo "<option value=\"$ta[1]/$ta[0]\"> $ta[0] </option>";
												
											}

											echo "<input type=\"hidden\" name=\"code_prod\" id=\"code_prod1\" value=$ta[1]>";
												echo "<input type=\"hidden\" name=\"produit\" id=\"produit1\" value=$ta[0]>";

                                          ?>

                                      </select>                                
                                     
                                  </div>
                            </div>      
                              
                            <div class="col-lg-2 ">
                                  <div class="form-group">
                                      <!--label class="control-label">Login:</label-->
                                      <input type="number" placeholder="Quantite commande" name="quantite_liv" onclick="cmbo()" required  min=1  class="form-control"/>
                                     
                                  </div>
                            </div>

                            <div class="col-lg-2 ">
                                  <div class="form-group">
                                      <!--label class="control-label">Login:</label-->
                                      <input type="number" placeholder="Quantite Livree" name="quantite" onclick="cmbo()" required min=1 class="form-control"/>
                                     
                                  </div>
                            </div>
                            <div class="col-lg-2 ">
                                  <div class="form-group">
                                      <input type="text" placeholder="Prix d'achat/Unite" onclick="cmbo()" name="prix_achat" required class="form-control"/>

                                  </div>
                            </div>

                            <!--div class="col-lg-2 ">
                                  <div class="form-group">
                                      <input type="text" placeholder="Prix de vente/Unite" onclick="cmbo()" name="prix_vente" required class="form-control"/>

                                  </div>
                            </div-->

                            <div class="col-lg-2 ">
                                  <div class="form-group">
                                      <input type="date" name="date_exp" onclick="cmbo()" required class="form-control"/>

                                  </div>
                            </div>

                            <div class="col-lg-1 ">
                                  <button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true">AJOUTER</span></button>

                                  </div>
                            </div>

                            
                        </form>
                          
                     </div>
                   </div> 

                   <!-- fin forme entete -->
                   <form action="confirme_approvision.php" method="GET">
                    <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Liste des produits selectionner<span style="color: white; font-weight: bold;"></span></h3>
                                          
                                        </div>
                                       <table class="span12">
                                            <table style="width: 100%">
                                                 <tr class="filters">
                                                      <th style="width: 4%; text-align: center;">
                                                        N°
                                                      </th>
                                                      <th style="width: 31%; text-align: center;">
                                                        PRODUIT
                                                      </th>
                                                         <th style="width: 10%; text-align: center;">
                                                        Q-C
                                                       </th>
                                                       <th style="width: 10%; text-align: center;">
                                                        Q-L
                                                       </th>
                                                       <th style="width: 15%; text-align: center;">
                                                        PRIX D'ACHAT
                                                       </th>
                                                       <th style="width: 15%; text-align: center;">
                                                        PRIX DE VENTE
                                                       </th>
                                                       <th style="width: 15%; text-align: center;">
                                                        TOTAL
                                                       </th>
                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height: 300%; height:300px;">
                                                    <table class="table table-bordered table-striped"  >



				<?php

					if(((isset($_GET['produit']))&&(!empty($_GET['produit']))&&(!empty($_GET['quantite_liv']))&&(!empty($_GET['quantite']))&&($_GET['quantite']<=$_GET['quantite_liv'])) or isset($_SESSION['quantite_liv']))
					{

							
							
							$tableau_produit=explode("//", $_SESSION['produit']);
							$tableau_quantite=explode("//", $_SESSION['quantite']);
							$tableau_prix_achat=explode("//", $_SESSION['prix_achat']);
							$tableau_prix_vente=explode("//", $_SESSION['prix_achat']);

							$tableau_date_exp=explode("//", $_SESSION['date_exp']);

							$tableau_quantite_liv=explode("//", $_SESSION['quantite_liv']);
							

							$totall =0;
							for ($i=1; $i <count($tableau_quantite) ; $i++) 
							{

								
								echo "<input type=hidden name=verif1>";

							echo "
									<tr class=\"filters\">
										
										<th style=\"width: 4%; text-align: center;\">
                                                $i
                                        </th>
								 ";

								 echo "
										
										<th style=\"width: 31%; text-align: center;\">
                                                        $tableau_produit[$i]
                                        </th>
								 ";
								 

								 echo "

								 		<th style=\"width: 10%; text-align: center;\">
                                                        $tableau_quantite_liv[$i]
                                        </th>
								 ";

								 echo "

								 		<th style=\"width: 10%; text-align: center;\">
                                                        $tableau_quantite[$i]
                                        </th>
								 ";

								 echo " 

								 		<th style=\"width: 15%; text-align: center;\">
                                                        $tableau_prix_achat[$i]
                                        </th>							
										
								 ";
								 
								 echo " 

								 		<th style=\"width: 15%; text-align: center;\">
                                                        
                                                        $tableau_prix_vente[$i]
                                        </th>									
										
								 ";


								 echo " 

								 		<th style=\"width: 15%; text-align: center;\">".$tableau_prix_achat[$i]*$tableau_quantite[$i]."</th>									
										
								 ";
								 $totall = $totall + ($tableau_prix_achat[$i]*$tableau_quantite[$i]);

								 
								  
							}

							echo "</tr>";
							echo "<tr>";
							echo "<th colspan=6><center>Somme totale</center></th>";
							echo "<th><center>$totall</center></th>";
							echo "</tr>";

							unset($_GET['produit']) ;

									
						}

								

				?>

                                          
                                                  



                                               
                                                    </table>
                                                </div>
                                        </table>
                           
                              </div>
                           <div class="col-lg-1 col-lg-offset-11">
	                           <a href="annule.php? recu_approv=1 " title="Vider la pré-selection">

									<button type="button"  class="btn btn-danger ">ANNULER</button>
								</a>
							</div>

                           </div>
                        </div>
                      </div>
                      <!-- Fin tableau --> 

                      <!-- debut forme entete -->
                <div class="col-lg-12 text-center">
                  <div class="panel panel-default">

                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

                    <div class="panel-body">
                      
                            <div class="col-lg-5 ">

                                  <div class="form-group">
                                     <select name="four" class="form-control" >
										<option>Fournisseur</option> 
										<?php
												$req=$pdo->query("select Nom_four,Contact_four,Adr_four,Categorie_four,Id_four from four order by Id_four");
												
												while ($ta=$req->fetch())
												{
													echo "<option value=\"$ta[4]\" > $ta[0] | $ta[1] | $ta[2] </option>";
													
												}
												
										?>
									</select>                           
                                     
                                  </div>
                            </div>      
                             


                            <div class="input-group col-lg-4 ">
                            	<input type="number" name="versement" min=1  required class="form-control"/>
                                  <span class="input-group-addon">                                      
                                  GNF
                                  </span>
                            </div>

                            

                            <div class="col-lg-2 ">
                                  <div class="form-group">
                                      <input type="date" name="date_approv"  required class="form-control"/>

                                  </div>
                            </div>

                            <div class="col-lg-1 ">
                                  <button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true">VALIDER</span></button>

                                  </div>
                            </div>

                            
                        </form>
                          
                     </div>
                   </div> 

                   <!-- fin forme entete --> 
                   </form>         
                 </div>
                


	
	

	

</body>