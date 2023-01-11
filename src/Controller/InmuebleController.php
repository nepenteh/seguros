<?php

namespace App\Controller;

use App\Entity\Inmueble;
use App\Form\InmuebleType;
use App\Repository\InmuebleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inmueble')]
class InmuebleController extends AbstractController
{
    #[Route('/', name: 'app_inmueble_index', methods: ['GET'])]
    public function index(InmuebleRepository $inmuebleRepository): Response
    {
        return $this->render('inmueble/index.html.twig', [
            'inmuebles' => $inmuebleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inmueble_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InmuebleRepository $inmuebleRepository): Response
    {
        $inmueble = new Inmueble();
        $form = $this->createForm(InmuebleType::class, $inmueble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inmuebleRepository->save($inmueble, true);

            return $this->redirectToRoute('app_inmueble_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inmueble/new.html.twig', [
            'inmueble' => $inmueble,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inmueble_show', methods: ['GET'])]
    public function show(Inmueble $inmueble): Response
    {
        return $this->render('inmueble/show.html.twig', [
            'inmueble' => $inmueble,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inmueble_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inmueble $inmueble, InmuebleRepository $inmuebleRepository): Response
    {
        $form = $this->createForm(InmuebleType::class, $inmueble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inmuebleRepository->save($inmueble, true);

            return $this->redirectToRoute('app_inmueble_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inmueble/edit.html.twig', [
            'inmueble' => $inmueble,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inmueble_delete', methods: ['POST'])]
    public function delete(Request $request, Inmueble $inmueble, InmuebleRepository $inmuebleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inmueble->getId(), $request->request->get('_token'))) {
            $inmuebleRepository->remove($inmueble, true);
        }

        return $this->redirectToRoute('app_inmueble_index', [], Response::HTTP_SEE_OTHER);
    }
}
