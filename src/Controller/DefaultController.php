<?php

namespace App\Controller;

use App\Form\FeedbackType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $number = 1;

        return $this->render('test/index.html.twig', [
            'number' => $number,
        ]);
    }
    /**
     * @Route("/feedback", name="feedback")
     */
    public function feedback(Request $request)
    {
        $form = $this->createForm(FeedbackType::class);
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $feedback = $form->getData();
            // save
            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();
            // redirect
            $this->addFlash('success', 'Saved');
            return $this->redirectToRoute('feedback');
        }

        // dump($form->getData());

        return $this->render('test/feedback.html.twig', [
            'feedback_form' => $form->createView(),
        ]);
    }
}