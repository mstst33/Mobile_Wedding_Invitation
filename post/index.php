<?php
	header("Content-Type:application/json");
	// $page = $_POST["page"];
	
	$dbpath = "postdb";
	if(file_exists($dbpath))
	{
		$readdb = file_get_contents("postdb");
		$utf8_enc = utf8_encode($readdb);
		// $json_dec = json_decode($readdb, true);
		// $json_enc = json_encode($json_dec, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		// echo $utf8_enc;
		echo $readdb;
	}
?>