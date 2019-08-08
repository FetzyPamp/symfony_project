<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/listeRegions", name="listeRegions")
     */
    public function listeRegions(SerializerInterface $serializer)
    {

        $mesRegions = file_get_contents('https://geo.api.gouv.fr/regions');
        // $mesRegionsTab = $serializer->decode($mesRegions, 'json');
        // $mesRegionsObjet = $serializer->denormalize($mesRegionsTab,'App\Entity\Region[]');
        $mesRegions = $serializer->deserialize($mesRegions, 'App\Entity\Region[]', 'json');
        dump($mesRegions);
        die();
        return $this->render('api/index.html.twig',[
            'mesRegions' => $mesRegions
        ]);
        
    }
}
