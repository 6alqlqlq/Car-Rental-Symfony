<?php

namespace CarRentalBundle\Controller;

use CarRentalBundle\Entity\Car;
use CarRentalBundle\Entity\Orders;
use CarRentalBundle\Form\OrdersType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/user/order")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/new/{carid}", name="orders_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param Request $request
     * @param $carid
     * @return RedirectResponse|Response|null
     */
    public function newAction(Request $request,$carid)
    {
        $user = $this->getUser();
        $id = $request->get('carid');
        $order = new Orders();
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $order->setUserid($user->getId());
            $order->setCarid($id);
            $order->setPickUpDate(new DateTime);
            $order->setReturnDate(new DateTime);

            $entityManager->persist($order);
            $entityManager->flush();



            $this->addFlash('success', 'Order completed successfully');


            return $this->redirectToRoute('homepage');
        }
        $id = $request->get('carid');


        return $this->render('orders/new.html.twig', [
            'id' =>$id ,
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security ("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/my_orders",name="my_orders",methods={"GET"})
     * @return Response|null
     */
    public function getAllOrdersByUser()
    {
        $em = $this->getDoctrine()->getManager();

        $orders = $em->getRepository('CarRentalBundle:Orders')->findBy(['userid' => $this->getUser()]);

        return $this->render('orders/myOrders.html.twig', array(
                'orders' => $orders,

            ));
        }




}
