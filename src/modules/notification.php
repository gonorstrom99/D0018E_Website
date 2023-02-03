<?php
global $notifications;
$notifications = array();

function add_notification($content, $type = null, $is_light = false): void
{
  global $notifications;
  $notifications[] = array(
    "type" => $type,
    "content" => $content,
    "is_light" => $is_light);
}

function echo_notification(): void
{
  global $notifications;
  foreach ($notifications as $n) {
    $type = $n["type"];
    $content = $n["content"];
    $is_light = $n["is_light"];

    echo "<div class='notification".
      ($type != null ? " is-".$type : "") .
      ($is_light ? " is-light" : "") .
      "'><button class='delete'></button>".$content."</div>";
  }
}
