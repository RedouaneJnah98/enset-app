<?php

namespace App\Controller;

use App\Repository\FieldRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(UserRepository $userRepository, FieldRepository $fieldRepository): Response
    {
//        $id = $this->getUser()->getD
        $fields = $fieldRepository->findAll();


//        foreach ($fields as $field) {
//            $students = $field->getStudents();
////            dd($field->getStudents());
////            dd($field->getStudents()->count());
////            foreach ($students as $student) {
////                dump($student->getFirstName());
////            }
//        }
//        dd($students);

        return $this->render('profile/index.html.twig', [
            'users' => $userRepository->findAll(),
            'fields' => $fieldRepository->findAll()
        ]);
    }
}
