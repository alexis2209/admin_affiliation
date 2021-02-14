<?php
namespace App\Routing;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class ExtraLoader extends Loader
{
    private $isLoaded = false;

    public function __construct(ProductRepository $product, CategorieRepository $categorie, BlogPostRepository $blogPostRepostory)
    {
        $this->product = $product;
        $this->categorie = $categorie;
        $this->article = $blogPostRepostory;
    }

    public function load($resource, string $type = null)
    {
        if (true === $this->isLoaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $categories = $this->categorie->findBy(['CategorieParente' => NULL]);
        $routes = new RouteCollection();
        foreach ($categories as $categorie){

            $path = '{_locale}/api/blog/'.$categorie->getSlug();

            $this->addRouteCateg($routes, $categorie, '{_locale}/api/blog');

            $currentSlug = $path;
            $enfants1 = $this->categorie->findBy(['CategorieParente' => $categorie->getId()]);
            foreach ($enfants1 as $enfant1){
                $path1 = '/'.$enfant1->getSlug();
                $this->addRouteCateg($routes, $enfant1, $currentSlug);

                $currentSlug1 = $currentSlug . $path1;
                $enfants2 = $this->categorie->findBy(['CategorieParente' => $enfant1->getId()]);
                foreach ($enfants2 as $enfant2){
                    $path2 = '/'.$enfant2->getSlug();
                    $this->addRouteCateg($routes, $enfant2, $currentSlug1);

                    $currentSlug2 = $currentSlug . $path1;
                    $enfants3 = $this->categorie->findBy(['CategorieParente' => $enfant2->getId()]);

                    foreach ($enfants3 as $enfant3){
                        $path3 = '/'.$enfant3->getSlug();
                        $this->addRouteCateg($routes, $enfant3, $currentSlug2);
                    }
                }
            }
        }


        $articles = $this->article->findAll();
        $routes = new RouteCollection();
        foreach ($articles as $article){
            $path = '{_locale}/api/blog';

            $categorie = $article->getCategories()->current();
            $path .= "/".$categorie->getSlug();
            if (!is_null($categorie->getCategorieParente())){
                $enfant1 = $categorie->getCategorieParente();
                $path .= "/".$enfant1->getSlug();
                if (!is_null($enfant1->getCategorieParente())){
                    $enfant2 = $enfant1->getCategorieParente();
                    $path .= "/".$enfant2->getSlug();
                    if (!is_null($enfant2->getCategorieParente())){
                        $enfant3 = $enfant2->getCategorieParente();
                        $path .= "/".$enfant3->getSlug();
                    }
                }
            }


            $path .= '/'.$article->getSlug();
            $this->addRoutePost($routes, $article, $path);
        }

        $this->isLoaded = true;

        return $routes;
    }

    public function addRouteCateg(&$routes, $categorie, $currentSlug = ''){
        $path = $currentSlug.'/'.$categorie->getSlug();
        $routeName = 'blog_'.$categorie->getSlug();

        $routes->add($routeName, new Route($path, [
            '_controller' => 'App\Controller\Api\BlogController::categorieAction',
            'idCat'       => $categorie->getId(),
        ]));
    }

    public function addRoutePost(&$routes, $article, $path){
        $routeName = 'post_'.$article->getSlug();

        $routes->add($routeName, new Route($path, [
            '_controller' => 'App\Controller\Api\BlogController::postAction',
            'idPost'        => $article->getId(),
        ]));
    }

    public function supports($resource, string $type = null)
    {
        return 'extra' === $type;
    }
}