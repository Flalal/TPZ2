<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 13:18
 */

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Material;

use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends Controller
{
    /**
     * @Route("/item/new", name="app_item_newitem")
     */
    function newItem(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entity = $form->getData();
            $em->persist($entity);
            $em->flush();


            $this->container->get('session')->getFlashBag()->add("success_item", "item add");

            $router = $this->container->get('router');
            $url = $router->generate('app_item_index');
            return new RedirectResponse($url,$status=302);
        }
        else{
            $this->container->get('session')->getFlashBag()->add("error_item", "item non add");

        }

        return $this->render("Item/new.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/item", name="app_item_index")
     */
    function index()
    {

        $this->container->get('session')->getFlashBag()->add("nice","teste");
        $em = $this->getDoctrine()->getManager();
        $materials = $em->getRepository(Item::class)->findAll();
        return $this->render("Item/index.html.twig", ["items" => $materials]);

    }

    /**
     * @Route("/item/edit/{id}", name="app_item_edit")
     */
    function edit(Request $request, Item $material)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ItemType::class, $material);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->container->get('session')->getFlashBag()->add("success_item", "item edit");
            $router = $this->container->get('router');
            $url = $router->generate('app_item_index');
            return new RedirectResponse($url, $status = 302);
        } else {
            $this->container->get('session')->getFlashBag()->add("error_item", "item non edit");
        }
        return $this->render("Item/edit.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/item/delete/{id}", name="app_item_delete")
     */
    public function deleteMaterialAction(Item $item)
    {
        $this->getDoctrine()->getManager()->remove($item);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('app_item_index');
    }
}