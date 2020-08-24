<?php

namespace CarRentalBundle\Controller;

use CarRentalBundle\Entity\Car;
use CarRentalBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response|null
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/Cars", name="car_display")
     * @param Request $request
     * @return Response|null
     */
    public function carsIndexAction(Request $request)
    {
        $car = $this
            ->getDoctrine()
            ->getRepository(Car::class)
            ->findAll(
                [],
                [
                    'carBrand' => "DESC",
                    'created_at' => 'DESC'
                ]);

        // replace this example code with whatever you need
        return $this->render('car/display.html.twig', ['car' => $car]);
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return Response|null
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('dashboard.html.twig');
    }

    /**
     * @Route("/about", name="about_us")
     * @param Request $request
     * @return Response|null
     */
    public function aboutAction(Request $request)
    {
        return $this->render('default/about.html.twig');
    }


    /**
     * @Route("/contact", name="contact_us")
     * @param Request $request
     * @return RedirectResponse|Response|null
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact;

        # Add form fields
        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class, array('label' => 'Full Name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','placeholder'=>'Enter Full name'), 'constraints' => array(
                new NotBlank(array("message" => "Please provide your name")))))
            ->add('email', EmailType::class, array('label' => 'Email', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','placeholder'=>'Enter email'), 'constraints' => array(
                new NotBlank(array("message" => "Please provide a valid email")),
                new Email(array("message" => "Your email doesn't seems to be valid")),
            )))
            ->add('subject', TextType::class, array('label' => ' Subject', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px','placeholder'=>'Enter Subject'),'constraints' => array(
                new NotBlank(array("message" => "Please give a Subject")),
            )))
            ->add('message', TextareaType::class, array('label' => ' Message', 'attr' => array('class' => 'form-control','placeholder'=>'Enter Message'), 'constraints' => array(
                new NotBlank(array("message" => "Please provide a message here")),
            )))
            ->add('Save', SubmitType::class, array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
            ->getForm();

        # Handle form and recaptcha response
        $form->handleRequest($request);
        # check if form is submitted
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form['name']->getData();
            $email = $form['email']->getData();
            $subject = $form['subject']->getData();
            $message = $form['message']->getData();
            # set form data
            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setSubject($subject);
            $contact->setMessage($message);
            # finally add data in database
            $sn = $this->getDoctrine()->getManager();
            $sn->persist($contact);
            $sn->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Lists all send messages
     * @Security ("has_role('ROLE_ADMIN')")
     * @Route("/contact/index", name="contact_index",methods={"GET"})
     */
    public function indexContactAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contact = $em->getRepository('CarRentalBundle:Contact')->findAll();

        return $this->render('default/contactIndex.html.twig', array(
            'contact' => $contact,
        ));
    }




}
