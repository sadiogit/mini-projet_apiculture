<?php
			

			require_once("connexion.php");
			session_start();
			$c="----------Client-------------------------Contact-----------------------Adresse----------------------------";

			if((isset($_GET['verif']))&&(isset($_GET['client']))&&(strnatcmp($_GET['client'],$c)==true)&&(isset($_GET['date_vente'])))
			{
				$u=0;
				$tableau_client= $_GET['client'];
				$tableau_date_vente= $_GET['date_vente'];	

				$tableau_prix_unit=explode("//", $_SESSION['montant']);
				$tableau_produit=explode("@@", $_SESSION['produit1']);
				$tableau_quantite=explode("//", $_SESSION['quantite']);
				$tableau_quantite_liv=explode("//", $_SESSION['quantite_liv']);	
				
				$mont=0;
				$mont_total=0;

				$usercon = 0;
					if (isset($_SESSION['UserConnect']))
					{
						$usercon = $_SESSION['UserConnect'];

					}else if (isset($_SESSION['UserConnectSimple']))
					{
						$usercon = $_SESSION['UserConnectSimple'];
					}

				for ($i=1; $i <count($tableau_quantite) ; $i++) 
				{ 
					$mont=($tableau_prix_unit[$i]*$tableau_quantite_liv[$i]);
					$mont_total=$mont_total+$mont;
				}

				$mont_rest=$mont_total-$_GET['versement'];

				if($mont_rest<0)
				{
					$mont_rest  = 0;	
				}

				$reqf=$pdo->query("select current_date from dual");
				$ta=$reqf->fetch();
				

				$sql="INSERT INTO `cmd`(`Id_cli`, `Mont_regle`, `Mont_total_cmd`, `Mont_reste_a_regler`,`enreg_le`,`enreg_par`) 
				value('".$tableau_client."','".$_GET['versement']."','".$mont_total."','".$mont_rest."','".$ta[0]."','".$usercon."')";
				if($pdo->exec($sql))
				{
					$sql1="select id_cmd from cmd order by id_cmd desc";
					$tab=$pdo->query($sql1);
					$t=0;
					while($rep1=$tab->fetch())
					{
						$t=$rep1[0];
						break;
					}


					$sql="INSERT INTO `regle_cmd`(`Mont_fourni_cli_cmd`, `Date_regle_cmd`, `Id_cmd`, `Mont_reste_cmd`, `Mont_reste_cmd_apres_reglement`,`enreg_le`,`enreg_par`)
						value('".$mont_rest."','".$tableau_date_vente."','".$t."','".$mont_total."','".$mont_rest."','".$ta[0]."','".$usercon."')";

					if($pdo->exec($sql))
					{
						for ($i=1; $i <count($tableau_quantite) ; $i++) 
						{

						/*	$Quant_prod_stock=0;
							echo "<br>".$tableau_produit[$i]."<br>";
							$req=$pdo->query("select Quant_prod_stock from stock_prod where `Id_stock_prod`='".$tableau_produit[$i]."' ");
							while ($taa=$req->fetch()) 
							//{
								echo "1";				
								$Quant_prod_stock=$taa[0];

								if ($Quant_prod_stock>=0) 
								{
									
									//$sql="UPDATE `stock_prod` SET `Quant_prod_stock`='".$Quant_prod_stock."'  WHERE `Id_stock_prod`='".$tableau_produit[$i]."' ";
									//if($pdo->exec($sql))
									//{	*/
										$tn = $tableau_quantite[$i]-$tableau_quantite_liv[$i];

											$sql="INSERT INTO `detail_cmd`(`Date_cmd`, `Id_cmd`, `Quant_cmd`, `Id_stock_prod`, `Prix_unit`, `Mont_detail_cmd`,Quant_livrer,Quant_reste_a_livrer)
													value('".$tableau_date_vente."','".$t."','".$tableau_quantite[$i]."','".$tableau_produit[$i]."','".$tableau_prix_unit[$i]."','".$tableau_quantite_liv[$i]*$tableau_prix_unit[$i]."','".$tableau_quantite_liv[$i]."','".$tn."')";
											if($pdo->exec($sql))
											{
												$f = "INSERT INTO `liv_cmd`(`Date_liv_cmd`, `enreg_le`, `enreg_par`) 
														VALUES ('".$tableau_date_vente."','".$ta[0]."','".$usercon."')";
												if($pdo->exec($f))
												{
													$ree = $pdo->query("select id_detail_cmd from detail_cmd order by id_detail_cmd desc");
													while($rr = $ree->fetch())
													{

														$ree1 = $pdo->query("select Id_liv_cmd from liv_cmd order by Id_liv_cmd desc");
														while($rr1 = $ree1->fetch())
														{
															$ins = "INSERT INTO `detail_liv_cmd`(`Id_detail_cmd`, `Id_liv_cmd`, `Quant_cmd_liv`) 

																				VALUES ('".$rr[0]."','".$rr1[0]."','".$tableau_quantite_liv[$i]."')";
															if($pdo->exec($ins))
															{
																$u++;
															}
															break;
														}
														break;
													}
												}
																
											}													

									//}
																										
								//}
							//}

						}

						
					}

					}
	
			}else
			{
				header("location:vente.php");
			}

				if ($u!=0) {

					$_SESSION['produit']="";
					$_SESSION['quantite']="";
					$_SESSION['date_vente']="";
					$_SESSION['quantite_liv']="";
					$_SESSION['produit1']="";
					$_SESSION['stock']="";
					$_SESSION['montant']="";
					header("location:vente.php");					
		
			}else
			{
				header("location:vente.php");
			}
		?>