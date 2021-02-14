<?php


namespace App\Consumer;

use App\Producer\ParseFiles;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;


class DownloadService  implements ConsumerInterface
{

    public function __construct(LoggerInterface $logger, ParseFiles $producer)
    {
        $this->producer = $producer;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;
        //var_dump($body);

        $response = json_decode($msg->body, true);
        $newFileName = $response['site'].$response['type'].$response['brand'];
        $file = $this->downloadFile($newFileName, $response['file']);

        if (file_exists($file)) {
            $msg = array('site' =>  $response['site'], 'type' => $response['type'], 'brand' => $response['brand'], 'file' => $file, 'import' => $response['import']);
            $this->producer->publish(json_encode($msg));
        } else {
            exit();
        }
    }


    public function downloadFile($newFileName, $file){
        $fileC = "/tmp/".$newFileName.".xml.gz";
        file_put_contents($fileC, fopen($file, 'r'));
        return $fileC;
    }
}