<?php

namespace App\Controller;

use App\Entity\Field;
use App\Repository\FieldRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(UserRepository $userRepository, FieldRepository $fieldRepository, StudentRepository $studentRepository, EntityManagerInterface $entityManager): Response
    {
        $field_id = $this->getUser()->getField();
        $field = $fieldRepository->find($field_id);
        $repository = $entityManager->getRepository(Field::class);

        $fields = $fieldRepository->findStudentsByField($field_id);

        $students = $studentRepository->findBy(['field' => $field_id], ['createdAt' => 'ASC'], 8);


//        foreach ($students as $student) {
//            dump($student->getFirstName());
//        }
////
//
//        dd($students->count());

        //  dump($fields);

//        foreach ($fields as $item) {
//            dump($item->getStudents()->count());
//        }

        return $this->render('profile/index.html.twig', [
            'users' => $userRepository->findAll(),
//            'fields' => $fields,
            'field' => $field,
            'students' => $students
        ]);
    }
}
