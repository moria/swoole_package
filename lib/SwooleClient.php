<?php
/**
 * SwooleClient.php
 *
 * author: jayli
 * createtime: 2014-10-20
 * history:
 *
 */

class SwooleClient {
    
    private $_client = null;
    
    private $_server = array();
    
    private $_type = '';
    
    private $_mode = '';
    
    public function __construct($businessKey) {
        require dirname(__FILE__) . '/../conf/client_conf.php';
        if (array_key_exists($businessKey, $cli_conf)) {
            $servers = $cli_conf[$businessKey]['servers'];
            shuffle($servers);
            $this->_server = current($servers);
            $this->_type = $cli_conf[$businessKey]['type'];
            $this->_mode = $cli_conf[$businessKey]['mode'];
            $this->_client = new swoole_client($this->_type,$this->_mode);
            if (!$this->_client->connect($this->_server['ip'],$this->_server['port'])) {
                unset($this->_client);
                $this->_client = null;
            }
        }
    }
            
    public function send($data) {
        if ($this->_client && $this->_client->isConnected()) {
            if (!$this->_client->send($data)) {
                throw new Exception('send data error', $this->_client->errCode);
            }
        } else {
            throw new Exception('no client connected.', 10000);
        }
    }
    
    public function recv($size=65535, $waitAll=FALSE) {
        if ($this->_client && $this->_client->isConnected()) {
            if (!$waitAll) {
                $waitAll = 0;
            }
            $ret = $this->_client->recv($size,$waitAll);
            if (!$ret) {
                throw new Exception('receive data from server error', $this->_client->errCode);
            } else {
                return $ret;
            }
        } else {
            throw new Exception('no client connected.', 10000);
        }
    }
    
    private function _reconnect() {
        if (!$this->_client) {
            return FALSE;
        }
        if (!$this->_client->isConnected()) {
            if (!$this->_client->connect($this->_server['ip'],$this->_server['port'])) {
                unset($this->_client);
                $this->_client = null;
                return FALSE;
            } else {
                return TRUE;
            }   
        } else {
            return TRUE;
        }
    }
}












//end of script
