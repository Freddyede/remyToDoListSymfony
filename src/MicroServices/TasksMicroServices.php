<?php

namespace App\MicroServices;

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
    public function getAll()
    {
        return $this->doctrine->getRepository(User::class)->findOneBy([
            'email' => $this->authenticationUtils->getLastUsername()
        ])->getTasks();
    }
}