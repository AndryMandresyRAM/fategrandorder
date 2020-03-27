<?php

namespace App\Controller;

use App\Entity\MasterSearch;
use App\Form\MasterSearchType;
use App\Repository\MasterRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MasterController extends AbstractController
{

    private $repository;

    private $em;

    public function __construct(MasterRepository $repository, ObjectManager $em){

        $this->repository = $repository;
        $this->em = $em;

    }
    /**
     * @Route("/master", name="master")
     */
    public function index(Request $request)
    {
        $search = new MasterSearch();

        $form = $this->createForm(MasterSearchType::class, $search);
        $form->handleRequest($request);

        $masters = $this->repository->findAllVisible($search);



        return $this->render('master/index.html.twig', [
            'current_menu' => 'master',
            'masters' => $masters,
            'form' => $form->createView()
        ]);
    }
}
