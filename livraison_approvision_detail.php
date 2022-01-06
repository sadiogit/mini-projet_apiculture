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
		//require_once'menu_principale.php';
	?>



<div class="row" style="margin-right: 10%; margin-left: 10%; ">
		 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Livraison approvisionnement<span style="color: white; font-weight: bold;"></span></h3>
                                          <!--div class="pull-right">
                                            <button type="button" class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                          </div-->
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <!--tr class="filters">
                                                      

                                                      
                                                      <th rowspan="">
                                                        <input type="text" class="form-control" placeholder="Recherche par pseudo" disabled>
                                                      </th>


                                                  </tr-->
                                             </table>
                                              <div class="bg tablescroll" style="height: 200%; height:200px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>
											<td><center><b>     Produit    <b/></center></td> 
											<td><center><b>Prix Unitaire<b/></center></td> 
											<td><center><b>Quantite demandee<b/></center></td>	
											<td ><center><b>Quantite livree<b/></center></td> 
											<td><center><b>Quantite reste a livree<b/></center></td>  
											<td><center><b>Approvisionnement<b/></center></td>					
											<td><center><b>Action<b/></center></td>					
				</tr>
		<?php

			//echo $_SESSION['t'];
			if((isset($_GET['num']))||(isset($_SESSION['t'])))
			{

				if((isset($_SESSION['t'])))
				{
					$_GET['num']=$_SESSION['t'];

				}else
				{
					$_SESSION['t']=$_GET['num'];
				}
				
				$sql="select nom_prod,quant_demande,quant_approv,stock_prod.id_stock_prod,stock_prod.quant_prod_stock,prix_achat_prod,approv.id_approv from prod,stock_prod,approv where prod.id_prod = stock_prod.id_prod and stock_prod.id_approv = approv.id_approv and approv.id_approv='".$_GET['num']."' ";
				$req=$pdo->query($sql);

				while ($tableau=$req->fetch()) 
				{
					$sql1="select sum(Mont_remis_four) from regle_four where id_approv=".$_GET['num']." ";
					$req1=$pdo->query($sql1);
					$tab=$req1->fetch();

					//if($tab[0]<$tableau['Mont_four'])
					//{
						echo "
							<tr>
								<td><center>$tableau[0]</center></td> 
						 ";

						 echo "
							
							<td><center>$tableau[5]</center></td> 
						 ";
						 
						 echo "

						 		<td><center>$tableau[1]</center></td>
						 ";
						 
						 echo " 

						 		<td><center>$tableau[2]</center></td>									
								
						 ";

						 $rr = $tableau[1] - $tableau[2];

						 echo " 

						 		<td><center>$rr</center></td>									
							
						 ";
						 ?>

						<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

						<?php
						 echo " 
						 		<input type=hidden name=num_stock value=$tableau[3]>
						 		<input type=hidden name=num_ value=$tableau[6]>
						 		 ";

						 if ($rr==0)
						 {
						 	echo "<td><center><input type=number name=liv1 min=1 max=$rr disabled=disabled></td>

						 			<td><input type=submit value=\"S'approvisionner\" disabled=disabled> </td>";

						 }else
						 {
						 	 ?>
					
		<div class="col-lg-1 ">
           <div class="form-group">
             
		 	<td><input type="number"  name="liv1" min=1 max=<?php echo $rr ?> class="form-control" required >
           
           </div>
        </div>


              <div class="col-lg-1 ">
                             	<td>     <button type="submit"  class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true">AJOUTER</span></button>	</td>

              </div>

<?php

						 }
						 

						 echo "
						 			
						 </form>								
								
							</tr>
						 ";
					//}
					

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

		
				<div class="row" style="margin-right: 10%; margin-left: 10%; ">
				      <!-- Debut tableau --> 
                    <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title">Pre-Selection<span style="color: white; font-weight: bold;"></span></h3>
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
                                              <div class="bg tablescroll" style="height: 250%; height:250px;">
                                                    <table class="table table-bordered table-striped"  >

                                                    	<tr>

                  <tr>
					<td> <center><b>N° </b></center></td> 
					<th><center>Produit</center></th> 
					<th><center>Quantite commandee</center></th> 
					<th><center>Quantite Livree</center></th>
					<th><center>Quantite Totale livree</center></th>
					<th><center>Quantite reste a livree</center></th>	
					
				</tr>
		<?php

			if(isset($_GET['num_stock']))
			{
				?>

				<form action="valid.php" method="GET">

				<?php

					$_SESSION['num_stock']=$_SESSION['num_stock']."//".$_GET['num_stock'];
					$_SESSION['liv1']=$_SESSION['liv1']."//".$_GET['liv1'];
					$gg =$_GET['num_'];
					$_SESSION['gg'] = $_GET['num_'];

					echo "<input type=hidden name=num_approv value=$gg>";
					$tableau_produit=explode("//", $_SESSION['num_stock']);
					$tableau_liv=explode("//", $_SESSION['liv1']);
					
					echo "<input type=hidden name=verif1>";
				
					
					for ($i=1; $i <count($tableau_produit) ; $i++) {

						$req= $pdo->query("select nom_prod,quant_demande,quant_approv from prod,stock_prod where prod.id_prod=stock_prod.id_prod and id_stock_prod='".$tableau_produit[$i]."'");
						$rep = $req->fetch();
						
						

					echo "
							<tr>
								<td><center>$i</center></td> 
						 ";

						 echo "
							
								<td><center>$rep[0]</center></td> 
						 ";
						 

						 echo "

						 		<td><center>$rep[1]</center></td>
						 ";

						 echo "

						 		<td><center>$tableau_liv[$i]</center></td>
						 ";

						 $h = $rep[2]+$tableau_liv[$i];
						 echo "

						 		<td><center>$h</center></td>
						 ";
						 $r = $rep[1] - $h;
						 echo " 

						 		<td><center>$r</center></td>									
								
						 ";
						 
						 
						  
					}

					echo "</tr>";

							
				}

						

		?>
				
         </table>
                                                </div>
                                       
                           
                              </div>
                           
                           <!--/div>
                        </div-->
                      </div>
                        <!-- Fin tableau --> 

                     <div class="col-lg-2  col-lg-offset-11 ">
	        <a href="annule.php?annule=1" title="Vider la pré-selection">

		<button type="button"  class="btn btn-danger ">ANNULER</button>
			</a>
	</div>
                          
                      
                 </div><!-- /.row -->
			


			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

                <div class="col-lg-12 text-left">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Terminer l'approvisonement<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body"  >


				 <div class="col-lg-4 ">
                         <div class="form-group">
                            <input type="date"  name="date_approv" required class="form-control"/>

                         </div>
                    </div>
 
 <div class="col-lg-2 ">
                      <input type="submit" class="btn btn-primary ">
 </div>

     
				
			
			</form>
		 </div>
                             
                              </div>
                         <!--/div>            
                       </div-->
                    </div>
                      <!-- Fin formulaire --> 

</body>