<?php

namespace CarRentalBundle\Controller;

use CarRentalBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response|null
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
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
        return $this->render('car/display.html.twig',['car'=>$car]);
    }
}
