<?php
	$itemFileUrl = "itemQueries.sql";
	# A PHP script to return book data.  Author: Marty Stepp, Nov 30 2008

	# main program
	if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
		header("HTTP/1.1 400 Invalid Request");
		die("ERROR 400: Invalid request - This service accepts only POST requests.");
	}
	if (isset($_POST["method"])) {
		if ($_POST["method"] == "resetFile") {
			deleteFile();
		}
	} else if (!(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["imageURL"]))) {
		header("HTTP/1.1 400 Invalid Request");
		die("ERROR 400: Invalid request - request requires params 'id', 'name', 'description', 'imageURL'");
	} else {
		$itemFile = fopen($itemFileUrl, "a") or die("ERROR 503: Server could not open the file"); // a for append, w for write

		$id = $_POST["id"];
		$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
		$description = htmlspecialchars($_POST["description"], ENT_QUOTES);
		$imageURL = htmlspecialchars($_POST["imageURL"], ENT_QUOTES);
		//	echo "name = $name, id = $id, title = $title, primary role = $primaryRole, secondary role = $secondaryRole <br/>";
		// id name title role1 role2
		$query = "CALL insert_item($id, '$name', '$description', '$imageURL');";
//		echo $query;
		fwrite($itemFile, "$query\n");
		fclose($itemFile);
	}

	function deleteFile() {
		global $itemFileUrl;
		echo "DELETED $itemFileUrl";
		unlink($itemFileUrl);
	}

?>