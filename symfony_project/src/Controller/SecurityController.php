<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SecurityController extends AbstractController
{

    /**
     * @Route("/inscription", name="security_regristration")
     */
    public function registration(Request $request, ObjectManager $manager)
    {
        $user = new Users();

        $form = $this->createForm(Registrationtype::class, $user);

        $form->handleRequest($request);

        $user->setAdmin(false);
        $user->setBan(false);
        $user->setUnsubscribe(false);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
