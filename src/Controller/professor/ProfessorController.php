<?php

namespace App\Controller\professor;

use App\Entity\Field;
use App\Entity\Student;
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

    #[Route('/student/{id}', name: 'app_professor_showStudent')]
    public function showStudent(Student $student, CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findBy(['department' => $student->getField()->getDepartment()]);

        return $this->render('professor/show_student.html.twig', [
            'student' => $student,
            'courses' => $courses
        ]);
    }

    #[Route('/modules', name: 'app_professor_modules')]
    public function modules(CourseRepository $courseRepository): Response
    {
        $fieldId = $this->getUser()->getField()->getDepartment();
        $courses = $courseRepository->findBy(['department' => $fieldId]);

        return $this->render('professor/modules.html.twig', [
            'courses' => $courses
        ]);
    }

    #[Route('/professors', name: 'app_professor_professors')]
    public function professors(UserRepository $userRepository, FieldRepository $fieldRepository, SectionRepository $sectionRepository): Response
    {
        $fieldId = $this->getUser()->getField();
        $field = $fieldRepository->find($fieldId);

//        $courseByField = $fieldRepository->findBy(['department' => $field->getDepartment()]);
        $sections = $sectionRepository->findRelatedProfessorsByField($field);

        return $this->render('professor/professors.html.twig', [
            'team' => $field->getUsers(),
            'sections' => $sections,
            'users' => $userRepository->findAll(),
            //'field' => $courseByField
        ]);
    }
}