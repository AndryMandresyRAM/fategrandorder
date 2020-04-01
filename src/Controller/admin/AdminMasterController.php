<?php

namespace App\Controller\admin;

use App\Repository\MasterRepository;
use App\Entity\Master;
use App\Entity\Servant;
use App\Entity\ServantSearch;
use App\Form\MasterType;
use App\Repository\ServantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdminMasterController extends AbstractController
{
    private $repository;

    private $servantrepository;
    /* private $request; */
    
    private $em;

    public function __construct(MasterRepository $repository, ServantRepository $servantrepository, ObjectManager $em/* , Request $request */)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->servantrepository = $servantrepository;
        /* $this->request = $request; */
    }
    
    
    /**
     * @Route("/admin/master", name="admin.master")
     */
    
    public function index(): Response
    {
        $masters = $this->repository->findAll();
        /* $servants[] = "";
        foreach ($masters as $master) {
            $servant = $this->servantrepository->getServant($master);
            $servants->array_push($servant);
        } */



        return $this->render('admin/master/index.html.twig'/* , compact('Masters') */, [
            'current_menu' => 'adminmaster',
            /* '' */
            'masters' => $masters
        ]);
    }

    /**
     * @Route("/admin/master-{id}", name="admin.master.masterservantshow")
     */

    public function showservant(Master $master): Response
    {
        $masters = $this->repository->findAll();
        $servants = $this->servantrepository->getServant($master);
        return $this->render('admin/master/servantmaster.html.twig'/* , compact('Masters') */, [
            'current_menu' => 'adminmaster',
            /* '' */
            'masters'=>$masters,
            'master' =>$master,
            'servants' => $servants
        ]);
    }
    
    
     /**
     * @Route("/admin/master/create", name="admin.master.new")
     */

    public function new(Request $request){
        /* $servant = new Servant(); */
        $master = new Master();/* 
        $servant->getMaster();
        $master->addServant($servant); */
        /* $servant = new Servant();
         */
        $form = $this->createForm(MasterType::class, $master);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            /* $servant->setMaster($master); */
            /* $servant->setMaster($master); */
            $this->em->persist($master);
            /* $this->em->persist($servant); */
            $this->em->flush();
            $this->addFlash('success', 'Master crée avec succès');
            return $this->redirectToRoute('admin.master');
        }

        return $this->render('admin/master/new.html.twig', [
            'master' => $master,
            'form' => $form->createView()
        ]);
    }
    
     /**
     * @Route("/admin/master/edit{id}", name="admin.master.edit")
     */

    public function edit(Master $master, Request $request): Response
    {
        /* $Master = $this->repository->findAll(); */
        /* $servant = new Servant();
        $servant->setMaster($master); */
        /* $servant = new Servant();
        $servant->getMaster();
        $servant->setMaster($master);
        $master->addServant($servant); */
        /* $master->addServant($servant/* $servant *//* ); */ 
        $form = $this->createForm(MasterType::class, $master);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /* $this->em = $this->getDoctrine()->getManager(); */
            /* $servant->setMaster($master); */
            /* $this->em->persist($servant); */
            $this->em->flush();
            $this->addFlash('success', 'Master modifié avec succès');
            return $this->redirectToRoute('admin.master');
        }

        return $this->render('admin/master/edit.html.twig', [
            'master' => $master,
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

    /**
     * @Route("/admin/master/servant{id}", name="admin.master.servant")
     *
     * @return void
     */
    public function masterServant(Master $master){
        $search = new ServantSearch();
        /* $search=null; */
        $servants = $this->servantrepository->findAllVisible($search);

        return $this->render('admin/master/masterservant.html.twig',[
            'current_menu'=> 'adminmaster',
            'master' => $master,
            'servants' => $servants
        ]);
    }

    /**
     * @Route("/admin/master/servantOK/{idmaster} - {idservant}", name="admin.master.servantOK")
     */

    public function assignservant($idmaster, $idservant)
    {
        $master = $this->repository->find($idmaster);
        $servant = $this->servantrepository->find($idservant);
        $master->addServant($servant);
        $this->em->persist($master);
        $this->em->flush();
        $this->addFlash('success', 'Servant lié avec succès');
        return $this->redirectToRoute('admin.master');
    }

}
