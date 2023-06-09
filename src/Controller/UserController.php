<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\CourseRepository;
use App\Repository\FieldRepository;
use App\Repository\SectionRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class UserController extends AbstractController
{
    /**
     * @throws NonUniqueResultException
     */
    #[Route('/users', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, StudentRepository $studentRepository): Response
    {
        $totalUsers = $userRepository->totalUsers();
        $totalStudents = $studentRepository->totalOfStudents();

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
        ]);
    }

    #[Route('/user/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $roles = $request->get('roles');

        // address data from User Form
        $street = $request->get('street');
        $city = $request->get('city');
        $zipCode = $request->get('zipCode');

        $address = new Address();

        if ($form->isSubmitted() && $form->isValid()) {
            $address->setStreet($street);
            $address->setCity($city);
            $address->setZipCode($zipCode);
            $user->setRoles($roles);

            $entityManager->persist($address);
            $entityManager->flush();

            $user->setAddress($address);
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, SectionRepository $sectionRepository): Response
    {
        $field = $user->getField();


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $userRepository->save($data, true);

            $this->addFlash('success', 'User information updated successfully.');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'sections' => $user->getSections()
        ]);
    }

    #[Route('/user/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
