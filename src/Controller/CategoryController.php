<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="category_list")
     * @Template("test/category/index.html.twig")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);

        $categories = $repository->findAll();
        
        return [
            'categories' => $categories,
        ];
    }
    /**
     * @Route("/category/{id}", name="category_items", requirements={"id": "[0-9]+"})
     * @Template("test/category/show.html.twig")
     */
    public function showAction($id)
    {
      $repository = $this->getDoctrine()->getRepository(Category::class);
      $category = $repository->find($id);
      if (!$category) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
      }
      return [
        'category' => $category,
      ];
    }
}