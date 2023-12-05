<?php

namespace App\Controller;

use App\Entity\Tasks;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{
    HttpFoundation\Response,
    Routing\Annotation\Route
};

#[Route('/', name: 'home.')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $doctrine): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
