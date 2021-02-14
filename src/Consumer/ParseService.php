<?php


namespace App\Consumer;

use App\Producer\CheckProducts;
use App\Entity\Product;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use App\Repository\WebsiteRepository;
use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;


class ParseService  implements ConsumerInterface
{
    public function __construct(WebsiteRepository $website, ProductRepository $product, CheckProducts $products, LoggerInterface $logger)
    {
        $this->website = $website;
        $this->product = $product;
        $this->products = $products;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;
        //var_dump($body);

        $response = json_decode($msg->body, true);

        $xml = new \XMLReader();
        $xml->open('compress.zlib://'.$response['file']);
        while($xml->read() && $xml->name != 'prod'){;}
        while($xml->name == 'prod')
        {
            $product = new \SimpleXMLElement($xml->readOuterXML());

            $msg = array('site' =>  $response['site'], 'import' => $response['import'], 'type' => $response['type'], 'brand' => $response['brand'], 'product' => json_encode($product));
            $this->products->publish(json_encode($msg));

            $xml->next('prod');
            unset($product);
        }
        unset($file);
    }
}