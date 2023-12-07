<?php

namespace App\MicroServices;

use App\Entity\Tasks;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TasksMicroServices
{
    private EntityManagerInterface $doctrine;
    private AuthenticationUtils $authenticationUtils;
    public function __construct(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager)
    {
        $this->doctrine = $entityManager;
        $this->authenticationUtils = $authenticationUtils;
    }
    public function getTasksByUserConnected()
    {
        return $this->doctrine->getRepository(User::class)->findOneBy([
            'email' => $this->authenticationUtils->getLastUsername()
        ])->getTasks();
    }

    public function getSingle(int $id)
    {
        return $this->doctrine->getRepository(Tasks::class)->find($id);
    }
}