<?php

namespace App\Controller\admin;

use App\Repository\ServantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Servant;
use App\Form\ServantType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class AdminServantController extends AbstractController{
    
    private $repository;
    /* private $request; */

    public function __construct(ServantRepository $repository, ObjectManager $em/* , Request $request */)
    {
        $this->repository = $repository;
        $this->em = $em;
        /* $this->request = $request; */
    }


    /* 
    *
    *@Route("/admin", name="admin.servant.index")
    *
     */
    public function index(): Response
    {
        $servants = $this->repository->findAll();
        return $this->render('admin/servant/index.html.twig'/* , compact('servants') */, [
            'current_menu' => 'admin',
            'servants' => $servants
        ]);
    }


    public function new(Request $request){
        $servant = new Servant();
        $form = $this->createForm(ServantType::class, $servant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($servant);
            $this->em->flush();
            $this->addFlash('success', 'Servant crée avec succès');
            return $this->redirectToRoute('admin.servant.index');
        }

        return $this->render('admin/servant/new.html.twig', [
            'servant' => $servant,
            'form' => $form->createView()
        ]);
    }
    
     
    public function edit(Servant $servant, Request $request): Response
    {
        /* $servant = $this->repository->findAll(); */
        $form = $this->createForm(ServantType::class, $servant);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Servant modifié avec succès');
            return $this->redirectToRoute('admin.servant.index');
        }

        return $this->render('admin/servant/edit.html.twig', [
            'servant' => $servant,
            'form'=>$form->createView()
        ]);
    }

    /** 
     * @Route("/admin/servant/{id}", name="admin.servant.delete", methods="DELETE")
     * */ 
    
    

    public function delete(Servant $servant, Request $request)
    {
        if($this->isCsrfTokenValid('delete'.$servant->getId(), $request->get('_token'))){
            $this->em->remove($servant);
            $this->em->flush();
            $this->addFlash('success', 'Servant supprimé avec succès');
            return $this->redirectToRoute('admin.servant.index');
        }
        
    }

}