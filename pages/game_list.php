<div class="div-border rounded-corner div-shadow div-content">
      <h1>Games & More:</h1>
<?php
$price_collums="steam_price,humble_price";
$game_price=$database->sql_select("bot_gamelist LEFT JOIN bot_gamelist_video ON bot_gamelist.name=bot_gamelist_video.name","bot_gamelist.*, bot_gamelist_video.count_video,
GREATEST(".$price_collums.") AS max_price,
LEAST(".$price_collums.") AS min_price,
(GREATEST(".$price_collums.")-LEAST(".$price_collums.")) AS diff_price
","description NOT LIKE '' AND steam_price>0 AND (bot_gamelist_video.channel IS NULL OR bot_gamelist_video.channel='".$SYTH['user']['youtube_user']."')
ORDER BY CAST(bot_gamelist_video.count_video AS UNSIGNED) DESC, diff_price DESC",true);

for ($count_games=0;$count_games<count($game_price);$count_games++) {
      $tg=$game_price[$count_games];
?>
      <div class="div-border rounded-corner div-shadow div-content">
            <img src="<?php echo $tg['banner']; ?>" alt="<?php echo $tg['name']; ?>"><br>
            <?php echo $tg['name']; ?><br>
            <?php echo $tg['min_price']; ?>€ - <?php echo $tg['max_price']; ?>€<br>
            <?php echo $tg['count_video']; ?> Videos<br>
      </div>
<?php
}
/*
echo '<pre>';
var_dump($game_price);
echo '</pre>';
*/
?>
</div>