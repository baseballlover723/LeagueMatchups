<!DOCTYPE html>
<html>
<head lang="en">
	<?php
		include 'imports.php';
		$queryFile = fopen("championQueries.sql", "w") or die("unable to open file"); // a, append; w, write
	?>
</head>
<?php
	include 'header.php';
?>
<body>
<div class="wrapper">
	<section>
		<?php
			echo 'this is my php page to populate the database';
			echo '<br/><br/>';
			populateAllChampions();
			//			echo callAPI("https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/266?champData=tags&api_key=f5c821d7-fc96-47f3-914d-7026a8525eee");
			//			echo '<br/>';
			//			"static-data/na/v1.2/champion?champData=tags&api_key=f5c821d7-fc96-47f3-914d-7026a8525eee"
			//			echo callAPI($baseUrl,"static-data/na/v1.2/champion", ["champData=tags"]);
			fclose($queryFile);

		?>
	</section>
</div>
</body>
</html>
<?php
	function populateAllChampions() {
		global $baseUrl;
		global $con;
//		echo callAPI("static-data/na/v1.2/champion", ["champData=tags"]);
		$arr = json_decode(callAPI("static-data/na/v1.2/champion", ["champData=tags"]), true)["data"];
		foreach($arr as $data) {
			@populateChampion($con, $data);
			echo print_r($data) . "<br/><br/>";
		}
//		for ($k =0; $k<count($arr); $k++) {
//			echo "$arr[$k]\n";
//		}
	}

	function populateChampion($con, $champ) {
		global $queryFile;
		$id = $champ[id];
		$name = htmlspecialchars($champ[name], ENT_QUOTES);
		$title = htmlspecialchars($champ[title], ENT_QUOTES);
		$primaryRole = htmlspecialchars($champ[tags][0], ENT_QUOTES);
		$secondaryRole = htmlspecialchars($champ[tags][1], ENT_QUOTES);
		echo "name = $name, id = $id, title = $title, primary role = $primaryRole, secondary role = $secondaryRole <br/>";
		// id name title role1 role2
		$query = "CALL insertChampion($id, '$name', '$title', '$primaryRole', '$secondaryRole');";
		fwrite($queryFile, "$query\n");
		echo "$query <br/>";
		$queryChange = mysqli_query($con, $query);
	}

	function populateItems() {
		// id, name, description, image
	}

	//
		function callAPI($path, $params) {
			global $apiKey;
			global $baseUrl;
			$url = $baseUrl . $path . "?";
			if (count($params) > 0) {
				for ($k = 0; $k < count($params); $k++) {
					$url = $url . $params[$k] . "&";
				}
			}
			$url = $url . $apiKey;

	//		echo "url = $url<br/>";
			$response = @file_get_contents($url);
			list($version,$status_code,$msg) = explode(' ',$http_response_header[0], 3);
			echo "status code = $status_code<br/>";
			if ($status_code === "200") {
				return $response;
			}
			return false;
		}

//	function callAPI($path, $params) {
//		global $apiKey;
//		global $baseUrl;
//		$url = $baseUrl . $path . "?";
//		if (count($params) > 0) {
//			for ($k = 0; $k < count($params); $k++) {
//				$url = $url . $params[$k] . "&";
//			}
//		}
//		$url = $url . $apiKey;
//				echo "url = $url<br/>";
//
//		$curl = curl_init($url);
//		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//		$curl_response = curl_exec($curl);
//		echo "***$curl_response***";
//		if ($curl_response === false) {
//			$info = curl_getinfo($curl);
//			curl_close($curl);
//			die('error occured during curl exec. Additional info: ' . var_export($info));
//		}
//		curl_close($curl);
////		echo "$curl_response<br/>*<br/>";
//		$decoded = json_decode($curl_response);
//		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
//			die('error occured: ' . $decoded->response->errormessage);
//		}
//		echo 'response ok!';
//		var_export($decoded->response);
//	}

?>