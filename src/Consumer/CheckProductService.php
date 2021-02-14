<?php


namespace App\Consumer;

use App\Entity\CategoriesImport;
use App\Producer\CheckProducts;
use App\Producer\CreateProducts;
use App\Producer\UpdateProducts;
use App\Repository\CategoriesImportRepository;
use App\Repository\ImportRepository;
use App\Repository\ProductRepository;
use App\Repository\WebsiteRepository;
use AppBundle\Entity\Categories;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;


class CheckProductService  implements ConsumerInterface
{

    public function __construct(ProductRepository $product, CategoriesImportRepository $categoriesImport, ImportRepository $import, CreateProducts $creaProducts, UpdateProducts $updProduct, LoggerInterface $logger)
    {
        $this->product = $product;
        $this->categoriesImport = $categoriesImport;
        $this->import = $import;
        $this->creaProduct = $creaProducts;
        $this->updProduct = $updProduct;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;

        $response = json_decode($msg->body, true);

        $product = json_decode($response['product']);

        $msg = ['site' =>  $response['site'], 'type' => $response['type'], 'brand' => $response['brand'], 'product' => json_encode($product)];

        if (isset($product->ean)){
            $testExist = $this->product->findOneBy(['ean'=>(string)$product->ean]);
            if ($testExist){
                $this->updProduct->publish(json_encode($msg));
            }else{
                $currentImport = $this->import->find($response['import']);
                $categ = $this->checkCateg((string)$product->cat->merchantProductCategoryPath, $currentImport);
                if ($categ){
                    $msg['category'] = $categ;
                    $this->creaProduct->publish(json_encode($msg));
                }
            }
        }

    }


    public function checkCateg($stringCateg, $import){
        $categorieId = NULL;

        $categorieLib = $stringCateg;

        $testExist = $this->categoriesImport->findOneBy(['label' => $stringCateg, 'import' => $import]);

        if (!$testExist){
            $cat = new CategoriesImport();

            $cat->setLabel($categorieLib);
            $cat->setImport($import);
            $this->categoriesImport->persist($cat);
            $this->categoriesImport->flush();
            return false;
        }elseif (!is_null($testExist->getCategorie())){
            $categorie = $testExist->getCategorie();
            return $categorie->getId();
        }else{
            return false;
        }
    }
}