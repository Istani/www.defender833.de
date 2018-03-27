<div class="div-border rounded-corner div-shadow div-content">
      <h1>Games & More:</h1>
<?php
$price_collums="steam_price,humble_price";
$game_price=$database->sql_select("bot_gamelist","*, 
GREATEST(".$price_collums.") AS max_price,
LEAST(".$price_collums.") AS min_price,
(GREATEST(".$price_collums.")-LEAST(".$price_collums.")) AS diff_price
","description NOT LIKE '' AND steam_price>0 
ORDER BY diff_price DESC",true);

echo '<pre>';
var_dump($game_price);
echo '</pre>';
?>
</div>