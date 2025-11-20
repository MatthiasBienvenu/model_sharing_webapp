<?php

namespace App\Controller;

use App\Entity\Model;
use App\Entity\Showcase;
use App\Entity\Member;
use App\Form\ShowcaseType;
use App\Repository\ShowcaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/showcase')]
final class ShowcaseController extends AbstractController
{
    #[Route(name: 'app_showcase_index', methods: ['GET'])]
    public function index(ShowcaseRepository $showcaseRepository): Response
    {
        return $this->render('showcase/index.html.twig', [
            'showcases' => $showcaseRepository->findBy(['published' => true]),
        ]);
    }

    #[Route('/new/{id}', name: 'app_showcase_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Member $member, EntityManagerInterface $entityManager): Response
    {
        $showcase = new Showcase();
        $showcase->setMember($member);
        
        $form = $this->createForm(ShowcaseType::class, $showcase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($showcase);
            $entityManager->flush();

            return $this->redirectToRoute('app_member_show', ['id' => $member->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('showcase/new.html.twig', [
            'showcase' => $showcase,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_showcase_show', methods: ['GET'])]
    public function show(Showcase $showcase): Response
    {
        return $this->render('showcase/show.html.twig', [
            'showcase' => $showcase,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_showcase_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Showcase $showcase, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShowcaseType::class, $showcase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_member_show', ['id' => $showcase->getMember()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('showcase/edit.html.twig', [
            'showcase' => $showcase,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_showcase_delete', methods: ['POST'])]
    public function delete(Request $request, Showcase $showcase, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $showcase->getId(), $request->getPayload()->getString('_token'))) {
            $memberId = $showcase->getMember()->getId();
            $entityManager->remove($showcase);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_member_show', ['id' => $memberId], Response::HTTP_SEE_OTHER);
        }

        return $this->redirectToRoute('app_member_show', ['id' => $showcase->getMember()->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{showcase_id}/model/{model_id}', methods: ['GET'], name: 'app_showcase_model_show')]
    public function modelShow(
        #[MapEntity(id: 'showcase_id')] Showcase $showcase,
        #[MapEntity(id: 'model_id')] Model $model
    ): Response {
        if(! $showcase->getModels()->contains($model)) {
            throw $this->createNotFoundException("Couldn't find such a model in this showcase!");
        }

        // if(! $showcase->isPublished()) {
        //   throw $this->createAccessDeniedException("You cannot access the requested ressource!");
        // }

        return $this->render('showcase/model_show.html.twig', [
            'model' => $model,
            'showcase' => $showcase
            ]);
    }
}
