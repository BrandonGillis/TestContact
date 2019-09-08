<?php

namespace App\Controller;

use App\Helper\DepartmentHelper;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation as Nelmio;

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
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of departments",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Nelmio\Model(type=\App\Entity\Department::class))
     *     )
     * )
     * 
     * @SWG\Tag(name="department")
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
     * @SWG\Response(
     *     response=200,
     *     description="Returns a specified department by id",
     *     @Nelmio\Model(type=\App\Entity\Department::class)
     * )
     * 
     * @SWG\Tag(name="department")
     *
     */
    public function getDepartment(int $id)
    {
        return $this->helper->getDepartment($id);
    }
}
