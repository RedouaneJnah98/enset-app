<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('user')]
class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app_user_settings', methods: ['GET', 'POST'])]
    public function settings(Request $request, UserRepository $userRepository): Response
    {
        $userId = $this->getUser()->getId();
        $user = $userRepository->find($userId);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $userRepository->save($data, true);
            $this->addFlash('success', 'Profile settings updated successfully!');
        }

        return $this->render('user/settings.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/profile', name: 'app_user_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig');
    }
}
