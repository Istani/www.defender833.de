<div class="div-border rounded-corner div-shadow div-content">
      <h1>Games & More:</h1>
<?php

$game_price=$database->sql_select("bot_gamelist","*, 
GREATEST(steam_price,humble_price) AS max_price,
LEAST(steam_price,humble_price) AS min_price
","true",true);

echo '<pre>';
var_dump($game_price);
echo '</pre>';
?>
</div>