<?php


namespace App\Consumer;

use App\Entity\Fixture;
use App\Repository\BetRepository;
use App\Entity\Bet;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;


class LSportsBetService implements ConsumerInterface
{

    public function __construct(BetRepository $bet, LoggerInterface $logger)
    {
        $this->bet = $bet;
    }

    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;

        $response = json_decode($msg->body, true);
        $body = json_decode($response['body']);


        $message = $body->Body;

        foreach ($message->Events as $event){
            foreach ($event->Markets as $market){
                foreach ($market->Bets as $currentBet){
                    $currentDate = new \DateTime();
                    $bet = new Bet();
                    $bet->setFixtureId($event->FixtureId);
                    $bet->setMarketId($market->Id);
                    $bet->setMarketName($market->Name);
                    $bet->setMainLine((isset($market->MainLine))?$market->MainLine:0);
                    $bet->setOutcomeId($currentBet->Id);
                    $bet->setOutcomeName($currentBet->Name);
                    $bet->setMainLineOutcome((isset($currentBet->Line))?$currentBet->Line:0);
                    $bet->setStatus($currentBet->Status);
                    $bet->setPrice($currentBet->Price);
                    $bet->setDate($currentDate);
                    $bet->setType($response['typeData']);
                    $this->bet->persist($bet);
                    $this->bet->flush();
                }
            }
        }

    }
}