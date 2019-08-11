<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index()
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('site/home.html.twig');
    }

    /**
     * @Route("/site/film/12", name="site_show_movie")
     */
    public function show()
    {
        return $this->render('site/show_movie.html.twig');
    }

    /**
     * @Route("/site/inscription", name="inscription")
     */
    public function register()
    {
        return $this->render('site/show_movie.html.twig');
    }
}
