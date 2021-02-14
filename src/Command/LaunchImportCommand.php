<?php
namespace App\Command;

use App\Entity\Import;
use App\Producer\DownloadFiles;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\ImportRepository;

/**
 * Class LaunchImportCommand
 * @package AppBundle\Command
 */
class LaunchImportCommand extends Command
{

    protected static $defaultName = 'app:import:launchimport';

    /**
     * TestRabbitProducerCommand constructor.
     */
    public function __construct(DownloadFiles $producer, ImportRepository $import)
    {
        $this->producer = $producer;
        $this->import = $import;
        parent::__construct();
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $list = $this->import->findBy(['site' => 2]);

        foreach ($list as $editor){
            $msg = array('site' => $editor->getSite()->getId(), 'type' => $editor->getFrom(), 'brand'=> $editor->getBrandId(), 'file' => $editor->getUrl(), 'import'=>$editor->getId());
            $this->producer->publish(json_encode($msg));
        }
        return Command::SUCCESS;
    }

}
