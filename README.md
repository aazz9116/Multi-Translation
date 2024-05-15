# Multi-Translation<br>
大三網頁與資料庫實作期末專案<br>
主要用於查詢日文單字的解釋，在文字框輸入日文單字後，會分別在三個框架顯示出不同網站的查詢結果。<br>
※コトバンク、goo辞書已無法使用<br>
<br>
# 使用工具<br>
HeidiSQL、UniServerZ(for start MySQL & Apache)、Atom<br>
<br>
# 筆記 2018.06.13<br>
這個網站主要是用於查詢日文單字的解釋，在文字框輸入日文單字後，會分別在三個框架顯示出不同網站的查詢結果。但其實開三個不同網站的分頁來搜尋就可以了，單純視覺上比較方便...吧。<br>
最一開始本來只是要做一個傳值進去會跑出Google翻譯結果這樣的一個繞一大圈而且一點意義都沒有的php，但是怎麼不管怎麼寫，Google跟yahoo都無法在內嵌框架顯示，所以才改成寫現在這個。<br>
因為我平常上網九成時間都泡在日文網站，偶爾出現一兩個不懂的單字時就會想去查它的日文解釋，在這個專案中用的コトバンク、goo、weblio是我比較常使用的網站，所以就決定以這三個網站為基礎來製作。<br>
<br>
製作流程：<br>
首先從架構，做出html後再裡面設好文字框、查詢&清除按鈕，然後設置三個框架來分別顯示不同網站。<br>
一開始遇到的難題是為了要實現一次傳值到3個php，我查到的方法是先將form表單語法中的action="???.php"，從原本只指向一個php改成都不指向，然後在查詢按鈕新增onclick事件，在裡面寫一個函數直接寫三個action指向三個網站。<br>
再來是如何在三個框架中顯示查詢結果。在使用這些辭典網站時，甚至像是Google翻譯或是Yahoo字典，大部分會有一個共通點就是在輸入查詢的單字後，網站的url中會加入所輸入的單字，例如Google翻譯的變化是<br>
<br>
原本<br>
https://translate.google.com.tw/?hl=zh-TW&tab=wT&authuser=0<br>
在框內輸入"人間"後變成<br>
https://translate.google.com.tw/?hl=zh-TW&tab=wT&authuser=0#ja/zh-TW/人間<br>
<br>
也就是說要顯示出查詢網址，只要將搜尋前的網址加上傳進來的搜尋字串，就可以導出查詢結果的網址。<br>
所以接下來的步驟是在三個php中各別創建需要用到的url字串，然後再用GET得到輸入的字串並添加到url。<br>
為了確認是否有正確添加字串進去，在一開始有echo在各別的框架中做確認。<br>
再來如何再將php導向到新url字串的網站，在這裡用「window.location.href='$url'+'GET到的字串'」這行JavaScript，讓php直接跳到新的網站。<br>
我在這裡遇到的第二個難題是，明明有確認GET字串有新增到url，新增後的url貼到瀏覽器也可以導到該網站，但三個框架中還是沒有顯示任何內容，起初以為是JavaScript的問題，迂迴了老半天也沒有任何結果。<br>
後來才發現，瀏覽器上所讀取的url中的中文日文都是經過轉換成utf8編碼的<br>
例如剛才的<br>
https://translate.google.com.tw/?hl=zh-TW&tab=wT&authuser=0#ja/zh-TW/人間<br>
實際上是<br>
https://translate.google.com.tw/?hl=zh-TW&tab=wT&authuser=0#ja/zh-TW/%E4%BA%BA%E9%96%93<br>
呈現在網址列上<br>
所以必須要先將GET到的字串，利用urlencode方法轉換成url用的編碼字串，再加進去url中。<br>
最後再做些排版加上說明文就完成...應該只能算是半成品。<br>
在網站中的圖片在不做商業或廣告用途時是允許被使用的。<br>
原本要做但力不從心的有：n秒後再跳轉、真正的清除按鈕(其實那個清除只是單純的重新整理)
