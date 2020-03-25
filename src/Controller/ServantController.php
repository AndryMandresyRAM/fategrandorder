<?php

namespace App\Controller;

use App\Entity\Servant;
use App\Entity\ServantSearch;
use App\Form\ServantSearchType;
use App\Repository\ServantRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServantController extends AbstractController
{

    /* 
    *@Route("/servant", name="servant.index")
    *@return Response
    */
    private $repository;

    private $em;

    public function __construct(ServantRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    public function index(Request $request) : Response
    {
        /* $servant = new Servant();
        $servant->setName('Mordred')
        ->setClass('Saber')
        ->setNoblePhantasme('Clarent Blood Arthur');

        $em = $this->getDoctrine()->getManager();
        $em->persist($servant);
        $em->flush(); */

        
        
        /* $repository = $this->getDoctrine()->getRepository(Servant::class);
        dump($repository); */

        $search = new ServantSearch();
        $form = $this->createForm(ServantSearchType::class, $search);
        $form->handleRequest($request);

        $servants = $this->repository->findAllVisible($search);

        $servant = $this->repository->findClass();
        /* $servant[0]->setName("Mordred, the knight of rebellion");
        $this->em->flush(); */
        dump($servant);

        return $this->render("pages/ServantController.html.twig", [
            'current_menu' => 'servant',
            'servants' => $servants,
            'form' => $form->createView()

        ]);
    }

    public function show(Servant $servant): Response
    {
        /* $servant = $this->repository->find($id); */
        return $this->render("pages/show.html.twig", [
            'servant' => $servant,
            'current_menu' => 'servant'
        ]);
    }
}