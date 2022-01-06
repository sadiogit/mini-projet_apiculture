<?php
	
	session_start();
	
	unset($_SESSION['UserConnect']);
	unset($_SESSION['UserConnectConfirme']);
	unset($_SESSION['UserConnectCmdApprov']);
	require_once("authentification.html");
	


?>