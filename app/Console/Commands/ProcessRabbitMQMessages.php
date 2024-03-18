<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ProcessRabbitMQMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from RabbitMQ queue';

    /**
     * Execute the console command.
     */
    public function handle()
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

        echo "Aguardando mensagens. Para sair, pressione CTRL+C\n";

        $callback = function ($message) {
            echo 'Mensagem recebida: ', $message->body, "\n";
            usleep(200000); // Espera de 200ms (simulação)
            echo "Mensagem processada.\n";

            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
        };

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume($queueName, '', false, false, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
