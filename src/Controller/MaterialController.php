<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 13:18
 */

namespace App\Controller;

use App\Entity\Material;

use App\Form\MaterialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Serialization\Person;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends Controller
{
    /**
     * @Route("/material/new", name="app_material_newmaterial")
     */
    function newMaterial(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $material = new Material();
        $form = $this->createForm(MaterialType::class,$material);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entity = $form->getData();
            $em->persist($entity);
            $em->flush();


            $this->container->get('session')->getFlashBag()->add("success_material","Material add");

            $router = $this->container->get('router');
            $url = $router->generate('app_material_index');
            return new RedirectResponse($url,$status=302);
        }
        else{
            $this->container->get('session')->getFlashBag()->add("error_material","Material non add");

        }

        return $this->render("Material/new.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/material", name="app_material_index")
     */
    function index()
    {

        $this->container->get('session')->getFlashBag()->add("nice","teste");
        $em = $this->getDoctrine()->getManager();
        $materials = $em->getRepository(Material::class)->findAll();
        return $this->render("Material/index.html.twig", ["materials" => $materials]);

    }

    /**
     * @Route("/material/edit/{id}", name="app_material_edit")
     */
    function edit(Request $request, Material $material)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->container->get('session')->getFlashBag()->add("success_material", "material edit");
            $router = $this->container->get('router');
            $url = $router->generate('app_material_index');
            return new RedirectResponse($url, $status = 302);
        } else {
            $this->container->get('session')->getFlashBag()->add("error_material", "material non edit");
        }
        return $this->render("Material/edit.html.twig", ['form' => $form->createView(),]);
    }

    /**
     * @Route("/material/delete/{id}", name="app_material_delete")
     */
    public function deleteMaterialAction(Material $material)
    {
        $this->getDoctrine()->getManager()->remove($material);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('app_material_index');
    }
}