<?php
  ini_set("display_errors", "On");
  header("Content-Type:text/html; charset=utf-8");
  ini_set("display_errors", "On");

  $url = "https://www.weblio.jp/content/";

  error_reporting(E_ALL || ~E_NOTICE);

  if( $_GET["word"] != null )
  {
    echo $url;
    echo $_GET["word"], "<br>";

    $wordcode = urlencode($_GET["word"]);

    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'+'$wordcode'";
    echo "</script>";

  }
  else
  {
    echo "<img src=weblio.png>", "<br>", "<br>";
    echo "在此會顯示 weblio辞書 的搜尋結果";
  }
?>
