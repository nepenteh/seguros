<?php

namespace App\Controller;

use App\Entity\Aseguradora;
use App\Form\AseguradoraType;
use App\Repository\AseguradoraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/aseguradora')]
class AseguradoraController extends AbstractController
{
    #[Route('/', name: 'app_aseguradora_index', methods: ['GET'])]
    public function index(AseguradoraRepository $aseguradoraRepository): Response
    {
        return $this->render('aseguradora/index.html.twig', [
            'aseguradoras' => $aseguradoraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_aseguradora_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AseguradoraRepository $aseguradoraRepository): Response
    {
        $aseguradora = new Aseguradora();
        $form = $this->createForm(AseguradoraType::class, $aseguradora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aseguradoraRepository->save($aseguradora, true);

            return $this->redirectToRoute('app_aseguradora_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aseguradora/new.html.twig', [
            'aseguradora' => $aseguradora,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aseguradora_show', methods: ['GET'])]
    public function show(Aseguradora $aseguradora): Response
    {
        return $this->render('aseguradora/show.html.twig', [
            'aseguradora' => $aseguradora,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_aseguradora_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Aseguradora $aseguradora, AseguradoraRepository $aseguradoraRepository): Response
    {
        $form = $this->createForm(AseguradoraType::class, $aseguradora);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aseguradoraRepository->save($aseguradora, true);

            return $this->redirectToRoute('app_aseguradora_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aseguradora/edit.html.twig', [
            'aseguradora' => $aseguradora,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aseguradora_delete', methods: ['POST'])]
    public function delete(Request $request, Aseguradora $aseguradora, AseguradoraRepository $aseguradoraRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aseguradora->getId(), $request->request->get('_token'))) {
            $aseguradoraRepository->remove($aseguradora, true);
        }

        return $this->redirectToRoute('app_aseguradora_index', [], Response::HTTP_SEE_OTHER);
    }
}
