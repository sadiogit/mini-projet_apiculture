<!DOCTYPE HTML>
<html>
<head>
  <meta charset=utf-8>
  <title>Accueil</title> 
</head>
<body>
  <?php 

    session_start();

      if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectCmdApprov'])) )
      {
          require_once("menu_principale_cmdApprov.php");

      }else  if( ( isset($_SESSION['UserConnect'])) && ( isset($_SESSION['UserConnectConfirme'])) )
      {
          require_once("menu_principale_confirme.php");
      }else
      {
        header("location:deconnexion.php");
      }

    

      $sql1=$pdo->query("select * from utilisateur where id_user='".$_SESSION['UserConnect']."' ");

      if($rep1=$sql1->fetch())
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
            <input type=hidden name=codeuser value="<?php echo$_SESSION['UserConnect']  ?>">

                                        <!--select name="priv"  class="form-control" >
                        <option value=0></option>
                        <option value=1>Admin</option>
                        <option value=2>Simple User</option>
                      </select-->
                      <br>     

                                            <div class="form-group">
                                               <input type="text" name="nom" placeholder="Nom" required class="form-control" value="<?php echo $rep1[1] ?>"/>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name="contact" placeholder="Contact"  required class="form-control" value="<?php echo $rep1[2] ?>"/>
                                            </div> 

                                            <div class="form-group">
                                              <input type="text" name="pseudo1" placeholder="Pseudo"  required class="form-control" value="<?php echo $rep1[6] ?>" required/>
                                            </div>   

                                            <div class="form-group">
                                              <input type="password" name="mdp" placeholder="Mot de passe" required class="form-control" value="<?php echo $rep1[7] ?>" required/>
                                            </div>

                                            <div class="form-group">
                                              <input type="password" name="confirmer" placeholder="Confirmer Mot de passe" value="<?php echo $rep1[7] ?>" required class="form-control"   required/>
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

    if ((isset($_GET['confirmer'])) && $_GET['confirmer']==$_GET['mdp']) 
    {
      //echo $_GET['produit']." ".$_GET['cat']." ".$_GET['contact']." ".$_GET['codeprod'];
      
      $sql="UPDATE `utilisateur` SET `pseudo`='".$_GET['pseudo1']."',`mdp`='".$_GET['mdp']."',`nom`='".$_GET['nom']."',`contact`='".$_GET['contact']."'  WHERE `Id_user`='".$_SESSION['UserConnect']."' ";
      if ($pdo->exec($sql))
      {
        //header("location:utilisateur.php");
      }
    
    }}
  ?>
     
  </center>
  

</body>