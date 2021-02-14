<?php


namespace App\Consumer;

use App\Entity\Product;
use App\Entity\ProductDetails;
use App\Producer\CreateProducts;
use App\Producer\UpdateProducts;
use App\Repository\BrandRepository;
use App\Repository\CategorieRepository;
use App\Repository\ProductDetailsRepository;
use App\Repository\ProductRepository;
use App\Repository\WebsiteRepository;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;


class CreateProductService  implements ConsumerInterface
{

    public function __construct(ProductRepository $product, ProductDetailsRepository $productDetails, WebsiteRepository $website, BrandRepository $brand, CategorieRepository $categorie, LoggerInterface $logger)
    {
        $this->product = $product;
        $this->productDetails = $productDetails;
        $this->website = $website;
        $this->brand = $brand;
        $this->categorie = $categorie;
        $this->logger = $logger;
    }

    public function execute(AMQPMessage $msg)
    {

        $body = $msg->body;
        //var_dump($body);

        $response = json_decode($msg->body, true);
        $site = $this->website->find($response['site']);
        $categorie = $this->categorie->find($response['category']);
        $brand = $this->brand->find($response['brand']);

        $currentProduct = json_decode($response['product']);



        $product = new Product();
        $product->setSite($site);
        $product->setCategorie($categorie);
        $product->setEan((string)$currentProduct->ean);
        $product->setLabel((string)$currentProduct->text->name);
        if (isset($currentProduct->text) && isset($currentProduct->text->desc)){
            $product->setContent((string)$currentProduct->text->desc);
        }else{
            $product->setContent('');
        }

        $product->setImage1((string)$currentProduct->uri->mImage);
        $this->product->persist($product);


        $productDetails = new ProductDetails();
        $productDetails->setProduct($product);
        $productDetails->setBrand($brand);
        $productDetails->setLink((string)$currentProduct->uri->awTrack);
        $productDetails->setPriceBase((string)$currentProduct->price->buynow);
        $productDetails->setPrice((string)$currentProduct->price->buynow);
        $this->productDetails->persist($productDetails);

        $this->product->flush();
    }
}