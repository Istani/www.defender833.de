<?php
//youtube_playlist_lastentry
$database->sql_exec("CREATE TEMPORARY TABLE youtube_playlist_lastentry AS
  SELECT youtube_videos.youtube_snippet_channelid AS channel_id, youtube_playlists.youtube_id AS playlist_id, MAX(youtube_videos.youtube_snippet_publishedat) AS last_publish, AVG(youtube_videos.youtube_statistics_viewcount/youtube_videos.youtube_statistics_likecount) AS factor
  FROM youtube_playlists INNER JOIN (youtube_playlists_items INNER JOIN youtube_videos ON youtube_playlists_items.youtube_snippet_resourceid_videoid=youtube_videos.youtube_id) ON youtube_playlists.youtube_id=youtube_playlists_items.youtube_snippet_playlistid
  WHERE youtube_videos.youtube_status_uploadstatus LIKE 'processed'
  GROUP BY youtube_videos.youtube_snippet_channelid, youtube_playlists.youtube_id
  ORDER BY last_publish DESC, factor DESC");
  
  $SYTH['playlists_overview']=$database->sql_select("youtube_playlist_lastentry","*","channel_id LIKE '".$SYTH['youtube_channel']['youtube_id']."'");
  
  if (count($SYTH['playlists_overview'])==0) {
    ?>
    <div class="div-border rounded-corner div-shadow div-content">
      <h1>My Videos:</h1>
      Kein Video gefunden!
    </div>
    <?php
  } else {
    $output_playlist=0;
    for ($count_playlists=0;$count_playlists<count($SYTH['playlists_overview']);$count_playlists++) {
      if ($output_playlist>=10) {
        break;
      }
      if ($SYTH['playlists_overview'][$count_playlists]['playlist_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_likes']) {
        continue;
      }
      if ($SYTH['playlists_overview'][$count_playlists]['playlist_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_favorites']) {
        continue;
      }
      if ($SYTH['playlists_overview'][$count_playlists]['playlist_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_uploads']) {
        continue;
      }
      if ($SYTH['playlists_overview'][$count_playlists]['playlist_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_watchhistory']) {
        continue;
      }
      if ($SYTH['playlists_overview'][$count_playlists]['playlist_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_watchlater']) {
        continue;
      }
      
      $output_playlist++;
      $this_playlist=$database->sql_select("youtube_playlists","*","youtube_playlists.youtube_id LIKE '".$SYTH['playlists_overview'][$count_playlists]['playlist_id']."'")[0];
      ?>
      <div class="div-border rounded-corner div-shadow div-content">
        <h1><?php echo $this_playlist['youtube_snippet_title']; ?></h1>
        <?php
        $this_video_list=$database->sql_select("youtube_playlists_items INNER JOIN youtube_videos ON youtube_playlists_items.youtube_snippet_resourceid_videoid=youtube_videos.youtube_id", "youtube_videos.*", "youtube_playlists_items.youtube_snippet_playlistid LIKE '".$SYTH['playlists_overview'][$count_playlists]['playlist_id']."' AND youtube_videos.youtube_status_uploadstatus LIKE 'processed' ORDER BY youtube_videos.youtube_snippet_publishedat DESC");
        echo '<br>';
        echo '<table>';
        echo '<tr>';
        
        for ($count_video=0;$count_video<8;$count_video++) {
          echo '<td style="width:130px;"> &nbsp; ';
          if (isset($this_video_list[$count_video])) {
            echo '<a href="">';
            echo '<img src="'.$this_video_list[$count_video]['youtube_snippet_thumbnails_default_url'].'" alt="'.$this_video_list[$count_video]['youtube_snippet_title'].'">';// 	youtube_snippet_thumbnails_default_url
            echo '</a>';
          }
          echo '</td>';
        }
        echo '</tr>';
        echo '</table>';
        echo '<br>';
        ?>
      </div>
      <br>
      <?php
    }
    ?>
    <div class="div-border rounded-corner div-shadow div-content">
      <h1>Und Mehr!</h1>
      Und mehr auf meinem Kanal!<br>
      <a href="https://www.youtube.com/<?php echo $SYTH['youtube_channel']['youtube_snippet_customurl']; ?>"><?php echo "https://www.youtube.com/".$SYTH['youtube_channel']['youtube_snippet_customurl']; ?></a><br>
      <br>
    </div>
    <?php
  }
  ?>
