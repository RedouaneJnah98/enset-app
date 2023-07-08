<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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

        $singInForm = $this->createFormBuilder($user)
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->getForm();

        if ($request->isXmlHttpRequest()) {
            $email = $request->get('email');
            $password = $request->get('password');

            dump($email, $password);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $userRepository->save($data, true);
            $this->addFlash('success', 'Profile settings updated successfully!');
        }

        return $this->render('settings/index.html.twig', [
            'form' => $form->createView(),
            'emailForm' => $singInForm
        ]);
    }
}
