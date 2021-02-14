<?php
namespace App\Consumer;

use App\Entity\Fixture;
use App\Repository\FixtureRepository;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;


class LSportsFixtureService implements ConsumerInterface
{

    public function __construct(FixtureRepository $fixture, LoggerInterface $logger)
    {
        $this->fixture = $fixture;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;

        $response = json_decode($msg->body, true);
        $body = json_decode($response['body']);

        $message = $body->Body;

        foreach ($message->Events as $event){
            $fixture = $this->fixture->findOneBy(['fixtureId'=>$event->FixtureId]);
            if (!$fixture){
                $fixture = new Fixture();
                $fixture->setFixtureId($event->FixtureId);
            }
            $fixture->setSportId($event->Fixture->Sport->Id);
            $fixture->setSportLabel($event->Fixture->Sport->Name);
            $fixture->setLocationId($event->Fixture->Location->Id);
            $fixture->setLocationLabel($event->Fixture->Location->Name);
            $fixture->setLeagueId($event->Fixture->League->Id);
            $fixture->setLeagueLabel($event->Fixture->League->Name);
            $fixture->setStartDate(new \DateTime($event->Fixture->StartDate));
            foreach ($event->Fixture->Participants as $participant){
                if ($participant->Position == 1){
                    $fixture->setHomeTeamId($participant->Id);
                    $fixture->setHomeTeamLabel($participant->Name);
                }else{
                    $fixture->setAwayTeamId($participant->Id);
                    $fixture->setAwayTeamLabel($participant->Name);
                }
            }
            $this->fixture->persist($fixture);
            $this->fixture->flush();
            //exit;
        }



    }
}