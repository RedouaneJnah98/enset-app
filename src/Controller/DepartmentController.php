<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/admin/department')]
class DepartmentController extends AbstractController
{
    #[Route('/', name: 'app_department_index', methods: ['GET', 'POST'])]
    public function index(DepartmentRepository $departmentRepository, Request $request): Response
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        return $this->render('department/index.html.twig', [
            'departments' => $departmentRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'app_department_new', methods: ['POST'])]
    public function new(Request $request, DepartmentRepository $departmentRepository): JsonResponse
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        $data = $form->getData();
        $departmentRepository->save($data, true);

        return $this->json(['success' => 'New Department added to the system successfully.']);
    }

    #[Route('/{id}/edit', name: 'app_department_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->save($department, true);

            return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('department/edit.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_department_delete', methods: ['POST'])]
    public function delete(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $department->getId(), $request->request->get('_token'))) {
            $departmentRepository->remove($department, true);
        }

        return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
    }
}
