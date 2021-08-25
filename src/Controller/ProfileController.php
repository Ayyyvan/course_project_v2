<?php

namespace App\Controller;

use App\Entity\OwnCollection;
use App\Form\AddOwnCollectionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig', ['user' => $this->getUser()]);
    }

    #[Route('/addOwnCollection', name: 'app_addOwnCollection')]
    public function addOwnCollection(): Response
    {
        $ownCollection = new OwnCollection();
        $form = $this->createForm(AddOwnCollectionFormType::class, $ownCollection);
        return $this->render('profile/addOwnCollection.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
