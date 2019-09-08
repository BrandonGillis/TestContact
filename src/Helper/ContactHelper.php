<?php

namespace App\Helper;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ContactHelper extends APIHelper
{
    private $em;
    private $formFactory;
    private $mailer;
    private $twig;

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, \Swift_Mailer $mailer, Environment $twig)
    {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function createContact(Request $request)
    {
        $contact = new Contact();
        $form = $this->formFactory->create(ContactType::class, $contact);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();

            $view = View::create($contact, Response::HTTP_CREATED);
            $serializationContext = $view->getContext();
            $serializationContext->addGroup("getContact");

            $this->sendContactEmail($contact);

            return $view;
        } else {
            return View::create($form, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Send an email to the specific department used in contact form
     *
     * @param Contact $contact  The contact form informations
     * @return void
     */
    private function sendContactEmail(Contact $contact) {
        $email = (new \Swift_Message('Formulaire contact - ' . $contact->getName() . ' ' . $contact->getFirstname()))
            ->setFrom('contact@demo.com')
            ->setTo($contact->getDepartment()->getEmail())
            ->setBody(
                $this->twig->render(
                    'contact/email.txt.twig', [
                        'contact' => $contact
                    ]),
                'text/plain'
            );
        // for visualising easily the email content without sending it
        // var_dump($email->getBody());
        // die;
        $this->mailer->send($email);
    }
}
