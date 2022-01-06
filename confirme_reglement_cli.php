<?php
session_start();
require_once("connexion.php");



		if ((isset($_GET['id_cmd']))&&(!empty($_GET['id_cmd']))&&(isset($_GET['montant']))&&(isset($_GET['date_regle']))) 
		{

			echo $_GET['id_cmd']."<br>";
			echo $_GET['montant']."<br>";
			echo $_GET['date_regle']."<br><br><br>";

			$sql=$pdo->query("select Mont_regle,Mont_total_cmd,Mont_reste_a_regler from cmd where Id_cmd='".$_GET['id_cmd']."' ");

					 $rep=$sql->fetch(); 
					
					$Mont_regle = $rep[0] + $_GET['montant'];

					$Mont_reste_a_regler = $rep[1] - $Mont_regle;

					echo "Mont_total_cmd = $rep[1]<br>";

					echo "ANCIEN Mont_regle = $rep[0]<br>";

					echo "nouv Mont_regle = $Mont_regle<br>";

					//echo "$Mont_regle<br>";
					
					echo "$Mont_reste_a_regler";


					if ($Mont_reste_a_regler>=0)
					{
						echo "string";
						$req = "UPDATE `cmd` SET `Mont_regle`='".$Mont_regle."', `Mont_reste_a_regler`='".$Mont_reste_a_regler."'  WHERE `Id_cmd`='".$_GET['id_cmd']."'";
						if ($pdo->exec($req))
						{
							$reqt=$pdo->query("select current_date from dual");
							$tat=$reqt->fetch();

							$Mont_reste_cmd_apres_reglement=$rep[1]-$_GET['montant'];
							$useCon;
							if (isset($_SESSION['UserConnect']))
							{
								$useCon = $_SESSION['UserConnect'];

							}else if (isset($_SESSION['UserConnectSimple']))
							{
								$useCon = $_SESSION['UserConnectSimple'];
							}

							$sql2="INSERT INTO `regle_cmd`(`Mont_fourni_cli_cmd`, `Date_regle_cmd`, `Id_cmd`, `Mont_reste_cmd`, `Mont_reste_cmd_apres_reglement`,enreg_le,enreg_par) 
									VALUES ('".$_GET['montant']."','".$_GET['date_regle']."','".$_GET['id_cmd']."','".$rep[2]."','".$Mont_reste_a_regler."','".$tat[0]."','".$useCon."')";

								if ($pdo->exec($sql2)) 
								{
									header("location:Reglement_cli.php");

								}
						}
					}
					 
				
		}else
		{
			header("location:Reglement_cli.php");
		}
			





?>