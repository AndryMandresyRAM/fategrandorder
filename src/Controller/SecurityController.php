<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    
    private $em;

    private $encoder;
    
    
    public function __construct(ObjectManager $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }
        /** 
         *  @Route("/login", name="login")
         */
     public function login(AuthenticationUtils $au)
     {
        $lastUsername = $au->getLastUsername();
        $error = $au->getLastAuthenticationError();
        return $this->render('security/login.html.twig', [
             'last_username' => $lastUsername,
             'error' => $error
        ]);
     }
    /**
     * Undocumented function
     * @Route("/login/create", name="login.create")
     * @param Request $request
     * @return void
     */
    
    public function new(Request $request)
    {
        $user = new User($this->encoder);
        $form1 = $this->createForm(UserType::class, $user);
        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Compte crée avec succès');
            return $this->redirectToRoute('login');
        }

        return $this->render('security/new.html.twig', [
            'servant' => $user,
            'form' => $form1->createView()
        ]);
    } 
}