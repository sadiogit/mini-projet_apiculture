<?php
	
	require_once("connexion.php");
		session_start();


			if((isset($_GET['nom']))&&(isset($_GET['contact']))&&(isset($_GET['priv']))&&(isset($_GET['pseudo']))&&(isset($_GET['mdp']))&& $_GET['mdp']==$_GET['mdp1'])
			{

					$e = $pdo->query("select current_date from dual");
					$re = $e->fetch();
					echo "string";

					$sql="INSERT INTO `utilisateur`(`nom`, `contact`, `privilege`, `enreg_le`, `enreg_par`,pseudo,mdp) VALUES ('".$_GET['nom']."','".$_GET['contact']."','".$_GET['priv']."','".$re[0]."',1,'".$_GET['pseudo']."','".$_GET['mdp']."')";
					if ($pdo->exec($sql)) 
					{
						header("location:utilisateur.php");
					}
			}else
				header("location:utilisateur.php");


?>