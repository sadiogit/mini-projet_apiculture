<?php
session_start();
require_once("connexion.php");


if ((isset($_GET['id_approv']))&&(!empty($_GET['id_approv']))&&(isset($_GET['montant']))&&(isset($_GET['date_regle'])))
 {
			
				$sql=$pdo->query("select Mont_total_reste_four,Mont_reste_regle_four_apres_regle_four,id_approv 

									from regle_four 

									where id_approv='".$_GET['id_approv']."' order by id_regle_four desc");

				$usercon = 0;
					if (isset($_SESSION['UserConnect']))
					{
						$usercon = $_SESSION['UserConnect'];

					}else if (isset($_SESSION['UserConnectSimple']))
					{
						$usercon = $_SESSION['UserConnectSimple'];
					}
				
				while ($rep=$sql->fetch()) 
				{
					
					$Mont_total_reste_four=$rep[1];
					$Mont_reste_regle_four_apres_regle_four=$rep[1]-$_GET['montant'];

					echo "$rep[1]<br>";
					echo $_GET['montant']."<br>";
					echo "$Mont_reste_regle_four_apres_regle_four<br>";


					if ($Mont_reste_regle_four_apres_regle_four>=0)
					{
						echo "ff<br>";
						$reqt=$pdo->query("select current_date from dual");
						$tat=$reqt->fetch() ;

						$sql1="INSERT INTO `regle_four`(`Mont_remis_four`, `Mont_total_reste_four`, `Date_regle_four`, `Id_approv`, `Mont_reste_regle_four_apres_regle_four`,enreg_le,enreg_par) 
							VALUES ('".$_GET['montant']."','".$Mont_total_reste_four."','".$_GET['date_regle']."','".$rep[2]."','".$Mont_reste_regle_four_apres_regle_four."','".$tat[0]."','".$usercon."')";
						if($pdo->exec($sql1) )
						{
							echo "ffr<br>";
							$re =$pdo->query("select mont_regle from approv where id_approv='".$_GET['id_approv']."' ");
							$repp = $re->fetch() ;
							$total= $repp[0]+$_GET['montant'];
							echo "$total ".$_GET['id_approv'];

							$modif = " update approv set mont_regle='".$total."' where id_approv=".$_GET['id_approv']."";
							if($pdo->exec($modif))
								header("location:Reglement_four.php");
							else
							{
								//supprimer la derniere ligne ajouter
							}
						}
							
					}else
						header("location:Reglement_four.php");

					break;
				}

				
}else
{
	header("location:Reglement_four.php");
}





?>