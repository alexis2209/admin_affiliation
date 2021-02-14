<?php


namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;


class UpdateProductService  implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;
        //var_dump($body);

        $response = json_decode($msg->body, true);

        //$type = $response["Type"];
    }
}