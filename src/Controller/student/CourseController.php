<?php

namespace App\Controller\student;

use App\Repository\CourseRepository;
use App\Repository\FieldRepository;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    #[Route('/courses', name: 'app_student_courses')]
    public function index(FieldRepository $fieldRepository, StudentRepository $studentRepository): Response
    {
        $fieldId = $this->getUser()->getField();
//        $relatedField = $studentRepository->findAllCourseByField($fieldId);
//
//        dd($relatedField);

        $field = $fieldRepository->find($fieldId);
        $courses = $field->getDepartment()->getCourses();

//        dd($courses);

        // dd($courses->count());
//        foreach ($courses as $course) {
//            dump($course->getName());
//        }

//
//        foreach ($fields as $field) {
//            dd($field->getDepartment()->getCourses());
//        }

//        dd($fieldRepository->findAll());

        return $this->render('components/student/course/index.html.twig', [
            'courses' => $courses
        ]);
    }
}