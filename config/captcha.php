<?php
session_Start();
$captcha=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"),0,6);
$_SESSION['captcha']=$captcha;

$gambar=ImageCreate(60,20);
$wk=ImageColorAllocate($gambar, 255, 100, 173);
$wt=ImageColorAllocate($gambar, 255, 255, 255);
ImageFilledRectangle($gambar, 0, 0, 50, 20, $wk);
ImageString($gambar, 10, 3, 3, $captcha, $wt);
ImageJPEG($gambar);
?>