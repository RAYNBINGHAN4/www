<?php
header('Content-Type: text/html;charset=utf-8');

$name = 'ˮ���LOGO@file';
$name = '��طɸ�@radio|1=12&0=������?';

preg_match("/@([a-z]*)\|?/",$name,$result);

echo '<pre>';
var_dump($result);

echo '<hr/>';
var_dump($result[1]);