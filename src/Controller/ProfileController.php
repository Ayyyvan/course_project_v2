<?php

namespace App\Controller;

use App\Entity\OwnCollection;
use App\Entity\User;
use App\Form\AddOwnCollectionFormType;
use App\Repository\OwnCollectionRepository;
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
        if (!$user)
        {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('profile/listOwnCollections.html.twig', [
            'ownCollections' => $user->getOwnCollection()
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/viewOwnCollection/{id<\d+>}', name: 'view_own_collection')]
    public function viewOwnCollection(int $id,OwnCollectionRepository $repository): Response
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('homepage');
        }
        $collection = $repository->find($id);
        return $this->render('profile/viewOwnCollection.html.twig', [
            'ownCollection' => $collection
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/deleteOwnCollection/{id<\d+>}', name: 'delete_own_collection')]
    public function deleteOwnCollection(int $id,OwnCollectionRepository $repository, EntityManagerInterface $em): Response
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('homepage');
        }
        $collection = $repository->find($id);
        $em->remove($collection);
        $em->flush();
        return $this->redirectToRoute('app_profile');
    }

    #[Route('/{_locale<%app.supported_locales%>}/addOwnCollection', name: 'add_own_collection')]
    public function addOwnCollection(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('homepage');
        }
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
