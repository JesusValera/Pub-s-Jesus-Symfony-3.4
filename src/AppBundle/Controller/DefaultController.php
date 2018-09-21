<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Tapa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /*return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);*/

        $repository = $this->getDoctrine()->getRepository(Tapa::class);
        $tapas = $repository->findByTop(1);

        return $this->render('default/index.html.twig', [
            'tapas' => $tapas
        ]);
    }

    /**
     * @Route("/about", name="about_us")
     */
    public function aboutUsAction(Request $request)
    {
        return $this->render('default/about_us.html.twig');
    }

    /**
     * @Route("/contact/{location}", name="contact")
     */
    public function contactAction($location = 'Murcia Valencia Madrid')
    {
        return $this->render('default/contact.html.twig', [
            'location' => explode(' ', $location)
        ]);
    }

    /**
     * @Route("/tapa/{id}", name="detail_tapa")
     */
    public function tapaDetailAction($id = null)
    {
        $repository = $this->getDoctrine()->getRepository(Tapa::class);
        $tapa = $repository->find($id);

        if (!isset($tapa)) {
            throw $this->createNotFoundException('Tapa not found');
        }

        return $this->render('default/detail_tapa.html.twig', [
            'tapa' => $tapa
        ]);
    }

    /**
     * @Route("/category/{id}", name="detail_category")
     */
    public function categoryDetailAction($id = null)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $category = $repository->find($id);

        if (!isset($category)) {
            throw $this->createNotFoundException('Tapa not found');
        }

        return $this->render('default/detail_category.html.twig', [
            'category' => $category
        ]);
    }

}
