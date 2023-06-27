<?php

namespace App\Controller\student;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    #[Route('/courses', name: 'app_student_courses')]
    public function index(): Response
    {
        return $this->render('components/student/course/index.html.twig');
    }
}