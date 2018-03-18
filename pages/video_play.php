<?php
$this_video=$database->sql_select("youtube_videos","*","youtube_id LIKE '".$_GET['details']."'")[0];
$video_temp_playlists=$database->sql_select("youtube_playlists_items INNER JOIN youtube_playlists ON youtube_playlists.youtube_id = youtube_playlists_items.youtube_snippet_playlistid","youtube_playlists.*","youtube_snippet_resourceid_videoid LIKE '".$_GET['details']."'");

for ($count_playlists=0;$count_playlists<count($video_temp_playlists);$count_playlists++) {
  if ($video_temp_playlists[$count_playlists]['youtube_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_likes']) {
    continue;
  }
  if ($video_temp_playlists[$count_playlists]['youtube_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_favorites']) {
    continue;
  }
  if ($video_temp_playlists[$count_playlists]['youtube_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_uploads']) {
    continue;
  }
  if ($video_temp_playlists[$count_playlists]['youtube_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_watchhistory']) {
    continue;
  }
  if ($video_temp_playlists[$count_playlists]['youtube_id']==$SYTH['youtube_channel']['youtube_contentdetails_relatedplaylists_watchlater']) {
    continue;
  }
  $video_playlists[]=$video_temp_playlists[$count_playlists];
}

// "http://www.youtube.com/v/'.$this_video['youtube_id'].'?rel=0&autoplay=1&loop=1&playlist='.$video_playlists[0]['youtube_id'].'"
?>
<div class="div-border rounded-corner div-shadow div-content">
  <h1><?php echo $this_video['youtube_snippet_title']; ?></h1>
  <table width="100%">
    <tr>
      <td style="width: 300px; padding:10px;">
        <br>
        <div class="div-border rounded-corner">
          <h2>Weitere Vidoes:</h2>
          <ul class="playlist">
            <?php
            for ($count_playlists=0;$count_playlists<count($video_playlists); $count_playlists++) {
              $videos_for_playlist=$database->sql_select("youtube_playlists_items INNER JOIN youtube_videos ON youtube_playlists_items.youtube_snippet_resourceid_videoid=youtube_videos.youtube_id","youtube_playlists_items.youtube_snippet_position, youtube_videos.*", "youtube_playlists_items.youtube_snippet_playlistid LIKE '".$video_playlists[$count_playlists]['youtube_id']."' ORDER BY CAST(youtube_playlists_items.youtube_snippet_position AS UNSIGNED)");
              for ($count_video=0;$count_video<count($videos_for_playlist);$count_video++) {
                $playlist_video=$videos_for_playlist[$count_video];
                
                if ($playlist_video['youtube_id']==$this_video['youtube_id']) {
                  echo '<li class="playlist active">';
                } else {
                  echo '<li class="playlist">';
                }
                //echo $playlist_video['youtube_snippet_position'];
                echo '<a href="'.$site['base_dir'].'Video/'.$playlist_video['youtube_id'].'">';
                echo '<center>';
                echo '<img src="'.$playlist_video['youtube_snippet_thumbnails_default_url'].'" alt="'.$playlist_video['youtube_snippet_title'].'">';// 	youtube_snippet_thumbnails_default_url
                
                echo '</center>';
                echo $playlist_video['youtube_snippet_title'].'';
                echo '</a>';
                echo '</li>';
              }
            }
            ?>
          </ul>
        </div>
      </td>
      <td>
        <center>
          <iframe width="730" height="411" src="
          <?php
          echo 'http://www.youtube.com/embed/'.$this_video['youtube_id'].'?rel=0&autoplay=1&loop=1&playlist='.$video_playlists[0]['youtube_id'];
          ?>
          " frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </center>
        <br>
        <?php echo nl2br($this_video['youtube_snippet_description']); ?>
      </td>
    </tr>
  </table>
  <br>
</div>
