<?php

namespace App\Controller;

use App\Entity\Personne;

use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PersonneController extends Controller
{

    /**
     * @Route("/personne/new", name="app_personnecontroller_new")
     */
    function new(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$p = new Personne("Flo", 21, true, new \DateTime("now"));
        $personne = new Personne();
        $personne->setName("Flo");
        $personne->setAge(21);
        $personne->setCreatedAt(new \DateTime("now"));
        $personne->setVisible(true);
        /*
                $em->persist($p);
                $em->flush();
        */
        /*
        $form = $this->createFormBuilder($personne)
            ->add('name', TextType::class)
            ->add('age', IntegerType::class)
            ->add('createdAt', DateType::class)
            ->add('visible')
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();
        */
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class,$personne);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entity = $form->getData();
            $em->persist($entity);
            $em->flush();
        }

        return $this->render("Personne/new.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/personne/index", name="app_personnecontroller_index")
     */
    function index()
    {
        $em = $this->getDoctrine()->getManager();
        $personnes = $em->getRepository(Personne::class)->findAll();
        return $this->render("Personne/index.html.twig", ["personnes" => $personnes]);

    }

    /**
     * @Route("/personne/edit", name="app_personnecontroller_edit")
     */
    function edit()
    {
        $em = $this->getDoctrine()->getManager();
        $personnes = $em->getRepository(Personne::class)->findAll();
        return $this->render("Personne/edit.html.twig", ["personnes" => $personnes]);

    }

}