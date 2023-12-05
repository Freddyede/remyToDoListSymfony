<?php

namespace App\Controller;

use App\Services\UserServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{HttpFoundation\Response,
    Routing\Annotation\Route,
    Security\Http\Attribute\IsGranted
};

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/tasks', name: 'tasks.')]
class TasksController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UserServices $userServices): Response
    {
        return $this->render('tasks/index.html.twig', [
            'controller_name' => 'TasksController',
            'tasks' => $userServices->getTasks()->getAll()
        ]);
    }
}
