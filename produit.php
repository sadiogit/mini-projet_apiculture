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
                       

                <div class="col-lg-4 text-center">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              


                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title"> Nouveau Produit<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
					               <div class="panel-body" style="height: 540%; height:540px;" >


								<form action="enregistrement_client_fournisseur_categorie_produit.php" method="GET">
			  

								
					        	<div class="form-group">

					              <select class="form-control" name="cat" id="sel1">
							
									<option> <label for="sel1">Select Categorie</label></option> 
									<?php
										
											$sql="select id_cat,categ from cat";
												 $req=$pdo->query($sql);

												while ($tableau=$req->fetch())
																	 {
												echo "<option value=\"$tableau[0]\" > $tableau[1] </option>";
											}
									?></select>
								</div> 
									
					 <div class="form-group">
				                   <input type="text" placeholder="produit" name="produit" required class="form-control"/>
				                </div>


					 
							   <div class="form-group">
			                     <textarea type="text" placeholder="Entre la description du Produit" required name="desc_prod" size="50%" cols="51" rows="5" class="form-control"/></textarea>
			                   </div>	

								             <div class="form-group"> 
								<button type="submit" style="width: 100%;" class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true"> Valider</span></button>

								             </div>
    							 </form>
                                  </div>
                             
                              </div>
                         </div>            
                       <!--/div>
                    </div-->
                      <!-- Fin formulaire --> 
  
                             

			
	 

		<div class="col-lg-8 text-center">
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
                                              <div class="bg tablescroll" style="height: 540%; height:540px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
                                                    <td> <b>Categorie</b> </td>
                                                    <td> <b>Produit</b> </td>
													<td> <b>Description</b> </td>
                                                    	<td> <b>Modifier</b> </td>

													</tr>

 

				<tr>
					<?php

						$sql="select * from prod,cat where cat.id_cat=prod.id_cat order by Nom_prod";
									 $req=$pdo->query($sql);

									while ($tableau=$req->fetch())
														 {
						
					?>
							<tr>
							<td><?php echo $tableau[5]; ?></td>
							<td><?php echo $tableau[1]; ?></td>
							
							<td><?php echo $tableau[3]; ?></td>
								
							<td><a href="modifier_prod.php?codeprod=<?php echo $tableau[0]; ?> " >

						<button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a></td>

										
						
								
							</tr>

					<?php
					
						}
					?>

			</table>
 
	 
        <!--/div>

        </div-->

        </div>
</body>