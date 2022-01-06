<?php

		   require_once("connexion.php");
			require_once'menu_principale.php';
		if ((isset($_GET['detail_confirmation_vente'])) )
		{
			//echo $_GET['produit']." ".$_GET['cat']." ".$_GET['contact']." ".$_GET['codeprod'];
			

$req2=$pdo->query("SELECT cmd.`Id_cmd`,detail_liv_cmd.`Quant_cmd_liv`
FROM  cmd,detail_cmd,stock_prod,detail_liv_cmd
where cmd.`Id_cmd`=detail_cmd.`Id_cmd`
and detail_cmd.`Id_stock_prod`=stock_prod.`Id_stock_prod`
and detail_cmd.`Id_detail_cmd`=detail_liv_cmd.`Id_detail_cmd`
and detail_liv_cmd.`Quant_cmd_liv`>0
and detail_liv_cmd.`etat`=0
and cmd.`Id_cmd`='".$_GET['detail_confirmation_vente']."'  ");
				
				$Quant_Livr=0;						
				while($ta2=$req2->fetch())
				{
					$Quant_Livr=$ta2[1];

					$Quant_prod_stock=0;
				//echo "<br>".$tableau_produit[$i]."<br>";
							$req=$pdo->query("
select  Quant_prod_stock ,prod.`Nom_prod` from stock_prod,detail_cmd,cmd,prod
where cmd.`Id_cmd`=detail_cmd.`Id_cmd`
and   stock_prod.`Id_stock_prod`=detail_cmd.`Id_stock_prod`
and   prod.`Id_prod`=stock_prod.`Id_prod`
and   Quant_prod_stock>0
and   cmd.`Id_cmd`='".$_GET['detail_confirmation_vente']."'  ");
						while ($taa=$req->fetch()) 
							{
								echo "1";				
								$Quant_prod_stock=$taa[0]-$Quant_Livr;

								if ($Quant_prod_stock>=0) 
								{
									
									$sql="UPDATE `stock_prod` SET `Quant_prod_stock`='".$Quant_prod_stock."'  WHERE `Id_stock_prod`='".$_GET['detail_confirmation_vente']."'  ";
									$pdo->exec($sql);
									$sql="UPDATE `gesto`.`cmd` SET `etat_cmd`= '1' WHERE `cmd`.`Id_cmd`='".$_GET['detail_confirmation_vente']."' ";
									$pdo->exec($sql);
		

								}else {
									?>

									<script type="text/javascript">
										alert("Impossible de confirmer ".$taa[0]."est en rupture de stock")
									</script>

									<?php



								}


							}
			    }
	}
			
?>


	 