<?php
$content = '{"time": '.time().',"message": null,"retry": null}';
$fp = fopen(dirname(__FILE__) . "/../../storage/framework/down","wb");
fwrite($fp,$content);
fclose($fp);
echo 'now website is maintenance!';
die;