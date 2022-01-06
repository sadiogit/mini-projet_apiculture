<?php

			require_once("connexion.php");
			session_start();
			
			if((isset($_GET['verif1']))&&(isset($_GET['four']))&&(isset($_GET['versement']))&&(isset($_GET['date_approv'])))
			{
				$vers = $_GET['versement'];
				
				$u=0;
				$tableau_produit=explode("//", $_SESSION['code_prod']);
					
					

					$tableau_quantite=explode("//", $_SESSION['quantite']);
					$tableau_prix_achat=explode("//", $_SESSION['prix_achat']);
					$tableau_prix_vente=explode("//", $_SESSION['prix_achat']);

					$tableau_date_exp=explode("//", $_SESSION['date_exp']);	

					$tableau_quantite_liv=explode("//", $_SESSION['quantite_liv']);

					$mont = 0;
						
					for ($i=1; $i <count($tableau_quantite) ; $i++) 
					{ 

						$mont = $tableau_prix_achat[$i]*$tableau_quantite[$i] + $mont;
						
					}

					$reste = $mont  - $vers;

					echo "$mont";


					$usercon = 0;
					if (isset($_SESSION['UserConnect']))
					{
						$usercon = $_SESSION['UserConnect'];

					}else if (isset($_SESSION['UserConnectSimple']))
					{
						$usercon = $_SESSION['UserConnectSimple'];
					}


					if ($reste>=0)
					{
						echo "string";
						$req=$pdo->query("select current_date from dual");
						$ta=$req->fetch();

						$sql="insert into approv(Id_four,date_approv,Mont_regle,Mont_four,`enreg_le`,`enreg_par`) 
						value('".$_GET['four']."','".$_GET['date_approv']."','".$vers."','".$mont."','".$ta[0]."','".$usercon."')";
						if($pdo->exec($sql))
						{
							
							$sql1="select id_approv from approv order by id_approv desc";
							$tab=$pdo->query($sql1);
							while($rep=$tab->fetch())
							{
								
								$sql="INSERT INTO `regle_four`(`Mont_remis_four`, `Mont_total_reste_four`, `Date_regle_four`, `Id_approv`, `Mont_reste_regle_four_apres_regle_four`,`enreg_le`,`enreg_par`)
																VALUES ('".$vers."','".$mont."','".$_GET['date_approv']."','".$rep[0]."','".$reste."','".$ta[0]."','".$usercon."')";
											if($pdo->exec($sql))
											{

													for ($i=1; $i <count($tableau_quantite); $i++) 
													{ 

																$dif = $tableau_quantite_liv[$i]-$tableau_quantite[$i];
																echo "dif = $dif\n";
																$sql="INSERT INTO `stock_prod`(id_approv,Quant_demande,Quant_reste_a_livrer_approv,`Id_prod`, `Quant_prod_stock`, `date_enreg_prod`, `Prix_achat_prod`, `Prix_vente_prod`, `Date_exp`, Quant_approv,id_magasin) 
																			VALUES ('".$rep[0]."','".$tableau_quantite_liv[$i]."','".$dif."','".$tableau_produit[$i]."','".$tableau_quantite[$i]."','".$ta[0]."','".$tableau_prix_achat[$i]."','".$tableau_prix_vente[$i]."','".$tableau_date_exp[$i]."','".$tableau_quantite[$i]."',1)";
																	if($pdo->exec($sql))
																	{
																		$sql2=$pdo->query("select Id_stock_prod from stock_prod order by Id_stock_prod desc");
																		while ($tab2 = $sql2->fetch())
																		{
																			$requet = "INSERT INTO `liv_four`(`Date_liv_four`, `enreg_le`, `enreg_par`) 
																					VALUES ('".$_GET['date_approv']."','".$ta[0]."','".$usercon."')";
																			if($pdo->exec($requet))
																			{
																				$sql=$pdo->query("select Id_liv_four from liv_four order by Id_liv_four desc");
																				while ($tab = $sql->fetch())
																				{
																					$r = "INSERT INTO `detail_liv_four`(`Id_liv_four`, `Id_stock_prod`, `Quant_prod_liv_four`) 
																							VALUES ('".$tab[0]."','".$tab2[0]."','".$tableau_quantite[$i]."')";
																					if($pdo->exec($r))
																					{
																						$u++;
																					}
																					break;
																				}
																			}
																			break;
																		}
																																				
																	}
														
													}

												
											}

								break;
							}

							

						}
					}

					

				




				if ($u!=0) {

					$_SESSION['produit']="";
					$_SESSION['four']="";
					$_SESSION['date_approv']="";

					$_SESSION['quantite']="";
					$_SESSION['prix_achat']="";
					$_SESSION['prix_vente']="";

					$_SESSION['date_enr']="";
					$_SESSION['date_exp']="";
					$_SESSION['quantite_liv']="";
					$_SESSION['code_prod']="";

					header("location:approvision.php");
				}
				
					
				
			}else
			{
				//header("location:approvision.php");
			}
		?>