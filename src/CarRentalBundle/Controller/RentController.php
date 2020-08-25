<?php

namespace CarRentalBundle\Controller;

use CarRentalBundle\Entity\Rent;
use CarRentalBundle\Form\RentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RentController extends Controller
{
    /**
     * Lists all car entities.
     * @Security ("has_role('ROLE_ADMIN')")
     * @Route("admin/rents", name="rent_index",methods={"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rents = $em->getRepository('CarRentalBundle:Rent')->findAll();

        return $this->render('rent/index.html.twig', array(
            'rents' => $rents,
        ));
    }

    /**
     * Creates rent
     * @Route("admin/rents/new", name="rent_new",methods={"GET", "POST"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @return RedirectResponse|Response|null
     */
    public function newAction(Request $request)
    {
        $rents = new Rent();
        $form = $this->createForm(RentType::class, $rents);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rents);
            $em->flush();

            $this->addFlash('success', 'Successfully added rent!');

            return $this->redirectToRoute('rent_index');
        }

        return $this->render('rent/new.html.twig', array(
            'rents' => $rents,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a rent entity.
     *
     * @Route("admin/rents/{id}", name="rent_show",methods={"GET"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Rent $rent
     * @return Response|null
     */
    public function showAction(Rent $rent)
    {
        $deleteForm = $this->createDeleteForm($rent);

        return $this->render('rent/show.html.twig', array(
            'rent' => $rent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing car entity.
     *
     * @Route("admin/rents/{id}/edit", name="rent_edit",methods={"GET", "POST"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Rent $rents
     * @return RedirectResponse|Response|null
     */
    public function editAction(Request $request, Rent $rents)
    {
        $deleteForm = $this->createDeleteForm($rents);
        $editForm = $this->createForm('CarRentalBundle\Form\RentType', $rents);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rent_edit', array('id' => $rents->getId()));
        }

        return $this->render('rent/edit.html.twig', array(
            'rents' => $rents,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a car entity.
     *
     * @Route("admin/rents/{id}", name="rent_delete",methods={"DELETE"})
     * @Security ("has_role('ROLE_ADMIN')")
     * @param Request $request
     * @param Rent $rents
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Rent $rents)
    {
        $form = $this->createDeleteForm($rents);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rents);
            $em->flush();
        }

        return $this->redirectToRoute('rent_index');
    }

    /**
     * Creates a form to delete a car entity.
     * @Security ("has_role('ROLE_ADMIN')")
     *
     * @param Rent $rents
     * @return FormInterface The form
     */
    private function createDeleteForm(Rent $rents)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rent_delete', array('id' => $rents->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
