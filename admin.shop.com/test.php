<?php
header('Content-Type: text/html;charset=utf-8');

$name = '水电费LOGO@file';
$name = '大地飞歌@radio|1=12&0=问任务?';

preg_match("/@([a-z]*)\|?/",$name,$result);

echo '<pre>';
var_dump($result);

echo '<hr/>';
var_dump($result[1]);