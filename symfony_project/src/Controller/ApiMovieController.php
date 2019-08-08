<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiMovieController extends AbstractController
{
    /**
     * @Route("/films", name="films")
     */
    public function popularMovies(SerializerInterface $serializer)
    {
        
        $movies = file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key=fe9e318b04bec15f80e7ddf05a462e39');
        $moviesTab = $serializer->decode($movies, 'json');
        $category=file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=fe9e318b04bec15f80e7ddf05a462e39');
        $categoryTab=$serializer->decode($category, 'json');
        // $mesRegionsObjet = $serializer->denormalize($films,'App\Entity\Region[]');
        // dump($moviesTab);
        // die();
        return $this->render('api_movie/index.html.twig', [
            'movies' => $moviesTab, 'genres'=> $categoryTab
            
        ]);
    }
}
