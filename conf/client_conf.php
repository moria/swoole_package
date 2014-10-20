<?php
/**
 * client_conf.php
 *
 * author: jayli
 * createtime: 2014-10-20
 * history:
 *
 */

$cli_conf = array(
    'my_business_key' => array(
        'servers' => array(
            array(
                'ip' => '127.0.0.1',
                'port' => '9000',
            )
        ),
        'type' => SWOOLE_SOCK_TCP,     // SWOOLE_SOCK_TCP,SWOOLE_SOCK_TCP6         
        'mode' => SWOOLE_SOCK_SYNC,    // SWOOLE_SOCK_SYNC,SWOOLE_SOCK_ASYNC  
    ),        
);