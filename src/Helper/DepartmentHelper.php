<?php

namespace App\Helper;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentHelper extends APIHelper
{
    private $em;
    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function getDepartments()
    {
        $departments = $this->em->getRepository("App:Department")->findAll();

        $view = View::create($departments, Response::HTTP_OK);
        $serializationContext = $view->getContext();
        $serializationContext->addGroup("getDepartments");

        return $view;
    }

    public function getDepartment(int $id)
    {
        $department = $this
            ->em
            ->getRepository('App:Department')
            ->find($id);

        if (empty($department)) {
            return $this->generateError(
                Response::HTTP_NOT_FOUND,
                ["department not found"]
            );
        }

        $view = View::create($department, Response::HTTP_OK);
        $serializationContext = $view->getContext();
        $serializationContext->addGroup("getDepartment");

        return $view;
    }
}
