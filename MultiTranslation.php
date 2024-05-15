<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<script language="Javascript">
function hbsubmit(){
document.form1.target="weblio";
document.form1.action="weblio.php";
document.form1.submit();
document.form1.target="kotobank";
document.form1.action="kotobank.php";
document.form1.submit();
document.form1.target="goo";
document.form1.action="goo.php";
document.form1.submit();
}
</script>
</head>
<body>
  <form action="" name="form1" method="GET" target="weblio">
    請輸入要查詢的日文單字(例：へそ、駆引き、一押し...)：<input type=text name="word">
    <input type="button" name="Submit" value="查詢" onClick="hbsubmit()">
    <input type="button" onClick="location.reload()" value="清除">
  </form>
  <form action="MultiTranslation.php" name="form2" method="GET">
    請輸入您要儲存的單字及解釋：
    <input type=text name="word2">
    <input type=submit name="save" value="儲存">&nbsp;
    <input type=submit name="delete" value="刪除">&nbsp;
    <input type=submit name="echo" value="顯示記事本">
    <br>
    (功能：要使用儲存請在單字框輸入單字後再於下方框加入想要的解釋即可、要使用刪除功能請在單字欄輸入要刪除的單字同時在下方框中輸入"d"、要顯示全部單字請在單字欄輸入"*")
    <br>
    <textarea name="content" cols="150" rows="5" wrap="hard" style="font-size:16px;"></textarea>
  </form>
<!--
  <p>
    <hr>
    使用說明(中文)：<br>
    看到不懂的日文單字，輸入到上面的框框，下方的三個框架中會分別列出不同日文辭典網站的解釋！<br>
    <hr>
    使用説明(日本語)：<br>
    分からない言葉があるなら、ここで入力或はコピペしてください...と言いたいが...<br>
    日本語読める人ならたぶん説明不要。5chで使う言葉はここで貼らないでください。
    <hr>
  </p>
-->
  <iframe src="kotobank.php" name="kotobank" width="450" height="600" frameborder="1" bordercolor="#0A0A0A">
  </iframe>

  <iframe src="goo.php" name="goo" width="800" height="600" frameborder="1" bordercolor="#0A0A0A">
  </iframe>

  <iframe src="weblio.php" name="weblio" width="1260" height="600" frameborder="1" bordercolor="#0A0A0A">
  </iframe>

  <br/>
  <hr>

</body>
</html>

<?php

  ini_set("display_error", "On");
  header("Content-Type:text/html; charset=utf-8");

  if( $_GET['content']=="d" )
  {
    $word = $_GET['word2'];
    echo "您刪除的單字為".$word, "<br>";

    $con = mysqli_connect("localhost", "root", "0000");

    mysqli_select_db($con, "notebook");
    mysqli_query($con, "set names utf8");

    $sql ="DELETE FROM words WHERE word = '$word';";  //刪除資料
    mysqli_query($con,$sql);
    mysql_close($con);
  }

  else if( !empty($_GET['word2']) && !empty($_GET['content']) )
  {
    $word = $_GET['word2'];
    $content = $_GET['content'];
    echo "您儲存的單字為".$word, "<br>";

    $con = mysqli_connect("localhost", "root", "0000");

    mysqli_select_db($con, "notebook");
    mysqli_query($con, "set names utf8");

    $sql ="INSERT INTO words (id,word,content)  VALUES ( NULL ,'$_GET[word2]','$_GET[content]')";  //新增資料
    mysqli_query($con,$sql);
    mysql_close($con);
  }

  else if( empty($_GET['content']) )
  {
    $word = $_GET['word2'];
    if($word == "*")
    {
      $sql = "Select * from words";
    }
    else
    {
      $sql = "Select * from words where word='$word'";
    }

    $con = mysqli_connect("localhost", "root", "0000");
    mysqli_select_db($con, "notebook");
    mysqli_query($con, "set names utf8");

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result))
    {
      $show = $row['word'];
      $show = $show." ： ".$row['content'];

      echo "<br/>";
      echo $show;
      echo "<br/>";
    }
    mysql_close($con);
  }

?>
