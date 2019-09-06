<?php

namespace App\Controller;

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
        $form = $this->createForm(ContactType::class, null, [
                    'action' => $this->generateUrl('index'),
                    'method' => 'POST'
                ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $name = $data['name'];
            $firstname = $data['firstname'];
            $email = $data['email'];
            $department = $data['department'];
            $message = $data['message'];

            $email = (new \Swift_Message('Formulaire contact - ' . $firstname . ' ' . $name))
                ->setFrom('contact@demo.com')
                ->setTo($department->getEmail())
                ->setBody(
                    $this->renderView(
                        'index/email.txt.twig', [
                            'department' => $department,
                            'name' => $name,
                            'firstname' => $firstname,
                            'email' => $email,
                            'message' => $message
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
