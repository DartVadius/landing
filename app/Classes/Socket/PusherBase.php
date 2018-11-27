<?php
/**
 * Created by PhpStorm.
 * User: vad
 * Date: 04.04.18
 * Time: 10:59
 */

namespace App\Classes\Socket;


use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class PusherBase implements WampServerInterface
{

    protected $subscribedTopics = [];

    public function getSubscribedTopics() {
        return $this->subscribedTopics;
    }

    public function addSubscribedTopics($topic) {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribedTopics($topic);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection established " . $conn->resourceId . "\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection closed " . $conn->resourceId . "\n";
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error! " . $e->getMessage();
        $conn->close();
    }
}