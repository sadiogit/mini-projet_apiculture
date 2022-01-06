<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title></title>
  <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	  <link href="assets/css/css_tableau.css" rel="stylesheet">

    <!-- Add custom CSS here -->
     <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">


	

</head>
<body style="margin: 0%;
  padding : 0%;


                background: url(assets/img/backgrounds/bg3.jpg);
                background-attachment:fixed;
                background-size: cover;


                "> 

		<?php

        if( (!isset($_SESSION['UserConnect'])) || (!isset($_SESSION['UserConnectCmdApprov'])) )
        {
            header("location:deconnexion.php");
        }

        require_once("connexion.php");
				
			?>

			<!-- Sidebar -->
     <nav class="navbar navbar-default" style="height: 80px;  " ><br>
  <div class="container" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Gesto</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Fournisseur <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="fournisseur.php">Nouveau/Liste</a></li>
            <li><a href="Reglement_four.php">Reglement</a></li>
            
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produit <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="categorie.php">Categorie</a></li>
            <li><a href="produit.php">Produit</a></li>
            
          </ul>
        </li>

       

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entite <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="client.php">Enreg. et Liste</a></li>
            <!--li><a href="reglement_cli.php">Reglement</a></li-->
            
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Consultation <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="consultation_vente.php">Liste des Commandes</a></li>
            <li><a href="consultation_approv.php">Liste des Approvisionnement</a></li>
            <!--li><a href="consultation_reglement_cli.php">Reglement commande</a></li-->
            <li><a href="consultation_reglement_four.php">Reglement approvisionnement</a></li>

            <li><a href="consultation_livraison_cli.php">Livraison commande</a></li>
            <li><a href="consultation_livraison_four.php">Livraison approvisionnement</a></li>
            
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Commande<span class="caret"></span></a>

          <ul class="dropdown-menu">
            <li><a href="annule.php?recu_vente=1">Commande</a></li>
            <li><a href="confirmation_vente.php">Etat Confirmation</a></li>
                        
          </ul>
          
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Livraison <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="livraison_cmd.php">Commande</a></li>
            <li><a href="livraison_approvision.php">Approvisionnement</a></li>
            
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stock <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="annule.php?recu_approv=1">Approvisionnement</a></li>

            <li><a href="situation_stock.php">Consultation</a></li>
            <!--li><a href="#">Perime</a></li-->

           <li><a href="stock_rupture.php">En rupture</a></li>
            <!--li><a href="purger.php">Purger</a></li!-->
            
          </ul>
        </li>

        <li class="dropdown">
          <a href="modifier_pswd.php" >Utilisateur</a>
          
        </li>

        <li class="dropdown">
          <a href="deconnexion.php"  >Deconnexion</a>
          
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid --><br>
</nav>


			<br>
		
	<?php
	
  /*}else
	{
		header("location:deconnexion.php");
	}
  */
	?>

	<script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="assets/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="assets/js/tablesorter/tables.js"></script>


</body>