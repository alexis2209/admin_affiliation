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
class TestLsportsPrematchCommand extends Command
{

    protected static $defaultName = 'app:testlssportprematch';

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
        $mc = new lsportMQ('StmPreMatch', '_555_', 'stm-prematch.lsports.eu');
        $mc->connect($this->producer, $this->fixture, $this->bet);
        $mc->consume();
    }
}