<?php
namespace App\Command;

use App\Producer\CreateProducts;
use App\Producer\DownloadFiles;
use App\Producer\UpdateProducts;
use App\Services\lsportMQ;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LaunchImportCommand
 * @package AppBundle\Command
 */
class TestLsportsCommand extends Command
{

    protected static $defaultName = 'app:testlssport';

    /**
     * TestRabbitProducerCommand constructor.
     */
    public function __construct(DownloadFiles $producer, CreateProducts $creaProducts, UpdateProducts $updProduct)
    {
        $this->producer = $producer;
        $this->fixture = $creaProducts;
        $this->bet = $updProduct;
        parent::__construct();
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mc = new lsportMQ();
        $mc->connect($this->producer, $this->fixture, $this->bet);
        $mc->consume();

        return Command::SUCCESS;
    }

}