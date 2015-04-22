<!DOCTYPE html>
<html>
<head lang="en">
  <?php
    include 'imports.php';
  ?>
</head>
<?php
include 'header.php';
?>
<body>
<div class="wrapper">
  <section>
    <?php
      echo nl2br("This is my php page to populate the database.\n\nIt prints out CS for each player at 10min\n\nUse match number 1798676757\n\n");
      if(isset($_POST['subbut'])){
        $matchid = $_POST['matchid'];
        $url = 'https://na.api.pvp.net/api/lol/na/v2.2/match/' . $matchid . '?includeTimeline=true&api_key=67f8945b-05c7-49b0-ac69-e4d6b30bb529';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);			
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        // print(var_dump($result["timeline"]["frames"][10]["participantFrames"]));
        for($i = 1; $i <= 10; $i++) {
          print('Player ' . $i . ' ' . $result["timeline"]["frames"][10]["participantFrames"][$i]["minionsKilled"] . '     ');
        }
      }
    ?>
  </section>
<form name="match" METHOD="POST" ACTION="populate.php">
	<input type="text" name="matchid" value="Match ID">
	<input type="Submit" name="subbut" value="Pull">
</form>
</div>
</body>
</html>