<?php
session_start();
require_once("connexion.php");



		if ((isset($_GET['id_detail_liv_cli']))) 
		{

			?>



				
		<!--script type="text/javascript">
			
			alert("je suis  sui la");
		</script-->

<?php


//Modifion le q_stock par rapport id_d_l_cmd
$sql=$pdo->query("
	select 
	stock_prod.`Quant_prod_stock`,
	stock_prod.id_stock_prod,detail_liv_cmd.`Quant_cmd_liv`,
	detail_liv_cmd.etat
	from detail_liv_cmd,
	detail_cmd,
	stock_prod

	where stock_prod.`Id_stock_prod`=detail_cmd.`Id_stock_prod`
	and   detail_cmd.`Id_detail_cmd`=detail_liv_cmd.`Id_detail_cmd`
	and   detail_liv_cmd.id_detail_liv_cmd='".$_GET['id_detail_liv_cli']."' ");

if ( $rep=$sql->fetch()) {
	
	
	$g=$rep[0]-$rep[2];
	if ($g>=0) {
		 
	

   $req1 = $pdo->query("UPDATE `stock_prod` SET `Quant_prod_stock`='".$g."' WHERE id_stock_prod='".$rep[1]."' ");
  
?>
<!--script type="text/javascript">
			
			alert("Stock modifier avec succe");
		</script-->

<?php


   $req2 = $pdo->query("UPDATE  `gesto`.`detail_liv_cmd` SET  `etat` =  '1' WHERE   detail_liv_cmd.id_detail_liv_cmd='".$_GET['id_detail_liv_cli']."' ");

   			?>
			

<?php

//je vais test si tout est d_l_cm=1 cmd=1
 
$sqll=$pdo->query("
	select 
	detail_liv_cmd.etat,cmd.id_cmd
	from 
        cmd,detail_cmd,detail_liv_cmd
	where 
        cmd.`Id_cmd`=detail_cmd.`Id_cmd` 
        and detail_cmd.`Id_detail_cmd`=detail_liv_cmd.`Id_detail_cmd`
        
	and   cmd.`Id_cmd`='".$_GET['cmd1']."' ");
	$i=0;
		while ( $repp=$sqll->fetch())
		 {
		 	if($repp[0]==0)
		 		$i=1;
		 	
  		 
 		 }

 		 if($i==0)
 		 {
 		 	 $req1 = $pdo->query("UPDATE `gesto`.`cmd` SET `etat_cmd` = '1' WHERE cmd.`Id_cmd`='".$_GET['cmd1']."' ");
 		 }
 		 	
 		 	?>
 		 	 <script type="text/javascript">

  	 						document.location.href="confirmation_vente.php";

			</script>
			 <?php
 		 }
 			}else {

			 		?>
					<script type="text/javascript">
								
								alert("Se produit est en rupture de stock ");
							</script>

					<?php
				 	
			 	}

}else {

 		?>
<script type="text/javascript">
			
			alert("La requete select na pas  retourne la quantite Stock");
		</script>

<?php
 	
 }
 
			
		 
			?>



				
		<script type="text/javascript">
			
			alert("je ne suis pas un sui la");
		</script>

<?php

		 			





?>