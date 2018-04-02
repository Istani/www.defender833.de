<?php
    $_GET['details']=str_replace("_"," ", $_GET['details']);
    $this_game=$database->sql_select("bot_gamelist","*","name = '".$_GET['details']."'")[0];
    //echo "name = '".$_GET['details']."'";
?>
<div class="div-border rounded-corner div-shadow div-content">
    <h1><?php echo $this_game['name']; ?></h1>
    <table width="100%">
        <tr>
            <td width="99%">
                <?php
                    $show_video=$database->sql_select("youtube_videos","*", 
                    "youtube_snippet_channelid='".$SYTH['user']['youtube_user']."' 
                    AND youtube_snippet_title LIKE '%".$_GET['details']."%'
                    AND youtube_snippet_title LIKE '%#5MM%'
                    AND youtube_status_uploadstatus='processed'
                    AND youtube_status_privacystatus='public'
                    ORDER BY simple_publishtimestamp
                    LIMIT 1", true)[0];
                    if ($show_video['youtube_id']=="") {
                        $show_video=$database->sql_select("youtube_videos","*", 
                        "youtube_snippet_channelid='".$SYTH['user']['youtube_user']."' 
                        AND youtube_snippet_title LIKE '%".$_GET['details']."%'
                        AND youtube_status_uploadstatus='processed'
                        AND youtube_status_privacystatus='public'
                        ORDER BY (youtube_statistics_likecount+youtube_statistics_dislikecount+youtube_statistics_commentcount) DESC
                        LIMIT 1", true)[0];
                    }
                    if ($show_video['youtube_id']!="") {
                        ?>
                <center>
                    <iframe width="597" height="334" src="
                        <?php
                                echo 'http://www.youtube.com/embed/'.$show_video['youtube_id'].'?rel=0&autoplay=1&loop=1';
                        ?>
                    " frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe><br>&nbsp;<br>
                </center>
                    <?php
                    }
                ?>
                &nbsp;
                <br>
                <?php echo $this_game['description']; ?>
                &nbsp;
            </td>
            <td class="div-border">
                <img src="<?php echo $this_game['banner']; ?>" alt="<?php echo $this_game['name']; ?>"><br>
                <h2>Kaufe das Spiel hier:</h2>
                <a href="http://store.steampowered.com/app/<?php echo $this_game['steam_id']; ?>" class="link">
                <div class="steam div-border"><span width="100%" style="float:right"><?php echo $this_game['steam_price']; ?>&nbsp;€</span><span>Steam</span></div>
                </a>
                <a href="<?php echo $this_game['humble_link']; ?>?partner=<?php echo $SYTH['user']['partner_humble']; ?>" class="link">
                <div class="humble div-border"><span width="100%" style="float:right"><?php echo $this_game['humble_price']; ?>&nbsp;€</span><span>Humble Bundle</span></div>
                </a>
                <?php
                    $amazon_links=$database->sql_select("bot_game_amazon", "*", "game_name like '".$this_game['name']."' AND link NOT LIKE '' AND `ignore`=0 ORDER BY score DESC, text");
                    if (count($amazon_links)>0) {
                        echo "<h2>&nbsp;</h2>";

                        for ($count_amazon=0;$count_amazon<count($amazon_links);$count_amazon++) {
                            $ca=$amazon_links[$count_amazon];
                            $ca['link']=str_replace("istani0815-21", $SYTH['user']['partner_amazon'], $ca['link']);
                            while (strlen($ca['text'])>70) {
                                $parts=explode(" ",$ca['text']);
                                unset($parts[count($parts)-1]);
                                $ca['text']=implode(" ",$parts);
                                unset($parts);
                            }
                            echo '<a href="'.$ca['link'].'" class="link">';
                            echo '<div class="amazon div-border"><span>'.$ca['text'].'</span></div>';
                            echo '</a>';
                        }
                    }   
                    $show_videos=$database->sql_select("youtube_videos","*", 
                    "youtube_snippet_channelid='".$SYTH['user']['youtube_user']."' 
                    AND youtube_snippet_title LIKE '%".$_GET['details']."%'
                    AND youtube_status_uploadstatus='processed'
                    AND youtube_status_privacystatus='public'
                    ORDER BY simple_publishtimestamp");
                    if (count($show_videos)>0) {
                        echo "<h2>Alle Videos zum Spiel:</h2>";
                        for ($count_videos=0;$count_videos<count($show_videos);$count_videos++) {
                            $tg=$show_videos[$count_videos];
                            echo '<a href="'.$site['base_dir'].'Video/'.$tg['youtube_id'].'" class="link">';
                            ?>
                            <div class="defender div-border"><span><?php echo $tg['youtube_snippet_title'] ; ?></span></div>
                            </a>
                            <?php
                        }

                    }
                ?>
                
            </td>
        </tr>
    </table>
</div>