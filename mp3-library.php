<!DOCTYPE html>
<html>
<head>
	<title>Music Library</title>
	<meta charset="utf-8" />
	<link href="viewer.css" type="text/css" rel="stylesheet" />
</head>
   
<body>
	<h1>My Music Page</h1>

	<?php $numSongs = 4670; ?>

	<p>
		I love music.
		I have <?= $numSongs; ?> total songs,
		which is over <?= $numSongs/10; ?> hours of music!
	</p>

	<div class="section">
		<h2>Spin Music News</h2>
		<ol>
                <?php for($i = 1; $i <= 5; $i++) { ?>
                    <li><a href="http://www.spin.com/tag/music-news/page/<?= $i; ?>/">Page <?= $i; ?></a></li>
                <?php } ?>
		</ol>
	</div>

	<div class="section">
		<h2>My Favorite Artists</h2>
		<ol>
                	<?php 
                	$fav_artist_file = file("assets/artists.txt", FILE_IGNORE_NEW_LINES);
                	foreach($fav_artist_file as $artist) { ?>
				<li><a href="http://www.allmusic.com/search/all/<?= str_replace(" ", "%20", $artist); ?>"><?= $artist; ?></a></li>
			<?php } ?>
		</ol>
	</div>
            
	<div class="section">
		<h2>My Music and Playlists</h2>
		<ul id="musiclist">
			<?php foreach (glob("assets/*.mp3") as $song) { ?>
				<li class="mp3item">
					<a href="<?= $song; ?>">
						<?= basename($song); ?>
					</a>
					(<?= (int) (filesize($song) / 1024); ?> KB) <br />
					<audio controls>
				        <source src="<?= $song; ?>" type="audio/mpeg">
				        Your browser does not support the audio element.
			        </audio>
				</li>
			<?php } ?>
			
			<?php foreach (glob("assets/*.m3u") as $playlist) { ?>
				<li class="playlistitem">
					<?= basename($playlist); ?>:
						<ul>
							<?php
							foreach (file($playlist, FILE_IGNORE_NEW_LINES) as $line) {
								if (strpos($line, "#") === FALSE) { ?>
									<li> <?= $line; ?> </li>
								<?php }
							}
							?>
						</ul>
				</li>
			<?php } ?>
		</ul>
	</div>
</html>