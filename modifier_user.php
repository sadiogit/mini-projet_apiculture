<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Accueil</title> 
</head>
<body>
	<?php 

		session_start();
	    if( (!isset($_SESSION['UserConnect'])) || (!isset($_SESSION['UserConnectConfirme'])) )
	    {
	      header("location:deconnexion.php");
	    }

	    require_once("menu_principale_confirme.php");
	    require_once("connexion.php");


		if (isset($_GET['codeuser']))
		{
			$sql1=$pdo->query("select * from utilisateur where id_user='".$_GET['codeuser']."' ");

			while ($rep1=$sql1->fetch())
			{
				
	?>
			
			<center>
				
				 
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

                <div class="col-lg-4 text-center" style="margin-right: 30%; margin-left: 30%; ">
                   <!--div class="panel panel-default">
                   <div class="panel-body"!-->
                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Modifier Utilisateur<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body" style="height: 540%; height:540px;" >


                                      	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
						<input type=hidden name=codeuser value="<?php echo $_GET['codeuser']  ?>">

		                                    <!--select name="priv"  class="form-control" >
												<option value=0></option>
												<option value=1>Cmd Approv</option>
												<option value=2>Simple User</option>
											</select-->
											<br>     

                                            <div class="form-group">
                                               <input type="text" name="nom" required class="form-control" value="<?php echo $rep1[1] ?>"/>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="contact" required class="form-control" value="<?php echo $rep1[2] ?>"/>
                                            </div> 

                                            <div class="form-group">
                                            	<input type="text" name="pseudo1" required class="form-control" value="<?php echo $rep1[6] ?>" required/>
                                            </div>   

                                            <div class="form-group">
                                            	<input type="password" name="mdp1" required class="form-control" value="<?php echo $rep1[7] ?>" required/>
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

		if ((isset($_GET['contact']))&&($_GET['priv']>0) )
		{
			//echo $_GET['produit']." ".$_GET['cat']." ".$_GET['contact']." ".$_GET['codeprod'];
			
			$sql="UPDATE `utilisateur` SET `pseudo`='".$_GET['pseudo1']."',`mdp`='".$_GET['mdp1']."',`nom`='".$_GET['nom']."',`contact`='".$_GET['contact']."',privilege='".$_GET['priv']."', enreg_par=1 WHERE `Id_user`='".$_GET['codeuser']."' ";
			if ($pdo->exec($sql))
			{
				//header("location:utilisateur.php");
			}
		}
		break;
		
		}
		}else
		{
			 // header("location:utilisateur.php");
		}

	?>
		 
	</center>
	

</body>