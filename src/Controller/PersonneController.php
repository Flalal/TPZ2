<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PersonneController extends Controller
{

    /**
     *  @Route("/personne/new", name="app_personnecontroller_new")
     */
    function new(){
        $em = $this->getDoctrine()->getManager();
        $p = new Personne("Flo", 21, true, new \DateTime("now"));

        $em->persist($p);
        $em->flush();
        $personnes = null;
        return $this->render("Personne/index.html.twig", ["personnes" => $personnes]);
    }

    /**
     *  @Route("/personne/index", name="app_personnecontroller_index")
     */
    function index(){
        $em = $this->getDoctrine()->getManager();
        $personnes = $em->getRepository(Personne::class)->findAll();
        return $this->render("Personne/index.html.twig",[ "personnes" => $personnes]);

    }

}