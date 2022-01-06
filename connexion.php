<?php
	
	try
	{
	   $pdo = new pdo('mysql:host=localhost; dbname=gesto',"root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) ;
	   //$con = mysql_connect('localhost','root','');
	   //mysql_select_db('transfert',$con);

	}catch(Exception $ex)
	{
	    die("ERREUR".$ex->getMessage());
	}

?>