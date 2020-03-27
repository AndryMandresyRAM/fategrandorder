<?php

namespace App\Controller\admin;

use App\Repository\MasterRepository;
use App\Entity\Master;
use App\Form\MasterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminMasterController extends AbstractController
{
    private $repository;
    /* private $request; */
    
    private $em;

    public function __construct(MasterRepository $repository, ObjectManager $em/* , Request $request */)
    {
        $this->repository = $repository;
        $this->em = $em;
        /* $this->request = $request; */
    }
    
    
    /**
     * @Route("/admin/master", name="admin.master")
     */
    
    public function index(): Response
    {
        $masters = $this->repository->findAll();
        return $this->render('admin/master/index.html.twig'/* , compact('Masters') */, [
            'current_menu' => 'adminmaster',
            'masters' => $masters
        ]);
    }


     /**
     * @Route("/admin/master/create", name="admin.master.new")
     */

    public function new(Request $request){
        $master = new Master();
        $form = $this->createForm(MasterType::class, $master);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($master);
            $this->em->flush();
            $this->addFlash('success', 'Master crée avec succès');
            return $this->redirectToRoute('admin.master');
        }

        return $this->render('admin/master/new.html.twig', [
            'mastere' => $master,
            'form' => $form->createView()
        ]);
    }
    
     /**
     * @Route("/admin/master/edit", name="admin.master.edit")
     */

    public function edit(Master $Master, Request $request): Response
    {
        /* $Master = $this->repository->findAll(); */
        $form = $this->createForm(MasterType::class, $Master);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Master modifié avec succès');
            return $this->redirectToRoute('admin.master');
        }

        return $this->render('admin/master/edit.html.twig', [
            'master' => $Master,
            'form'=>$form->createView()
        ]);
    }

    /** 
     * @Route("/admin/master/{id}", name="admin.master.delete", methods="DELETE")
     * */ 
    
    

    public function delete(Master $Master, Request $request)
    {
        if($this->isCsrfTokenValid('delete'.$Master->getId(), $request->get('_token'))){
            $this->em->remove($Master);
            $this->em->flush();
            $this->addFlash('success', 'Master supprimé avec succès');
            return $this->redirectToRoute('admin.master');
        }
        
    }
}
