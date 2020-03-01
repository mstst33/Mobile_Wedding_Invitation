<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
    	<?php
			$pid = $_POST["id"];
			$pnickname = $_POST["nickname"];
			$pimg = $_POST["img"];
			$pacctype = $_POST["acctype"];
			$pdate = date("Y-m-d H:i:s");
			$ppostdata = $_POST["postdata"];
			$json_arr = array (
			    'id' => $pid,
			    'nickname' => $pnickname,
			    'img' => $pimg,
			    'acctype' => $pacctype,
			    'date' => $pdate,
			    'postdata' => $ppostdata
			);

		    $dbpath = "postdb";
		    if(file_exists($dbpath))
		    {
		    	$readdb = file_get_contents("postdb");
				$json_dec = json_decode($readdb, true);
				array_unshift($json_dec["list"], $json_arr);
				$json_enc = json_encode($json_dec, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
				// echo 'readdb ', $json_enc;
		    }
		    else
		    {
				$json_list = array();
				$json_list["list"] = array();
				array_unshift($json_list["list"], $json_arr);
				$json_enc = json_encode($json_list, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
				// echo 'new encoding ', $json_enc;
		    }
			
			$postdb = fopen("postdb", "w");
			fwrite($postdb, $json_enc);
			fclose($postdb);
		?>
		<script type="text/javascript">
			window.location.href = 'http://mstst33.com/marriage/#guestWrapper';
		</script>
    </body>
</html>