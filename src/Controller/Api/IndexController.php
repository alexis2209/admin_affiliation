<?php

namespace App\Controller\Api;

use App\Repository\CategorieRepository;
use App\Repository\HistoriqueRepository;
use App\Services\UploadHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController as FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BlogPostRepository;

/**
 * Movie controller.
 * @Route("/api", name="api_index_")
 */
class IndexController extends FOSRestController
{

    public function __construct(CategorieRepository $categorie)
    {
        $this->categorieRepository = $categorie;
    }

    /**
     * Homepage.
     * @Rest\Get("/home")
     *
     * @return Response
     */
    public function homeAction()
    {
        $data['datas'] = [];
        $data['config'] = ['components' => 'home.vue'];
        $data['datas']['slider'] = [
        [
            'title'=> 'Big choice of<br>Plumbing products',
            'text'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.',
            'imageClassic'=> '/images/slides/slide-1-ltr.jpg'
        ],
        [
            'title'=> 'Screwdrivers<br>Professional Tools',
            'text'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.',
            'imageClassic'=> '/images/slides/slide-2-ltr.jpg'
        ],
        [
            'title'=> 'One more<br>Unique header',
            'text'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Etiam pharetra laoreet dui quis molestie.',
            'imageClassic'=> '/images/slides/slide-3-ltr.jpg'
        ],
    ];
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }

    /**
     * Lists menu.
     * @Rest\Get("/menu")
     *
     * @return Response
     */
    public function menuAction()
    {
        $mainCategs = $this->categorieRepository->getMainCateg();
        $data = [];
        $data['items'] = [];
        foreach ($mainCategs as $categ){
            $data['items'][] = ['title' => $categ->getLibelle(), 'url' => $categ->getSlug()];
        }
        $data[] = [
            'title' => 'Home',
            'url' => '/',
        ];
        $data[] = [
            'title' => 'blog',
            'url' => '/blog',
            'submenu' => [
                'type' => 'menu',
                'menu' => [
                    ['title' => 'blog 1', 'url' => 'blog-1'],
                    ['title' => 'blog 2', 'url' => 'blog-2']
                ]
            ]
        ];
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }
}