<?php
  ini_set("display_errors", "On");
  header("Content-Type:text/html; charset=utf-8");
  ini_set("display_errors", "On");

  $url1 = "https://dictionary.goo.ne.jp/srch/all/";
  $url2 = "/m0u/";

  error_reporting(E_ALL || ~E_NOTICE);

  if( $_GET["word"] != null )
  {
    echo $url1;
    echo $_GET["word"];
    echo $url2, "<br>";

    $wordcode = urlencode($_GET["word"]);
    //先將字串轉換成網址用的utf8編碼

    echo "<script type='text/javascript'>";
    echo "window.location.href='$url1'+'$wordcode'+'$url2'";
    echo "</script>";
  }
  else
  {
    header("Content-Type:text/html; charset=utf-8");
    ini_set("display_errors", "On");

    $str = "看到這則訊息";
    $str2 = "代表你還沒搜尋...";
    $str3 = "順帶一提";
    $str4 = "這些網站";
    $str5 = "不是翻譯器...";
    $str6 = "所以查不到的字";
    $str7 = "還是查不到的...";
    $str8 = "在此會顯示 goo辞書 的搜尋結果";
    $image = imagecreatefrompng("re01.png");
    $black = imagecolorallocate($image, 0, 0, 0);

    imagettftext($image,36,0,90,80, $black,"C:\Windows\Fonts\kaiu.ttf", $str);
    imagettftext($image,36,0,90,130, $black,"C:\Windows\Fonts\kaiu.ttf", $str2);
    imagettftext($image,36,0,90,200, $black,"C:\Windows\Fonts\kaiu.ttf", $str3);
    imagettftext($image,36,0,90,250, $black,"C:\Windows\Fonts\kaiu.ttf", $str4);
    imagettftext($image,36,0,90,300, $black,"C:\Windows\Fonts\kaiu.ttf", $str5);
    imagettftext($image,36,0,100,370, $black,"C:\Windows\Fonts\kaiu.ttf", $str6);
    imagettftext($image,36,0,100,420, $black,"C:\Windows\Fonts\kaiu.ttf", $str7);
    imagettftext($image,18,0,110,480, $black,"C:\Windows\Fonts\kaiu.ttf", $str8);

    header("Content-type: image/png");
    imagepng($image);
    imagedestroy($image);
  }

?>
