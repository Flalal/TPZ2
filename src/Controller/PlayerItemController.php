<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 13:18
 */

namespace App\Controller;

use App\Entity\Inventory;

use App\Entity\PlayerItem;
use App\Form\InventoryType;
use App\Form\PlayerItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerItemController extends Controller
{
    /**
     * @Route("/playeritem/new", name="app_playeritem_newplayeritem")
     */
    function newInventory(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $playerItem = new PlayerItem();
        $form = $this->createForm(PlayerItemType::class, $playerItem);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entity = $form->getData();
            $em->persist($entity);
            $em->flush();


            $router = $this->container->get('router');
            $url = $router->generate('app_playeritem_index');
            return new RedirectResponse($url, $status = 302);

        }
        return $this->render("PlayerItem/new.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/playeritem", name="app_playeritem_index")
     */
    function index()
    {
        $em = $this->getDoctrine()->getManager();
        $playerItems = $em->getRepository(PlayerItem::class)->findAll();
        return $this->render("PlayerItem/index.html.twig", ["playerItems" => $playerItems]);

    }

    /**
     * @Route("/inventory/edit/{id}", name="app_inventory_edit")
     */
    function edit(Request $request, PlayerItem $playeritems)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PlayerItemType::class, $playeritems);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->container->get('session')->getFlashBag()->add("success_playeritem", "playeritem edit");
            $router = $this->container->get('router');
            $url = $router->generate('app_playeritem_index');
            return new RedirectResponse($url, $status = 302);
        } else {
            $this->container->get('session')->getFlashBag()->add("error_playeritem", "playeritem non edit");
        }
        return $this->render("PlayerItem/edit.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/playeritem/delete/{id}", name="app_playeritem_delete")
     */
    public function deleteInventoryAction(PlayerItem $playeritem)
    {
        $this->getDoctrine()->getManager()->remove($playeritem);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('app_$playeritem_index');
    }
}