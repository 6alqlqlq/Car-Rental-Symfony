<?php

namespace CarRentalBundle\Controller;

use CarRentalBundle\Entity\Car;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Car controller.
 *
 * @Route("admin/cars")
 */
class CarController extends Controller
{
    /**
     * Lists all car entities.
     * @Security ("has_role('ROLE_ADMIN')")
     * @Route("/", name="car_index",methods={"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('CarRentalBundle:Car')->findAll();

        return $this->render('car/index.html.twig', array(
            'cars' => $cars,
        ));
    }

    /**
     * Creates a new car entity.
     *
     * @Route("/new", name="car_new",methods={"GET", "POST"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return RedirectResponse|Response|null
     */
    public function newAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm('CarRentalBundle\Form\CarType', $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->uploadFile($form, $car);
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_show', array('id' => $car->getId()));
        }

        return $this->render('car/new.html.twig', array(
            'car' => $car,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a car entity.
     *
     * @Route("/{id}", name="car_show",methods={"GET"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Car $car
     * @return Response|null
     */
    public function showAction(Car $car)
    {
        $deleteForm = $this->createDeleteForm($car);

        return $this->render('car/show.html.twig', array(
            'car' => $car,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     * @Route("/{id}/edit", name="car_edit",methods={"GET", "POST"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Car $car
     * @return RedirectResponse|Response|null
     */
    public function editAction(Request $request, Car $car)
    {
        $deleteForm = $this->createDeleteForm($car);
        $editForm = $this->createForm('CarRentalBundle\Form\CarType', $car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->uploadFile($editForm, $car);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_edit', array('id' => $car->getId()));
        }

        return $this->render('car/edit.html.twig', array(
            'car' => $car,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a car entity.
     *
     * @Route("/{id}", name="car_delete",methods={"DELETE"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Car $car
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Car $car)
    {
        $form = $this->createDeleteForm($car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($car);
            $em->flush();
        }

        return $this->redirectToRoute('car_index');
    }

    /**
     * Creates a form to delete a car entity.
     * @Security ("has_role('ROLE_ADMIN')")
     *
     * @param Car $car The car entity
     *
     * @return FormInterface The form
     */
    private function createDeleteForm(Car $car)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_delete', array('id' => $car->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param FormInterface $form
     * @param Car $car
     */
    private function uploadFile(FormInterface $form, Car $car): void
    {
        /** @var  UploadedFile $file */
        $file = $form['image']->getData();

        $fileName = md5(uniqid()) . '.' . $file->guessExtension();

        if ($file) {
            $file->move(
                $this->getParameter('rentals_directory'),
                $fileName
            );
            $car->setImage($fileName);
        }
    }

    /**
     * Finds and displays a car entity.
     *
     * @Route("display/{id}", name="single_car_show",methods={"GET"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Car $car
     * @return Response|null
     */
    public function singleShowAction(Car $car)   {


        return $this->render('car/car.html.twig', array(
            'car' => $car,

        ));
    }
}
