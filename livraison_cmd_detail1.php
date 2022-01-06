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
		if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectCmdApprov'])) )
			{
		        require_once("menu_principale_cmdApprov.php");

			}else
			{
				header("location:deconnexion.php");
			}

			
	        require_once("connexion.php");

		if ((isset($_SESSION['UserConnect']))||(isset($_SESSION['UserConnectSimple'])))
		{
		
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
			</center>
			

		<fieldset>
			 
			 


<div class="row" style="margin-right: 10%; margin-left: 10%; ">
			 <div class="col-lg-12 text-center">
                      <!--div class="panel panel-default">
                        <div class="panel-body"-->
                          

                              <div class="panel panel-primary filterable">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><b>Livraison Commande</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height: 200%; height:200px;">
                                                    <table class="table table-bordered table-striped"  >

                                                       
			 
				<tr>
					<th style="width: 25%; text-align: center;"><center>Produit</center></th> 
					<th><center>Prix Unitaire</center></th> 
					<th><center>Q-C</center></th>	
					<th><center>Q-L</center></th> 
					<th><center>Q reste a L</center></th>  
					<th><center>Q-A-L</center></th>  
					<th><center>Livrer</center></th>
					
				</tr>
		<?php

			if((isset($_GET['num']))||(isset($_SESSION['t1'])))
			{

				if((isset($_SESSION['t1'])))
				{
					$_GET['num']=$_SESSION['t1'];
					
				}else
				{
					$_SESSION['t1']=$_GET['num'];
				}

				 $sql="select nom_prod,quant_cmd,quant_livrer,Quant_reste_a_livrer,detail_cmd.id_detail_cmd,detail_cmd.prix_unit,stock_prod.id_stock_prod,detail_cmd.id_detail_cmd from prod,detail_cmd,cmd,stock_prod where cmd.id_cmd=detail_cmd.id_cmd and detail_cmd.id_stock_prod = stock_prod.id_stock_prod and prod.id_prod = stock_prod.id_prod and cmd.id_cmd=".$_GET['num']." ";
				$req=$pdo->query($sql);

				while ($tableau=$req->fetch())
				{
					 echo "
							<tr>
								<td th style=\"width: 20%; text-align: center;\"><center>$tableau[0]</center></td> 
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

						 

						 echo " 

						 		<td><center>$tableau[3]</center></td>									
							
						 ";

						 ?>

						<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">

						<?php
						
						 echo 	"
							 		<input type=hidden name=id_detail value=$tableau[7]>
							 		
							 		
						 		";

						 if($tableau[3]==0)
						 {
						 	echo "
						 			<td><center><input type=number  name=liv disabled=disabled >
									<input type=submit value=Livrer disabled=disabled></center></td>
						 		";
						 }else
						 {
						 	echo "
						 			<td><center><input type=number class=\"form-control\" name=liv min=1 max=$tableau[3] required></td>

						 			<td><input type=submit class=\"btn btn-primary\" value=Livrer></center></td>
						 		";
						 }

						 echo "
						 		</form>								
						 		</tr>
							
						 ";

				}

			?>
			
			            </table>
                                                </div>
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
                                          <h3 class="panel-title"><b>Liste des commandes non entierement livree</b><span style="color: white; font-weight: bold;"></span></h3>
                                           
                                        </div>
                                       <table class="span12">
                                            <table style=" width: 100%;">
                                                 <tr class="filters">
                                                      

                                                      


                                                  </tr>
                                             </table>
                                              <div class="bg tablescroll" style="height: 200%; height:200px;">
                                                    <table class="table table-bordered table-striped"  >

                                                       
			  <tr>
				  
					 
					<th><center>N°</center></th> 
					<th><center>Produit</center></th> 
					<th><center>Q-C</center></th> 
					<th><center>Q-L</center></th>
					<th><center>Q Totale L</center></th>
					<th><center>Q reste a L</center></th>	
					
				</tr>


		<?php

			if(isset($_GET['id_detail']))
			{
				$_SESSION['detail'] = $_SESSION['detail']."//".$_GET['id_detail'];
				$tableau_detail=explode("//", $_SESSION['detail']);

				$_SESSION['liv']=$_SESSION['liv']."//".$_GET['liv'];
				$tableau_liv=explode("//", $_SESSION['liv']);

				
		?>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">


		<?php

			for ($i=1; $i <count($tableau_detail) ; $i++)
			{ 
					$req= $pdo->query("select nom_prod,quant_cmd,quant_livrer from prod,stock_prod,detail_cmd where stock_prod.id_stock_prod=detail_cmd.id_stock_prod and prod.id_prod=stock_prod.id_prod and detail_cmd.id_detail_cmd='".$tableau_detail[$i]."'");
					$rep = $req->fetch();
					echo "
							<input type=hidden name=verif>
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
						 		</tr>									
								
						 ";
					
			}
		}

		?>

			            </table>
                                                </div>
                                        </table>
                           
                              </div>
                            
                           </div>
                        </div>
                      </div>
                      <!-- Fin tableau -->
		
		 
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
                            <input type="date"  name="date_liv" required class="form-control"/>

                         </div>
                    </div>
                    <div class="col-lg-4 ">
                         <div class="form-group">
                             <input type="submit"  value="Valider" class="btn btn-primary ">
                         </div>
                    </div>

                    <div class="col-lg-4 ">
                         <div class="form-group">
                            <a href="annule.php? cmd=1 " title="Vider la pré-selection">
									<button type="button"  class="btn btn-danger ">ANNULER</button>
							</a>
                         </div>
                    </div>

				  

				       
					

					<!--a href="annule.php? cmd=1 "><input type="button" value="Annuler"></a></td-->	

					
				</tr>
						
			</table>
		 
</div>
                             
                              </div>
                         <!--/div>            
                       </div-->
                    </div>
                      <!-- Fin formulaire -->
		</form>

		<?php

			if(isset($_GET['verif']))
			{
				$tableau_detail=explode("//", $_SESSION['detail']);
				
				$tableau_liv=explode("//", $_SESSION['liv']);

				for ($i=1; $i < count($tableau_detail); $i++)
				{ 

					$req0 = $pdo->query("select Quant_prod_stock,stock_prod.id_stock_prod,detail_cmd.id_cmd,detail_cmd.prix_unit,cmd.mont_total_cmd,cmd.mont_regle
					 						from stock_prod,detail_cmd,cmd where cmd.id_cmd=detail_cmd.id_cmd and stock_prod.id_stock_prod=detail_cmd.id_stock_prod and detail_cmd.id_detail_cmd='".$tableau_detail[$i]."' ");
					 $rrr = $req0->fetch();

					 $g = $rrr[0]-$tableau_liv[$i];
					//if($g>=0)
				//	{
						//$req1 = $pdo->query("UPDATE `stock_prod` SET `Quant_prod_stock`='".$g."' WHERE id_stock_prod='".$rrr[1]."' ");

						$prix = $tableau_liv[$i]*$rrr[3];
						$totale = $prix+$rrr[4];
						$rest = $totale-$rrr[5];

						$e = $pdo->query("select current_date from dual");
						
						$re = $e->fetch();

						$ee =  $pdo->query("select id_regle_cmd,Mont_reste_cmd,Mont_fourni_cli_cmd from regle_cmd where id_cmd='".$rrr[2]."' order by id_regle_cmd desc");
						while($ree = $ee->fetch())
						{
							$totale = $prix + $ree[1];

							$reste = $totale - $ree[2];

							$modif =$pdo->query("UPDATE `regle_cmd` SET `Mont_reste_cmd`='".$totale."',`Mont_reste_cmd_apres_reglement`='".$reste."',`enreg_le`='".$re[0]."' WHERE id_regle_cmd='".$ree[0]."'");

							break;

						}

						$req1 = $pdo->query("UPDATE `cmd` SET enreg_le='".$re[0]."', `etat_cmd`=0,  `mont_total_cmd`='".$totale."',Mont_reste_a_regler='".$rest."' WHERE id_cmd='".$rrr[2]."' ");
						$useCon;
						if (isset($_SESSION['UserConnect']))
						{
							$useCon = $_SESSION['UserConnect'];

						}else if (isset($_SESSION['UserConnectSimple']))
						{
							$useCon = $_SESSION['UserConnectSimple'];
						}
						
						$req = $pdo->query("INSERT INTO `liv_cmd`(`Date_liv_cmd`, `enreg_le`, `enreg_par`) 
								VALUES ('".$_GET['date_liv']."','".$re[0]."','".$useCon."')");

						$req = $pdo->query("select quant_cmd,Quant_livrer from detail_cmd where id_detail_cmd='".$tableau_detail[$i]."' ");
						$rep = $req->fetch();

						$Quant_livrer = $tableau_liv[$i] + $rep[1];

						$Quant_reste_a_livrer = $rep[0]-($tableau_liv[$i] + $rep[1]);

						$req = $pdo->query("UPDATE `detail_cmd` SET mont_detail_cmd='".$totale."', `Quant_livrer`='".$Quant_livrer."',`Quant_reste_a_livrer`='".$Quant_reste_a_livrer."' WHERE `Id_detail_cmd`='".$tableau_detail[$i]."'");

						$e = $pdo->query("select id_liv_cmd from liv_cmd  order by id_liv_cmd desc");
						while($re = $e->fetch())
						{
								$req = $pdo->query("INSERT INTO `detail_liv_cmd`( `Id_detail_cmd`, `Id_liv_cmd`, `Quant_cmd_liv`) VALUES ('".$tableau_detail[$i]."','".$re[0]."','".$tableau_liv[$i]."')");
								break;
						}

					//}
				}

				$_SESSION['detail']="";
				$_SESSION['liv']=""; 

				?>
				<script type="text/javascript">
  	 						document.location.href="recharge.html";

				</script>

				
				 
				<?php
			}




			}else
			{
				//header("location:menu_principale.php");
			}


		?>
				

			

			</fieldset>
			
	</section>
	<?php
	}else
	{
		 header("location:deconnexion.php");
	}
	?>
</body>