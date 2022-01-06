<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Accueil</title>
	
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
        
		if (isset($_GET['codeclient']))
		{
			$sql1= $pdo->query("select * from client where id_cli='".$_GET['codeclient']."' ");

			while ($rep1= $sql1->fetch())
			{
				
			
	?>
	<center>
		
		<article>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
			<input type=hidden name=codeclient value="<?php echo $_GET['codeclient']  ?>">
			
		

		<div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

                <div class="col-lg-4 text-center" style="margin-right: 30%; margin-left: 30%; ">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Modifier Client<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body" style="height: 540%; height:540px;" >


                                       <form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
											<input type=hidden name=codeclient value="<?php echo $_GET['codeclient']  ?>">
			
		                                         

                                            <div class="form-group">
                                                <!--label class="control-label">Login:</label-->
                                               <input type="text" name="nom"  placeholder="Nom" required class="form-control" value="<?php echo $rep1[1] ?>"/>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="contact" required placeholder="contact" class="form-control" value="<?php echo $rep1[3] ?>"/>
                                            </div> 

                                            <div class="form-group">
                                            	<input type="text" name="adresse" placeholder="adresse" required class="form-control" value="<?php echo $rep1[2] ?>" required/>
                                            </div>   

                                            <div class="form-group">
                                            	<input type="date" name="dateEnreg" placeholder="Date" required class="form-control" value="<?php echo $rep1[4] ?>" required/>
                                            </div>

                                            
                                            <div> 
												<button type="submit" style="width: 100%;" class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true"> Modifier</span></button>
											</div>


                                         </form>
                                
                                  </div>
                             
                              </div>
                         <!--/div>            
                       </div-->
                    </div>
                    </div>
                      <!-- Fin formulaire -->
		<?php

		require_once("connexion.php");

		if ((isset($_GET['nom'])) )
		{
			//echo $_GET['contact']." ".$_GET['adresse']." ".$_GET['categorie']." ".$_GET['dateEnreg'];

			$sql2="UPDATE `client` SET `Nom_cli`='".$_GET['nom']."',`Adr_cli`='".$_GET['adresse']."',`Contact_cli`='".$_GET['contact']."',`Date_enreg_cli`='".$_GET['dateEnreg']."' WHERE `Id_cli`='".$_GET['codeclient']."' ";

			if ($pdo->exec($sql2))
			{
				//header("location:fournisseur.php");
			}
		}
		break;
		
		}
		}else
		{
			//header("location:fournisseur.php");
		}

		?>
	
	</article>
</center>
	

</body>