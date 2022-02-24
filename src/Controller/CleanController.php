<?php

namespace App\Controller;

use App\Entity\SubEmail;
use App\Form\ContactType;
use App\Entity\ContactForm;
use App\Form\SubscribeType;
use Symfony\Component\Mime\Email;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CleanController extends AbstractController
{
     /**
     * @Route("/",name="index")
     */
    public function index(Request $request, ObjectManager $manager, MailerInterface $mailer)
    {
        $subscribe = new SubEmail();
        $form = $this->createForm(SubscribeType::class, $subscribe);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $data = $form->getData();
           
            $manager->persist($subscribe);
            $manager->flush();
            //mailer configuration
            $message = (new Email())
                            ->from($subscribe->getEmail())
                            ->to('infomavibration@gmail.com')
                           ->replyTo($subscribe->getEmail())
                            ->subject(
                                'Voici une nouvelle souscription à la Newsletter de MA VIBRATION:'.$subscribe->getEmail(),
                                
                            )
                            ->text('Vous avez un abonné')
                        ;
            
            $mailer->send($message);
            $this->addFlash('success',"Merci, votre email a bien été enregistré.");
            return $this->redirectToRoute('index');
        }
    
    return $this->render('clean/index.html.twig',['myform'=>$form->createView()]);

    }

    /**
     * @Route("/contact",name="contact")
     */
    public function contact( Request $request,ObjectManager $manager, MailerInterface $mailer)
    {  $contact = new ContactForm();
        
        
        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $manager->persist($contact);
            $manager->flush();
            //mailer configuration
            $message = (new Email())
                            ->from($contact->getEmail())
                            ->to('infomavibration@gmail.com')
                           ->replyTo($contact->getEmail())
                            ->subject(
                                $contact->getSubject()
                            )
                            ->text(
                                
                                $contact->getMessage(),
                                'text/plain')
                        ;
            $mailer->send($message); 
        
            $this->addFlash('success',"Message envoyé, nous vous contacterons très bientôt !");
            return $this->redirectToRoute('contact');
        } 
        
        
        
        
        return $this->render('clean/contact.html.twig',['form'=>$form->createView()]) ;
    }
    
   
    
    /**
     * @Route("/about",name="about")
     */
    public function about()
    {
        
        return $this->render('clean/about.html.twig');
    }
    
    /**
     * @Route("/confidentialite",name="confidentialite")
     */
    public function confidentialite()
    {
        // return new Response($this->twig->render('pages/clean.html.twig'));
        return $this->render('clean/confidentialite.html.twig'); 
    }
    /**
     * @Route("/politique",name="politique")
     */
    public function politique()
    {
        // return new Response($this->twig->render('pages/clean.html.twig'));
        return $this->render('clean/politique.html.twig'); 
    }
    
    /**
     * @Route("/schedule", name="schedule")
     */
    public function schedules()
    {
        // return new Response($this->twig->render('pages/clean.html.twig'));
        return $this->render('clean/schedule.html.twig');
    }
    
    
    
}
