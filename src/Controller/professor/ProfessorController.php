<?php

namespace App\Controller\professor;

use App\Entity\Field;
use App\Repository\CourseRepository;
use App\Repository\FieldRepository;
use App\Repository\SectionRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessorController extends AbstractController
{
    #[Route('/students', name: 'app_professor_students')]
    public function students(StudentRepository $studentRepository, FieldRepository $fieldRepository): Response
    {
        $fieldId = $this->getUser()->getField();

        return $this->render('professor/students.html.twig', [
            'students' => $fieldRepository->find($fieldId)->getStudents()
        ]);
    }

    #[Route('/modules', name: 'app_professor_modules')]
    public function modules(CourseRepository $courseRepository, SectionRepository $sectionRepository): Response
    {
        $fieldId = $this->getUser()->getField()->getDepartment();
        $courses = $courseRepository->findBy(['department' => $fieldId]);
        $sections = $sectionRepository->findBy(['field' => $fieldId]);


        return $this->render('professor/modules.html.twig', [
            'courses' => $courses
        ]);
    }

    #[Route('/professors', name: 'app_professor_professors')]
    public function professors(UserRepository $userRepository, FieldRepository $fieldRepository): Response
    {
        return $this->render('professor/professors.html.twig', [
            'fields' => $fieldRepository->findAll(),
            'users' => $userRepository->findAll()
        ]);
    }
}