<?php

namespace App\Controller;

use App\Entity\OwnCollection;
use App\Entity\User;
use App\Form\AddOwnCollectionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('profile/profile.html.twig', ['user' => $this->getUser()]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/listOwnCollections', name: 'list_own_collections')]
    public function listOwnCollections(): Response
    {
        $user = $this->getUser();

        return $this->render('profile/listOwnCollections.html.twig', [
            'ownCollections' => $user->getOwnCollection()
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/viewOwnCollection/{id<\d+>}', name: 'view_own_collection')]
    public function viewOwnCollection(OwnCollection $ownCollection): Response
    {
        dd($ownCollection);
    }

    #[Route('/{_locale<%app.supported_locales%>}/addOwnCollection', name: 'app_addOwnCollection')]
    public function addOwnCollection(Request $request, EntityManagerInterface $em): Response
    {
        $ownCollection = new OwnCollection();
        $form = $this->createForm(AddOwnCollectionFormType::class, $ownCollection);
        $form->handleRequest($request);

        $user= $this->getUser();

        if ($user instanceof User && $form->isSubmitted() && $form->isValid()){
            $ownCollection->setAuthor($user);
            $em->persist($ownCollection);
            $em->flush();
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/addOwnCollection.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
