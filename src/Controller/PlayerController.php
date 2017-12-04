<?php

namespace App\Controller;

use App\Entity\Personne;

use App\Entity\Player;
use App\Entity\PlayerItem;
use App\Form\PersonneType;
use App\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlayerController extends Controller
{

    /**
     * @Route("/player/new", name="app_player_new")
     */
    function new(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entity = $form->getData();
            $em->persist($player);
            $em->flush();



            $this->container->get('session')->getFlashBag()->add("success_player", "Player add");

            $router = $this->container->get('router');
            $url = $router->generate('app_player_index');
            return new RedirectResponse($url,$status=302);
        }
        else{
            $this->container->get('session')->getFlashBag()->add("error_player", "player non add");

        }

        return $this->render("Player/new.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/player", name="app_player_index")
     */
    function index()
    {
        $em = $this->getDoctrine()->getManager();
        $personnes = $em->getRepository(Player::class)->findAll();
        return $this->render("Player/index.html.twig", ["players" => $personnes]);

    }

    /**
     * @Route("/player/edit/{id}", name="app_player_edit")
     */
    function edit(Request $request, Player $player)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->container->get('session')->getFlashBag()->add("success_player", "player edit");
            $router = $this->container->get('router');
            $url = $router->generate('app_player_index');
            return new RedirectResponse($url, $status = 302);
        } else {
            $this->container->get('session')->getFlashBag()->add("error_player", "player non edit");
        }
        return $this->render("Player/edit.html.twig", ['form' => $form->createView(),]);
    }


    /**
     * @Route("/player/delete/{id}", name="app_player_delete")
     */
    public function deletePersonneAction(Player $player)
    {
        $this->getDoctrine()->getManager()->remove($player);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('app_player_index');
    }


    /**
     * @Route("/player/show/{id}", name="app_player_show")
     */
    function show(Request $request, Player $player)
    {
        $em = $this->getDoctrine()->getManager();
        $playerItems = $em->getRepository(PlayerItem::class)->findBy(['player' => $player]);
        return $this->render("Player/show.html.twig", ['player' => $player, 'playerItems' => $playerItems]);
    }

}