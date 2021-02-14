<?php
namespace App\Command;

use App\Entity\ArchiveBet;
use App\Entity\Categorie;
use App\Repository\ArchiveBetRepository;
use App\Repository\BetRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\CategoriesImportRepository;

/**
 * Class CreateCategoriesBaseCommand
 * @package AppBundle\Command
 */
class ArchiveBetsCommand extends Command
{

    protected static $defaultName = 'app:archive:bets';

    /**
     * TestRabbitProducerCommand constructor.
     */
    public function __construct(BetRepository $bet, ArchiveBetRepository $archiveBet)
    {
        $this->bet = $bet;
        $this->archiveBet = $archiveBet;
        parent::__construct();
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $archive = new ArchiveBet();
        $listOldBets = $this->bet->getOldEvent();
        foreach ($listOldBets as $oldBet){
            $archiveTemp = new ArchiveBet();
            $archiveTemp->setId($oldBet->getId());
            $archiveTemp->setFixtureId($oldBet->getFixtureId());
            $archiveTemp->setMarketId($oldBet->getMarketId());
            $archiveTemp->setMarketName($oldBet->getMarketName());
            $archiveTemp->setMainLine($oldBet->getMainLine());
            $archiveTemp->setOutcomeId($oldBet->getOutcomeId());
            $archiveTemp->setOutcomeName($oldBet->getOutcomeName());
            $archiveTemp->setMainLineOutcome($oldBet->getMainLineOutcome());
            $archiveTemp->setStatus($oldBet->getStatus());
            $archiveTemp->setPrice($oldBet->getPrice());
            $archiveTemp->setDate($oldBet->getDate());
            $archiveTemp->setType($oldBet->getType());
            $this->archiveBet->persist($archiveTemp);
            $this->bet->remove($oldBet);
            $this->bet->flush();
        }
        echo 'ici ok';

        return Command::SUCCESS;
    }

}
