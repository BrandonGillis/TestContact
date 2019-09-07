<?php

namespace App\Controller;

use App\Helper\DepartmentHelper;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Swagger\Annotations as SWG;

class DepartmentController extends FOSRestController
{
    private $helper;

    public function __construct(DepartmentHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Returns information about all departments
     *
     * This is allowed to anonymous user
     *
     * @Rest\Get("/departments", name="get_departments")
     * 
     */
    public function getDepartments(Request $request)
    {
        return $this->helper->getDepartments();
    }

    /**
    * Returns information about the specified department by id
    *
    * This is allowed to anonymous user
    *
    * @Rest\Get("/department/{id}", name="get_department", requirements={"id"="\d+"})
    * 
    */
    public function getDepartment(int $id)
    {
        return $this->helper->getDepartment($id);
    }
}
