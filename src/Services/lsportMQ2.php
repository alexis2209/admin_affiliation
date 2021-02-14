<?php
namespace App\Services;

use App\Producer\DownloadFiles;
use PhpAmqpLib\Connection\AMQPStreamConnection;


/**
 * Channel Creation From Connection
 */

class lsportMQ2 {

    protected $channel;
    protected $connection;

    protected $rmq_host = 'stm-prematch.lsports.eu';
    protected $rmq_port = 5672;
    protected $rmq_username = 'kevin.brocard@sportnco.com';
    protected $rmq_password = 'fe23rtf1';
//    protected $queue = "_1607_"; //In-play
    protected $queue = "_554_";

    protected $prefetchSize = null; // msg size in bytes, must be null else error
    protected $prefetchCount = 1000;
    protected $applyPerChannel = false; // can be false or null, otherwise error

    public function __construct($vhost = "StmPrePrematch", $queue = "_555_", $rmq_host = 'stm-prematch.lsports.eu'){
        $this->vhost = $vhost;
        $this->queue = $queue;
        $this->rmq_host = $rmq_host;
    }

    public function connect(DownloadFiles $producer, $fixture, $bet)
    {
        $this->producer = $producer;
        $this->fixture = $fixture;
        $this->bet = $bet;
        echo $this->rmq_host . " / " . $this->vhost;
        $this->connection = new AMQPStreamConnection(
            $this->rmq_host,// HOST
            $this->rmq_port,
            $this->rmq_username, // Change to your user name
            $this->rmq_password,// Change to your password
            $this->vhost,
            false,
            'AMQPLAIN', //LOGIN MECHANISM
            null,
            'en_US', //Locale
            1160,
            1160,
            null,
            false,
            580);
    }

    public function consume() {

        echo "\n" . "consume " . "\n";
        $this->channel = $this->connection->channel();
        $this->channel->basic_qos($this->prefetchSize, $this->prefetchCount, $this->applyPerChannel);
        $this->channel->basic_consume($this->queue, 'consumer', false,true,false,false, function ($msg) {
            $info = json_decode($msg->body);
            $msg->typeData = $this->vhost;
            $type = $info->Header->Type;
            echo $type . "\n";
            if ($type != 31 && $type != 32){
                if ($type == 1){
                    $this->fixture->publish(json_encode($msg));
                }elseif ($type == 3){
                    $this->bet->publish(json_encode($msg));
                }else{
                    $this->producer->publish(json_encode($msg));
                }

                echo json_encode($msg);
            }

        });


        while (count($this->channel->callbacks)) {
            try {
                $this->channel->wait();
            } catch (\Exception $e) {
                $this->connection->reconnect();
                $this->consume();
            }
        }
    }
}