<?php

namespace App\Controller\Api;

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
 * @Route("/api/blog", name="api_blog_")
 */
class BlogController extends FOSRestController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * Lists all test.
     * @Rest\Get("")
     *
     * @return Response
     */
    public function indexAction()
    {
        $blogPosts = $this->blogPostRepository->getBlogList(['valid' => 1]);
        $data = [];
        $data['datas'] = $blogPosts;
        $data['config'] = ['components' => 'blog-list.vue'];
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }

    public function categorieAction($idCat)
    {
        $blogPosts = $this->blogPostRepository->getBlogList(['valid' => 1]);
        $data = [];
        $data['datas'] = $blogPosts;
        $data['config'] = ['components' => 'blog-list.vue'];
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }

    public function postAction($idPost)
    {
        $blogPosts = $this->blogPostRepository->findOneBy(['id' => $idPost]);
        $data = [];
        $data['datas'] = $blogPosts;
        $data['config'] = ['components' => 'blog-list.vue'];
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }
}