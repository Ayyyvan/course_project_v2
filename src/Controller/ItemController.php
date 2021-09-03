<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\OwnCollection;
use App\Form\ItemFormType;
use App\Repository\ItemRepository;
use App\Repository\OwnCollectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/{ownCollectionId<\d+>}/addItem', name: 'add_item')]
    public function addItem(Request $request, EntityManagerInterface $em, int $ownCollectionId): Response
    {
        if (!$this->getUser())
        {
            return $this->redirectToRoute('homepage');
        }
        $item = new Item();
        $form = $this->createForm(ItemFormType::class, $item);
        $form->handleRequest($request);

        $ownCollection = $em->find(OwnCollection::class, $ownCollectionId);
        if ($ownCollection instanceof OwnCollection && $form->isSubmitted() && $form->isValid()){

            $item->setOwnCollection($ownCollection);
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('view_own_collection', ['id' => $ownCollectionId]);
        }

        return $this->render('user/profile/item/addItem.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/{ownCollectionId<\d+>}/listItems', name: 'list_items')]
    public function listItems(int $ownCollectionId, OwnCollectionRepository $repository): Response
    {
        $collection = $repository->find($ownCollectionId);
        return $this->render('user/profile/item/listItems.html.twig', [
            'items' => $collection->getItem(),
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/{ownCollectionId<\d+>}/{itemId<\d+>}', name: 'view_item')]
    public function viewItem(int $itemId, int $ownCollectionId, ItemRepository $repository): Response
    {
        $item = $repository->find($itemId);

        return $this->render('user/profile/item/viewItem.html.twig', [
            'item' => $item,
        ]);
    }
}
