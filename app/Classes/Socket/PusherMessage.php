<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 04.04.18
 * Time: 11:14
 */

namespace App\Classes\Socket;

use ZMQContext;

class PusherMessage extends PusherBase
{
    static function sendDataToServer(array $data) {
        $context = new ZMQContext();
        try {
            $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'pusher_message');
            $socket->connect("tcp://127.0.0.1:5555");
        } catch (\ZMQSocketException $e) {

        }
        $data = json_encode($data);
        $socket->send($data);
    }

    public function broadcast($jsonToSend) {
        $data = json_decode($jsonToSend, true);
        $subscribe = $this->getSubscribedTopics();
        if (isset($subscribe[$data['topic_id']])) {
            $topic = $subscribe[$data['topic_id']];
            $topic->broadcast($data);
        }
    }
}