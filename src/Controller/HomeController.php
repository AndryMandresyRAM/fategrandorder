<?php

namespace App\Controller;

#use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Repository\ServantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /*
    * @var Environment
    */

    /* 
    *@Route("/", name="home")
    *@return Response
    */
    
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig=$twig;
    }
    public function index(ServantRepository $repository):Response
    {
        $servants = $repository->findLatest();
        return $this->render('pages/HomeController.html.twig',
        [
           'servants' => $servants 
        ]);
    }
}

?>