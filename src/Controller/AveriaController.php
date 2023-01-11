<?php

namespace App\Controller;

use App\Entity\Averia;
use App\Form\AveriaType;
use App\Repository\AveriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/averia')]
class AveriaController extends AbstractController
{
    #[Route('/', name: 'app_averia_index', methods: ['GET'])]
    public function index(AveriaRepository $averiaRepository): Response
    {
        return $this->render('averia/index.html.twig', [
            'averias' => $averiaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_averia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AveriaRepository $averiaRepository): Response
    {
        $averium = new Averia();
        $form = $this->createForm(AveriaType::class, $averium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $averiaRepository->save($averium, true);

            return $this->redirectToRoute('app_averia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('averia/new.html.twig', [
            'averium' => $averium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_averia_show', methods: ['GET'])]
    public function show(Averia $averium): Response
    {
        return $this->render('averia/show.html.twig', [
            'averium' => $averium,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_averia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Averia $averium, AveriaRepository $averiaRepository): Response
    {
        $form = $this->createForm(AveriaType::class, $averium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $averiaRepository->save($averium, true);

            return $this->redirectToRoute('app_averia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('averia/edit.html.twig', [
            'averium' => $averium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_averia_delete', methods: ['POST'])]
    public function delete(Request $request, Averia $averium, AveriaRepository $averiaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$averium->getId(), $request->request->get('_token'))) {
            $averiaRepository->remove($averium, true);
        }

        return $this->redirectToRoute('app_averia_index', [], Response::HTTP_SEE_OTHER);
    }
}
