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
      
        return $this->render('api_movie/index.html.twig', [
            'movies' => $moviesTab, 'genres'=> $categoryTab
            
        ]);
    }

     /**
     * @Route("/films/{id}", name="film_details")
     */
    public function showMovie(SerializerInterface $serializer, $id)
    {
        $movieDetails = file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'?language=en-US&api_key=f5621d217c7c61f28b699c88eade6ebf');
        $moviesTab = $serializer->decode($movieDetails, 'json');
        
        $trailerDetails = file_get_contents('https://api.themoviedb.org/3/movie/'.$id.'/videos?language=en-US&api_key=f5621d217c7c61f28b699c88eade6ebf');
        $trailer = $serializer->decode($trailerDetails, 'json');

        // dump($details);
        // die();

        return $this->render('api_movie/filmdetails.html.twig',[
            'details' => $moviesTab, 'trailer' => $trailer
        ]);
    }   

     /**
     * @Route("/categories/{id}", name="category_movie")
     */
    public function categoriesMovies(SerializerInterface $serializer, $id)
    {
        $categoryMovies = file_get_contents('https://api.themoviedb.org/3/list/'.$id.'?api_key=fe9e318b04bec15f80e7ddf05a462e39');
        $categoriesTab = $serializer->decode($categoryMovies, 'json');

        $category=file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=fe9e318b04bec15f80e7ddf05a462e39');
        $categoryTab=$serializer->decode($category, 'json');
        

        // dump($details);
        // die();

        return $this->render('api_movie/categories.html.twig',[
            'categoryMovies' => $categoriesTab, 'genres'=> $categoryTab
        ]);
    }   
    
}
