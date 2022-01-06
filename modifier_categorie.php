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
        
		if (isset($_GET['codecat']))
		{
			
			$sql1=$pdo->query("select * from cat where id_cat='".$_GET['codecat']."' ");

			$rep1=$sql1->fetch();
				
	?>
			
			<center>
				
				 
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

                <div class="col-lg-4 text-center" style="margin-right: 30%; margin-left: 30%; ">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Modifier Categorie<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
                                     <div class="panel-body" style="height: 540%; height:540px;" >


                                      	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
						<input type=hidden name=codecat value="<?php echo $_GET['codecat']  ?>">

		                                         

                                            <div class="form-group">
                                               <input type="text" name="categorie" required class="form-control" value="<?php echo $rep1[1] ?>"/>
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

		if ((isset($_GET['categorie'])) )
		{
			//echo $_GET['produit']." ".$_GET['cat']." ".$_GET['contact']." ".$_GET['codeprod'];
			
			$sql="UPDATE `cat` SET `categ`='".$_GET['categorie']."' WHERE `id_cat`='".$_GET['codecat']."' ";
			if ($pdo->exec($sql))
			{
				//header("location:utilisateur.php");
			}
		}
		
		}else
		{
			 // header("location:utilisateur.php");
		}

	?>
		 
	</center>
	

</body>