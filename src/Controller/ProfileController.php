<?php

namespace App\Controller;

use App\Repository\FieldRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class ProfileController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/profile', name: 'app_profile')]
    public function index(UserRepository $userRepository, FieldRepository $fieldRepository, StudentRepository $studentRepository): Response
    {
        $field_id = $this->getUser()->getField();
        $field = $fieldRepository->find($field_id);
        $students = $studentRepository->findBy(['field' => $field_id], ['createdAt' => 'DESC'], 8);

        return $this->render('profile/index.html.twig', [
            'users' => $userRepository->findAll(),
            'field' => $field,
            'students' => $students
        ]);
    }
}
