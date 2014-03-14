<?php
$servers = array(
	'hauptserver' => 's.freecraft.eu:25560',
	'skyblock' => 's.freecraft.eu:25561',
 );

$img_size = 52;
$avatar_url = 'http://cravatar.eu/helmhead/%s/' . $img_size;

if (empty($_GET['server']) || empty($servers[$_GET['server']]))
	die('Dieser Server ist nicht konfiguriert.');
else
	$server = $servers[$_GET['server']];

require('minequery.class.php');
$var_array = Minequery::query($server);

if (empty($var_array['maxPlayers'])) {
	$is_offline = true;
} else {
	$is_offline = false;
	$playerList = $var_array['playerList'];
	$playerCount = $var_array['playerCount'];
	$maxplayer = $var_array['maxPlayers'];
}

?>

<html>
	<head>
		<title> Online Spieler </title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<style type="text/css">
		body {
			padding-top: 10px;
		}
		</style>
	</head>
	<body>
		<div class="container" style="width: 350px;">
			<div class ="panel panel-default">
				<div class="panel-heading">
					<strong>Spieler Online: </strong><small><?php echo htmlspecialchars($playerCount);?></small>
				</div>
				<div class="panel-body">
					<?php if ($is_offline): ?>
						<p class="offline-msg">Server offline.</p>
					<?php else: ?>

						<div class="playerlist">
							<?php foreach($playerList as $p): ?>
								<img src="<?php printf($avatar_url, rawurlencode($p)) ?>" style="margin-top:-10px; margin-bottom:-10px;" alt="<?php echo htmlspecialchars($p) ?>" title="<?php echo htmlspecialchars($p) ?>" style="height: <?php echo $img_size ?>px;width: <?php echo $img_size ?>px;"> <strong><?php echo htmlspecialchars($p) ?></strong><hr>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>
