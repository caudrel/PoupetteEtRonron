<?php

namespace App\Controller;

use App\Entity\FAQ;
use App\Form\FaqType;
use App\Repository\FAQRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaqController extends AbstractController
{
    #[Route('/faq', name: 'app_faq')]
    public function index(FAQRepository $FAQRepository): Response
    {
        $faqs = $FAQRepository->findAll();

        return $this->render('faq/index.html.twig', [
            'faqs' => $faqs,
        ]);
    }

    #[Route('/faq/{id}', name: 'app_faq_edit')]
    public function edit(
        FAQ                    $faq,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $faq->setQuestion($form->get('question')->getData());
            $faq->setAnswer($form->get('answer')->getData());
            $faq->setIsActiv($form->get('isActiv')->getData());
            $faq->setUpdatedAt(new \DateTime());

            $entityManager->persist($faq);
            $entityManager->flush();

            return $this->redirectToRoute('app_faq', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('faq/edit.html.twig', [
            'faq' => $faq,
            'form' => $form,
        ]);
    }
}
