<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 13:18
 */

namespace App\Controller;

use App\Entity\Inventory;

use App\Form\InventoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends Controller
{
    /**
     * @Route("/inventory/new", name="app_inventory_newinventory")
     */
    function newInventory(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $inventory = new Inventory();
        $form = $this->createForm(InventoryType::class,$inventory);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entity = $form->getData();

            $calcul = new \App\Calculate\Inventory($em);
            $calcul->setPersonne($entity->getPersonne());
            $calcul->setInventory($entity);

            if($calcul->calcul()){
                $em->persist($entity);
                $em->flush();
                $this->container->get('session')->getFlashBag()->add("success__inventory","L'invotory a été crée");

            }
            else{
                $this->container->get('session')->getFlashBag()->add("error__inventory","TROP LOURD");

            }


            $router = $this->container->get('router');
            $url = $router->generate('app_inventory_index');
            return new RedirectResponse($url,$status=302);

        }
        return $this->render("Inventory/new.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/inventory", name="app_inventory_index")
     */
    function index()
    {
        $em = $this->getDoctrine()->getManager();
        $inventory = $em->getRepository(Inventory::class)->findAll();
        return $this->render("Inventory/index.html.twig", ["inventories" => $inventory]);

    }

    /**
     * @Route("/inventory/edit/{id}", name="app_inventory_edit")
     */
    function edit(Request $request, Inventory $inventory)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(InventoryType::class, $inventory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->container->get('session')->getFlashBag()->add("success_inventory", "inventory edit");
            $router = $this->container->get('router');
            $url = $router->generate('app_inventory_index');
            return new RedirectResponse($url, $status = 302);
        } else {
            $this->container->get('session')->getFlashBag()->add("error_inventory", "inventory non edit");
        }
        return $this->render("Inventory/edit.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/inventory/delete/{id}", name="app_inventory_delete")
     */
    public function deleteUserAction(Inventory $inventory)
    {
        $this->getDoctrine()->getManager()->remove($inventory);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('app_inventory_index');
    }
}