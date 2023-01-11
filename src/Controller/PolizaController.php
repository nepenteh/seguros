<?php

namespace App\Controller;

use App\Entity\Poliza;
use App\Form\PolizaType;
use App\Repository\PolizaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/poliza')]
class PolizaController extends AbstractController
{
    #[Route('/', name: 'app_poliza_index', methods: ['GET'])]
    public function index(PolizaRepository $polizaRepository): Response
    {
        return $this->render('poliza/index.html.twig', [
            'polizas' => $polizaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_poliza_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PolizaRepository $polizaRepository): Response
    {
        $poliza = new Poliza();
        $form = $this->createForm(PolizaType::class, $poliza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $polizaRepository->save($poliza, true);

            return $this->redirectToRoute('app_poliza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poliza/new.html.twig', [
            'poliza' => $poliza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_poliza_show', methods: ['GET'])]
    public function show(Poliza $poliza): Response
    {
        return $this->render('poliza/show.html.twig', [
            'poliza' => $poliza,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_poliza_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Poliza $poliza, PolizaRepository $polizaRepository): Response
    {
        $form = $this->createForm(PolizaType::class, $poliza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $polizaRepository->save($poliza, true);

            return $this->redirectToRoute('app_poliza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poliza/edit.html.twig', [
            'poliza' => $poliza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_poliza_delete', methods: ['POST'])]
    public function delete(Request $request, Poliza $poliza, PolizaRepository $polizaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poliza->getId(), $request->request->get('_token'))) {
            $polizaRepository->remove($poliza, true);
        }

        return $this->redirectToRoute('app_poliza_index', [], Response::HTTP_SEE_OTHER);
    }
}
