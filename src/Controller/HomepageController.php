<?php

namespace App\Controller;

use App\Repository\OwnCollectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('homepage', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/', name: 'homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage/homepage.html.twig', [
            'controller_name' => HomepageController::class
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/listAllCollections', name: 'list_all_collections')]
    public function listAllCollections(OwnCollectionRepository $repository): Response
    {
        return $this->render('/homepage/listAllCollections.html.twig', [
            'allCollections'=> $repository->findAll()
        ]);
    }
}
