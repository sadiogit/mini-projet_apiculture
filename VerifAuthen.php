<?php

	require_once("connexion.php");
		session_start();


			
			if((isset($_POST['pseudo']))&&(isset($_POST['passe'])))
			{

					 

					$e = $pdo->query("select id_user,privilege from utilisateur where pseudo='".$_POST['pseudo']."' and mdp='".$_POST['passe']."'");
					;
					if ($re = $e->fetch()) 
					{
						if ($re[1]==1)
						{
							//Confirme
							$_SESSION['UserConnect']=$re[0];
							$_SESSION['UserConnectConfirme'] = 0;
							header("location:confirmation_vente.php");

						}else if ($re[1]==2)
						{
							$_SESSION['UserConnect']=$re[0];
							$_SESSION['UserConnectCmdApprov']=0;
							header("location:vente.php");


						}else
						{
							echo "<center><h1>Information erronee</h1><center/>";
							require_once("authentification.html");
						}

						

					}else
					{
						echo "<center><h1>Information erronee</h1><center/>";
						require_once("authentification.html");
					}
					
			}else
			{
				header("location:‪authentification.html");
			}

?>