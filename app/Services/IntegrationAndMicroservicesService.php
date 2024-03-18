<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class IntegrationAndMicroservicesService
{
    public function sendMessage()
    {
        
        $connection = new AMQPStreamConnection(
            config('rabbitmq.host'),
            config('rabbitmq.port'),
            config('rabbitmq.user'),
            config('rabbitmq.pass'),
            config('rabbitmq.vhost')
        );

        $channel = $connection->channel();
        
        $queueName = 'mensagem_unico';
        $channel->queue_declare($queueName, false, true, false, false);

        $uniqueId = uniqid();
        $messageBody = 'Mensagem com identificador único: ' . $uniqueId;
        $message = new AMQPMessage($messageBody, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);

        $channel->basic_publish($message, '', $queueName);

        echo "Mensagem enviada com identificador único: $uniqueId\n";

        $channel->close();
        $connection->close();
    }
}
