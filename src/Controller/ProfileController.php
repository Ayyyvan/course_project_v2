<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile/profile/profile.html.twig', [
            'user' => $this->getUser(),
            'ownCollections' => $this->getUser()->getOwnCollection(),
            'size' => count($this->getUser()->getOwnCollection())
        ]);
    }
}
