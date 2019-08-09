<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Liste;
use App\Form\ListeType;

class ListeController extends AbstractController
{
    /**
     * @Route("/liste", name="liste")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $liste = new Liste();

        $form = $this->createForm(ListeType::class, $liste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($liste);
            $manager->flush();
        }

        return $this->render('liste/createListe.html.twig', [
            'form' => $form->createView()
        ]);
    }
}