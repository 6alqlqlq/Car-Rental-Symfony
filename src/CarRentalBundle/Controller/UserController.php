<?php

namespace CarRentalBundle\Controller;

use CarRentalBundle\Entity\User;
use CarRentalBundle\Form\UserType;
use CarRentalBundle\Service\Users\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response|null
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('security_login');
        }

        return $this->render('users/register.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile()
    {
        return $this->render("users/profile.html.twig",
            ['user' => $this->userService->currentUser()]);
    }

    /**
     * @Route ("/profile/edit", name="user_edit_profile",methods={"GET"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return Response
     */
    public function edit()
    {
        $currentUser = $this->userService->currentUser();

        return $this->render("users/edit.html.twig",
            [
                'user' => $currentUser,
                'form' => $this->createForm(UserType::class)->createView()

            ]
        );
    }


}
