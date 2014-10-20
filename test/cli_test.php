<?php
/**
 * cli_test.php
 *
 * author: jayli
 * createtime: 2014-10-20
 * history:
 *
 */

define('ROOT_PATH', dirname(__FILE__));

require ROOT_PATH . "/../lib/SwooleClient.php";

$i = 10;
while($i > 0) {
    $i--;
    $cli = new SwooleClient('my_business_key');
    
    $cli->send('hello jay!');
    
    try{
        $ret = $cli->recv();
    } catch (Exception $e) {
        var_dump($e);    
    }
    
    var_dump($ret);
}

exit;