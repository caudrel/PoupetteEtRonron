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
    #[Route('/faq/new', name: 'app_faq_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $faq = new FAQ();

        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $faq->setQuestion($form->get('question')->getData());
            $faq->setAnswer($form->get('answer')->getData());
            $faq->setIsActiv($form->get('isActiv')->getData());
            $faq->setCreatedAt(new \DateTime());
            $faq->setUpdatedAt(new \DateTime());

            $entityManager->persist($faq);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La FAQ a bien été ajoutée."
            );

            return $this->redirectToRoute('app_faq', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('faq/new.html.twig', [
            'form' => $form,
            'faq' => $faq,
        ]);
    }
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

            $this->addFlash(
                'success',
                "La FAQ a bien été modifiée."
            );

            return $this->redirectToRoute('app_faq', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('faq/edit.html.twig', [
            'faq' => $faq,
            'form' => $form,
        ]);
    }

    #[Route('/faq/delete/{id}', name: 'app_faq_delete', methods: ['POST'])]
    public function delete(Request $request, FAQ $faq, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $faq->getId(), $request->request->get('_token'))) {
            $entityManager->remove($faq);
            $entityManager->flush();

            $question = $faq->getQuestion();
            $this->addFlash(
                'success',
                "La FAQ -- $question -- a bien été supprimée."
            );
        }

        return $this->redirectToRoute('app_faq', [], Response::HTTP_SEE_OTHER);
    }

}
