<?php
	$matchupFileUrl = "SQL/tempSQL/matchups";

	# main program
	if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
		header("HTTP/1.1 400 Invalid Request");
		die("ERROR 400: Invalid request - This service accepts only POST requests.");
	}

	$hasArgs = isset($_POST["matchId"]) && isset($_POST["lane"]) && isset($_POST["rank"]) && isset($_POST["champ1"])
		&& isset($_POST["kills1"]) && isset($_POST["deaths1"]) && isset($_POST["assists1"]) && isset($_POST["laneKills1"])
		&& isset($_POST["laneDeaths1"]) && isset($_POST["laneAssists1"]) && isset($_POST["towerKills1"])
		&& isset($_POST["cs1"]) && isset($_POST["gold1"]) && isset($_POST["champ2"]) && isset($_POST["kills2"])
		&& isset($_POST["deaths2"]) && isset($_POST["assists2"]) && isset($_POST["laneKills2"]) && isset($_POST["laneDeaths2"])
		&& isset($_POST["laneAssists2"]) && isset($_POST["towerKills2"]) && isset($_POST["cs2"]) && isset($_POST["gold2"]) && isset($_POST["fileNo"]);
	if (isset($_POST["method"])) {
		if ($_POST["method"] == "resetFile") {
			deleteFile();
		}
	} else if (!$hasArgs) {
		header("HTTP/1.1 400 Invalid Request");
		die("ERROR 400: Invalid request - request requires params 'id', 'name', 'description', 'imageURL'");
	} else {
		$itemFile = fopen($matchupFileUrl . $_POST["fileNo"] .".sql", "a") or die("ERROR 503: Server could not open the file"); // a for append, w for write


		$matchId = htmlspecialchars($_POST["matchId"], ENT_QUOTES);
		$lane = htmlspecialchars($_POST["lane"], ENT_QUOTES);
		$rank = htmlspecialchars($_POST["rank"], ENT_QUOTES);

		$champ1 = htmlspecialchars($_POST["champ1"], ENT_QUOTES);
		$kills1 = htmlspecialchars($_POST["kills1"], ENT_QUOTES);
		$assists1 = htmlspecialchars($_POST["assists1"], ENT_QUOTES);
		$deaths1 = htmlspecialchars($_POST["deaths1"], ENT_QUOTES);
		$laneKills1 = htmlspecialchars($_POST["laneKills1"], ENT_QUOTES);
		$laneAssists1 = htmlspecialchars($_POST["laneAssists1"], ENT_QUOTES);
		$laneDeaths1 = htmlspecialchars($_POST["laneDeaths1"], ENT_QUOTES);
		$towerKills1 = htmlspecialchars($_POST["towerKills1"], ENT_QUOTES);
		$cs1 = htmlspecialchars($_POST["cs1"], ENT_QUOTES);
		$gold1 = htmlspecialchars($_POST["gold1"], ENT_QUOTES);

		$champ2 = htmlspecialchars($_POST["champ2"], ENT_QUOTES);
		$kills2 = htmlspecialchars($_POST["kills2"], ENT_QUOTES);
		$assists2 = htmlspecialchars($_POST["assists2"], ENT_QUOTES);
		$deaths2 = htmlspecialchars($_POST["deaths2"], ENT_QUOTES);
		$laneKills2 = htmlspecialchars($_POST["laneKills2"], ENT_QUOTES);
		$laneAssists2 = htmlspecialchars($_POST["laneAssists2"], ENT_QUOTES);
		$laneDeaths2 = htmlspecialchars($_POST["laneDeaths2"], ENT_QUOTES);
		$towerKills2 = htmlspecialchars($_POST["towerKills2"], ENT_QUOTES);
		$cs2 = htmlspecialchars($_POST["cs2"], ENT_QUOTES);
		$gold2 = htmlspecialchars($_POST["gold2"], ENT_QUOTES);

		$item00 = $_POST["item00"];
		$item01 = $_POST["item01"];
		$item02 = $_POST["item02"];
		$item03 = $_POST["item03"];
		$item04 = $_POST["item04"];
		$item05 = $_POST["item05"];

		$item10 = $_POST["item10"];
		$item11 = $_POST["item11"];
		$item12 = $_POST["item12"];
		$item13 = $_POST["item13"];
		$item14 = $_POST["item14"];
		$item15 = $_POST["item15"];
		//	echo "name = $name, id = $id, title = $title, primary role = $primaryRole, secondary role = $secondaryRole <br/>";
		// id name title role1 role2

		$query = "CALL insertSingle('$matchId', '$lane', '$rank', '$champ1', '$kills1', '$assists1', '$deaths1', '$laneKills1', "
			. "'$laneAssists1', '$laneDeaths1', '$towerKills1', '$cs1', '$gold1', '$champ2', '$kills2', '$assists2', '$deaths2', "
			."'$laneKills2', '$laneAssists2', '$laneDeaths2', '$towerKills2', '$cs2', '$gold2');";
//		echo $query;
		fwrite($itemFile, "$query\n");

		$itemQuery1 = "CALL insertItemUsage_Match('$champ1', '$matchId', $item00, $item01, $item02, $item03, $item04, $item05);";
		fwrite($itemFile,"$itemQuery1\n");
		$itemQuery2 = "CALL insertItemUsage_Match('$champ2', '$matchId', $item10, $item11, $item12, $item13, $item14, $item15);";
		fwrite($itemFile,"$itemQuery2\n");

		fclose($itemFile);
	}

	function deleteFile() {
		global $matchupFileUrl;
		echo "DELETED $matchupFileUrl";
		unlink($matchupFileUrl);
	}

?>