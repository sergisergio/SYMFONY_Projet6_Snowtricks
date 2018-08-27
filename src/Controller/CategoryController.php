<?php
/**
 * Created by PhpStorm.
 * User: leazygomalas
 * Date: 27/08/2018
 * Time: 16:10
 */

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * Ajouter une catégorie
     *
     * @Route("/category/add/", name="add_category")
     */
    public function addCategory(Request $request, ObjectManager $manager) {

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('createtrickpage');
        }
        return $this->render(
            'Category/createcategory.html.twig', [
            'formAddCategory' => $form->createView()
        ]);
    }
}