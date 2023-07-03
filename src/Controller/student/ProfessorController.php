<?php

namespace App\Controller\student;

use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessorController extends AbstractController
{
    #[Route('/professors', name: 'app_student_professors')]
    public function index(SectionRepository $sectionRepository): Response
    {
        $fieldId = $this->getUser()->getField();
        $sections = $sectionRepository->findRelatedProfessorsByField($fieldId);

        return $this->render('components/student/professor/index.html.twig', [
            'sections' => $sections
        ]);
    }
}