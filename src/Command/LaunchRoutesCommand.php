<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class LaunchImportCommand
 * @package AppBundle\Command
 */
class LaunchRoutesCommand extends Command
{

    protected static $defaultName = 'app:launchroutes';

    /**
     * TestRabbitProducerCommand constructor.
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        parent::__construct();
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $route = new Route('/foo', ['_controller' => 'AdminController', '_action' => 'test']);
        $routes = new RouteCollection();
        $routes->add('foo', $route);

        $routes->addCollection($routes);

        return Command::SUCCESS;
    }

}
