<?php

namespace App\Controller\student;

use App\Repository\FieldRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/courses', name: 'app_student_courses')]
    public function courses(FieldRepository $fieldRepository): Response
    {
        $fieldId = $this->getUser()->getField();
        $field = $fieldRepository->find($fieldId);
        $courses = $field->getDepartment()->getCourses();

        return $this->render('components/student/course/index.html.twig', [
            'courses' => $courses
        ]);
    }

    #[Route('/profile', name: 'app_student_profile')]
    public function profile(): Response
    {
        return $this->render('components/student/profie.html.twig');
    }
}