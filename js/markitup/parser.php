<?php
// ----------------------------------------------------------------------------
// markItUp! BBCode Parser
// v 1.0.6
// Dual licensed under the MIT and GPL licenses.
// ----------------------------------------------------------------------------
// Copyright (C) 2009 Jay Salvat
// http://www.jaysalvat.com/
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
// 
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
// 
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
// ----------------------------------------------------------------------------
// Thanks to Arialdo Martini, Mustafa Dindar for feedbacks.
// ----------------------------------------------------------------------------

function converttohtml($text){
    $text = nl2br(htmlspecialchars($text));
    $bbcode = array("\[spoiler=(.*?)\](.*?)\[\/spoiler\]"=>"<span class='spoiler'>$1</span><p>$2</p>","\[zoombox\](.*?)\[\/zoombox\]"=>"<div class='zoombox'>$1</div>","\[html\](.*?)\[\/html\]"=>"$1","\[centre\](.*?)\[\/centre\]"=>"<center>$1</center>","\[b\](.*?)\[\/b\]"=>"<strong>$1</strong>","\[i\](.*?)\[\/i\]"=>"<em>$1</em>",
                    "\[u\](.*?)\[\/u\]"=>"<u>$1</u>","\[img\](.*?)\[\/img\]"=>"<img src='$1' />","\[url=(.*?)\](.*?)\[\/url\]"=>"<a href='$1'>$2</a>",
                    "\[size=(.*?)\](.*?)\[\/size\]"=>'<span style="font-size:$1%">$2</span>',"\[color=(.*?)\](.*?)\[\/color\]"=>'<span style="color:$1">$2</span>',
                    "\[quote\](.*?)\[\/quote\]"=>"<blockquote>$1</blockquote>","\[list\=(.*?)\](.*?)\[\/list\]"=>"<ol start='$1'>$2</ol>","\[list\](.*?)\[\/list\]"=>"<ul>$1</ul>",
                    "\[\*\]\s?(.*?)\n"=>"<li>$1</li>","\[code=(.*?)\](.*?)\[\/code\]"=>"<pre class='code' lang='$1'>$2</pre>","\[droite\](.*?)\[\/droite\]"=>"<div style='float:right'>$1</div>","\[gauche\](.*?)\[\/gauche\]"=>"<div style='float:left'>$1</div>");
        foreach($bbcode as $k=>$v){
            if($k == "\[html\](.*?)\[\/html\]"){
              $text = str_replace("&lt;", "<", $text);
              $text = str_replace("&gt;", ">", $text);
              $text = str_replace("&amp;", "&", $text);
              $text = str_replace("&quot;", '"', $text);
              $text = str_replace("&#039;", "'", $text);
              $text = preg_replace('/'.$k.'/ms',"<div class='html'>".$v."</div>",$text);
          }
            else{
              $text = preg_replace('/'.$k.'/ms',$v,$text);
          }
        }
        return $text;
}
echo converttohtml($_POST["data"])
?>