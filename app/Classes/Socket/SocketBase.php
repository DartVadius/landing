<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 02.04.18
 * Time: 16:25
 */

namespace App\Classes\Socket;


use Ratchet\WebSocket\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SocketBase implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn) {
    }

    public function onMessage(ConnectionInterface $from, $msg) {
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }

}