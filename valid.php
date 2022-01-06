<?php

		require_once("connexion.php");
		session_start(); 
		echo "string";
			if(isset($_GET['date_approv']))
			{
				echo "string";
				$tableau = explode("//", $_SESSION['num_stock']);
				$tableau01 = explode("//", $_SESSION['liv1']);

				for ($i=1; $i <count($tableau) ; $i++) 
				{ 
					$req0 = $pdo->query("select Quant_prod_stock,quant_approv,quant_demande,mont_four,prix_achat_prod,approv.id_approv 
											from stock_prod,approv where approv.id_approv=stock_prod.id_approv and stock_prod.id_stock_prod='".$tableau[$i]."' ");

					$rrr = $req0->fetch();

						$g = $rrr[0] + $tableau01[$i];

						$g1 = $rrr[1] + $tableau01[$i];

						$g2 = $rrr[2] - $g1;

						$prix = $tableau01[$i]* $rrr[4];
						$totale =$prix + $rrr[3];

						$e = $pdo->query("select current_date from dual");
						$re = $e->fetch();

						$req1 = $pdo->exec("UPDATE `approv` SET `Mont_four`='".$totale."',`enreg_le`='".$re[0]."' WHERE id_approv='".$rrr[5]."'");

						$ref = $pdo->query("select mont_total_reste_four,mont_remis_four,id_regle_four from regle_four where id_approv='".$rrr[5]."' order by id_regle_four desc");
						while($tab=$ref->fetch())
						{
							//echo "<br>id $tab[2]";
							$total = $prix + $tab[0];
							$reste = $total - $tab[1];

							//echo "<br>$prix";
							//echo "<br>$tab[0]";
							//echo "<br>$total";

							//echo "<br>$tab[1]";
							//echo "<br>$reste";
							
							$modif = $pdo->exec("UPDATE `regle_four` SET `Mont_total_reste_four`=".$total.",Mont_reste_regle_four_apres_regle_four=".$reste.",`enreg_le`='".$re[0]."' WHERE id_regle_four='".$tab[2]."' ");



							break;
						}
						
						

						$req1 = $pdo->exec("UPDATE `stock_prod` SET `Quant_prod_stock`='".$g."',`Quant_approv`='".$g1."',`Quant_reste_a_livrer_approv`='".$g2."' WHERE id_stock_prod='".$tableau[$i]."' ");

						$usercon = 0;
						if (isset($_SESSION['UserConnect']))
						{
							$usercon = $_SESSION['UserConnect'];

						}else if (isset($_SESSION['UserConnectSimple']))
						{
							$usercon = $_SESSION['UserConnectSimple'];
						}


						$req = $pdo->exec("INSERT INTO `liv_four`(`Date_liv_four`, `enreg_le`, `enreg_par`) 
							VALUES ('".$_GET['date_approv']."','".$re[0]."','".$usercon."')");

						$e = $pdo->query("select id_liv_four from liv_four order by id_liv_four desc");
						while($re = $e->fetch())
						{
							$req = $pdo->exec("INSERT INTO `detail_liv_four`( `Id_liv_four`, `Id_stock_prod`, `Quant_prod_liv_four`) 
								VALUES ('".$re[0]."','".$tableau[$i]."','".$tableau01[$i]."')");

							break;
						}

						
					
				}

				
				$_SESSION['num_stock']="";
				$_SESSION['liv1']="";
				$_SESSION['t'] = $_GET['num_approv'];
				header("location:livraison_approvision_detail.php");

				
			}


			?>