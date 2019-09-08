<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{

    /**
     * Index page which is a contact form
     *
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return void
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('index'),
            'method' => 'POST'
            ]);
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $email = (new \Swift_Message('Formulaire contact - ' . $contact->getName() . ' ' . $contact->getFirstname()))
                ->setFrom('contact@demo.com')
                ->setTo($contact->getDepartment()->getEmail())
                ->setBody(
                    $this->renderView(
                        'index/email.txt.twig', [
                            'contact' => $contact
                        ]),
                    'text/plain'
                );

            // for visualising easily the email content without sending it
            // dd($email->getBody());

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'form' => $form->createView()
        ]);
    }
}
