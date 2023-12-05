<?php

namespace App\Controller;

use App\Entity\Tasks;
use App\Entity\User;
use App\Form\TasksType;
use App\Services\UserServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{HttpFoundation\Request,
    HttpFoundation\Response,
    Routing\Annotation\Route,
    Security\Http\Attribute\IsGranted,
    Security\Http\Authentication\AuthenticationUtils};

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin/tasks', name: 'tasks.')]
class TasksController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UserServices $userServices): Response
    {
        return $this->render('tasks/index.html.twig', [
            'controller_name' => 'TasksController',
            'tasks' => $userServices->getTasks()->getTasksByUserConnected()
        ]);
    }
    #[Route("/create", name: 'create')]
    public function createTask(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $doctrine): Response
    {
        $task = new Tasks();
        $form = $this->createForm(TasksType::class, $task);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $taskObj = $form->getData();
            $task
                ->setTitre($taskObj->getTitre())
                ->setDescription($taskObj->getDescription())
                ->setUser($doctrine->getRepository(User::class)->findOneBy(['email' => $authenticationUtils->getLastUsername()]));
            $doctrine->persist($task);
            $doctrine->flush();
            return $this->redirectToRoute('tasks.index');
        }
        return $this->render('tasks/create.html.twig', [
            'formTask' => $form->createView()
        ]);
    }
}
