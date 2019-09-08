<?php

namespace App\Controller;

use App\Helper\ContactHelper;
use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Swagger\Annotations as SWG;

use Nelmio\ApiDocBundle\Annotation as Nelmio;

class ContactController extends FOSRestController
{
    private $helper;

    public function __construct(ContactHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Creates a new contact.
     *
     * This is allowed to anonymous user
     *
     * @Rest\Post("/contact", name="create_contact")
     * 
     * @SWG\Response(
     *     response=201,
     *     description="Returns the created contact",
     *     @Nelmio\Model(type=\App\Entity\Contact::class)
     * )
     * 
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="JSON Payload",
     *     required=true,
     *     format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="name", type="string", example="Doe"),
     *              @SWG\Property(property="firstname", type="string", example="John"),
     *              @SWG\Property(property="email", type="string", example="test@test.fr"),
     *              @SWG\Property(property="department", type="int", example=1),
     *              @SWG\Property(property="message", type="string", example="Hello world")
     *          )
     * )
     *
     * @SWG\Tag(name="contact")
     */
    public function postContact(Request $request)
    {
        return $this->helper->createContact($request);
    }
}
