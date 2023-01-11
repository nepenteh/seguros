<?php

namespace App\Controller;

use App\Entity\Asegurado;
use App\Form\AseguradoType;
use App\Repository\AseguradoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/asegurado')]
class AseguradoController extends AbstractController
{
    #[Route('/', name: 'app_asegurado_index', methods: ['GET'])]
    public function index(AseguradoRepository $aseguradoRepository): Response
    {
        return $this->render('asegurado/index.html.twig', [
            'asegurados' => $aseguradoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_asegurado_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AseguradoRepository $aseguradoRepository): Response
    {
        $asegurado = new Asegurado();
        $form = $this->createForm(AseguradoType::class, $asegurado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aseguradoRepository->save($asegurado, true);

            return $this->redirectToRoute('app_asegurado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('asegurado/new.html.twig', [
            'asegurado' => $asegurado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asegurado_show', methods: ['GET'])]
    public function show(Asegurado $asegurado): Response
    {
        return $this->render('asegurado/show.html.twig', [
            'asegurado' => $asegurado,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_asegurado_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Asegurado $asegurado, AseguradoRepository $aseguradoRepository): Response
    {
        $form = $this->createForm(AseguradoType::class, $asegurado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $aseguradoRepository->save($asegurado, true);

            return $this->redirectToRoute('app_asegurado_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('asegurado/edit.html.twig', [
            'asegurado' => $asegurado,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asegurado_delete', methods: ['POST'])]
    public function delete(Request $request, Asegurado $asegurado, AseguradoRepository $aseguradoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$asegurado->getId(), $request->request->get('_token'))) {
            $aseguradoRepository->remove($asegurado, true);
        }

        return $this->redirectToRoute('app_asegurado_index', [], Response::HTTP_SEE_OTHER);
    }
}
