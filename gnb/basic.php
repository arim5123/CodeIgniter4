<?php
$menu_gnb1 = "";
$menu_gnb2 = "";
$menu_gnb3 = "";

$var = uri_string();

if( preg_match("/gallery_view/", $var) ){
    $arr = explode("/", $var);
    $num = $arr[3];
}

switch ($var) {

    case "sub/sub01"                                   :   $menu_gnb1 = "on"; break;
    case "sub/sub01/notice"                            :   $menu_gnb1 = "on"; break;

    case "sub/sub02/schedule"                          :   $menu_gnb2 = "on"; break;

    case "sub/sub03/gallery"                           :   $menu_gnb3 = "on"; break;
    case "sub/sub03/gallery_view/$num"                 :   $menu_gnb3 = "on"; break;
}
?>

<nav>
  <ul class="gnb_list">
    <li class="<?=$menu_gnb1?>"><a href="/sub/sub01/notice">000</a></li>
    <li class="<?=$menu_gnb2?>"><a href="/sub/sub02/schedule">000</a></li>
    <li class="<?=$menu_gnb3?>"><a href="/sub/sub03/gallery">000</a></li>
  </ul>
</nav>
