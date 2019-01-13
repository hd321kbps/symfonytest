<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product_list")
     * @Template("test/product/index.html.twig")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);

        $products = $repository->findAll();
        
        return [
            'products' => $products,
        ];
    }
    /**
     * @Route("/products/{id}", name="product_items", requirements={"id": "[0-9]+"})
     * @Template("test/product/show.html.twig")
     */
    public function showAction($id)
    {
      $repository = $this->getDoctrine()->getRepository(Product::class);
      $product = $repository->find($id);
      if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
      }
      return [
        'product' => $product,
      ];
    }
}