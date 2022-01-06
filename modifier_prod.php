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

		
		if (isset($_GET['codeprod']))
		{
			$sql=("select Nom_prod,desc_prod,categ,cat.id_cat from prod,cat where cat.id_cat=prod.id_cat and id_prod='".$_GET['codeprod']."' ");
			$req=$pdo->query($sql);
            $tableau=$req->fetch();
															
						
	?>
			
			<div class="row" style="margin-right: 10%; margin-left: 10%; ">
                       

                <div class="col-lg-4 text-center" style="margin-right: 30%; margin-left: 30%; ">
                   <!--div class="panel panel-default">
                   <div class="panel-body"-->
                              


                              <!-- Debut formulaire -->

                          <div class="panel panel-primary filterable">
                              <div class="panel-heading">
                                <h3 class="panel-title">Modifier Produit<span style="color: white; font-weight: bold;"> </span></h3>

                              </div>

                              
					               <div class="panel-body" style="height: 540%; height:540px;" >


						<form action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
							<input type=hidden name=codeprod value="<?php echo $_GET['codeprod']  ?>">

							 

								<div class="form-group">
				                   <input type="text"  required name="produit" required class="form-control" value="<?php echo $tableau[0]; ?>" size="50%" maxlength="20" required/>
				                </div>
					        	
					        	 
								
					        		<div class="form-group">
								 
									 <select  class="form-control" name="cat" id="sel1">
									<?php

									$sql1=("select id_cat,categ from cat where id_cat!='". $tableau[3]."'");
			$req1=$pdo->query($sql1);
			echo "<option value=\"$tableau[3]\"> ". $tableau[2]."</option>";
            while ($tableau1=$req1->fetch())
				{
					
												echo "<option value=\" $tableau1[0]\" >  $tableau1[1] </option>";
											}
									?></select> </td>
								</tr></div>

								<div class="form-group">
								  <textArea required class="form-control" name="desc_prod" size="50%" cols="51" rows="5" ><?php echo $tableau[1]; ?></textArea>
								 
                                            </div>	

								<tr>
									<td></td> 

									<div> 
									 <button type="submit" style="width: 100%;" class="btn btn-primary "><span class="glyphicon glyphicon-saved" aria-hidden="true"> Modifier</span></button>
									 </div>
								</tr>

						 
						</form>
	<?php

		require_once("connexion.php");

		if ((isset($_GET['desc_prod'])) )
		{
			//echo $_GET['produit']." ".$_GET['cat']." ".$_GET['desc_prod']." ".$_GET['codeprod'];
			
			$sql2="UPDATE `prod` SET `Nom_prod`='".$_GET['produit']."',`id_cat`='".$_GET['cat']."',`Desc_prod`='".$_GET['desc_prod']."' WHERE `Id_prod`='".$_GET['codeprod']."' ";
			
			if ($pdo->exec($sql2))
			{
				//header("location:produit.php");
			
			}
		}
		
		}else
		{
			//header("location:produit.php");
		}

	?>
		 

	<br><br><br><br><br>
                                  </div>
                             
                              </div>
                         </div>            
                       </div>
                       </div>
                    </div>
	

</body>