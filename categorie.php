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
                                <h3 class="panel-title">Nouvelle categorie<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body" style="height: 540%; height:540px;" >


			<form action="enregistrement_client_fournisseur_categorie_produit.php" method="GET">

				<table>

					<div class="form-group">
                        <input type="text" placeholder="Categorie" name="categ" required class="form-control" />
         </div>
					 <div>
					 <button type="submit" style="width: 100%;" class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true"> ENREGISTRER</span></button>

          </div>

				</table>

			</form>

<br><br><br><br><br>
                                  </div>
                             
                              </div>
                         <!--/div>            
                       </div-->
                    </div>
                      <!-- Fin formulaire -->


		

                         <!-- Debut tableau --> 
                    <div class="col-lg-8 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Liste des categories<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style="height: 545%; height:545px;">
                                                    <table  class="table table-bordered table-striped"  >

                                                    	<tr>

                                                    		
                                                    		<td> <b>Categorie</b> </td>


                                                    		<td> <b>Modifier</b> </td>

                                                    		
                                                    		


                                                    	</tr>
                                                        <!--tr>
                                                            
                                                            <td >BYU-I</td>
                                                            <td >542584612548</td>
                                                            <td >BYU-I</td>
                                                            <td >542584612548</td>

                                                            <td >
                                                            </td>


                                                        </tr-->

                                                        <?php


															$sql="select * from cat  order by categ";
															$req=$pdo->query($sql);

															while ($tableau=$req->fetch())
															{
															
														?>

                                                        <tr>
															<td><?php echo $tableau[1]; ?></td>
														
															
					
						<td> 
						
						<a href="modifier_categorie.php?codecat=<?php echo $tableau[0]; ?> " >

						<button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>

						</td>
					</tr>

					<?php
			
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