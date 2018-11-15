<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $tableau = [
            ['prenom' => 'Lior', 'nom' => 'Chamla', 'age' => 32],
            ['prenom' => 'Jean', 'nom' => 'Dupont', 'age' => 50],
            ['prenom' => 'Anne', 'nom' => 'Durand', 'age' => 30],
            ['prenom' => 'Sophie', 'nom' => 'Paillard', 'age' => 42],
        ];
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tableau' => $tableau,
        ]);
    }
}
