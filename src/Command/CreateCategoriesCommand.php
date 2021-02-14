<?php
namespace App\Command;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Repository\CategoriesImportRepository;

/**
 * Class CreateCategoriesBaseCommand
 * @package AppBundle\Command
 */
class CreateCategoriesCommand extends Command
{

    protected static $defaultName = 'app:create:categories';

    /**
     * TestRabbitProducerCommand constructor.
     */
    public function __construct(CategoriesImportRepository $categImport, CategorieRepository $categ)
    {
        parent::__construct();
        $this->categImport = $categImport;
        $this->categ = $categ;
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $listCategImport = $this->categImport->findAll();
        foreach ($listCategImport as $j => $categImport){
            echo $categImport->getLabel() . "\n";
            $list = explode(' > ', $categImport->getLabel());
            $parent = NULL;
            foreach ($list as $i => $currentCateg){
                $cat = $this->categ->findOneBy(['libelle' => $currentCateg]);
                echo $currentCateg . "   -   ";
                echo (!is_null($parent))?$parent->getLibelle():'NULL';
                echo  "\n";
                if (!$cat){
                    $newCateg = new Categorie();
                    $newCateg->setLibelle($currentCateg);
                    $newCateg->setValid(1);
                    $newCateg->setCategorieParente($parent);
                    $this->categImport->persist($newCateg);
                    $this->categImport->flush();

                    $parent = $newCateg;
                }else{
                    $newCateg = $cat;
                    $parent = $cat;
                }

            }
            $categImport->setCategorie($newCateg);
        }

        return Command::SUCCESS;
    }

}
