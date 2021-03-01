<?php

namespace App\Controller;

use App\Entity\Fermier;
use App\Entity\Poulet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")      // ou #[Route("/",name:"home")]
     */
    public function index(): Response
    {
	    // on initialise un objet pour gérer nos Poulets
	    $pouletRepository = $this->getDoctrine()->getRepository(Poulet::class);
	    // on utilise cet objet pour Récupérer la liste de nos poulets
	    $pouletList = $pouletRepository->findAll();
	
	    // on initialise un objet pour gérer nos Fermiers
	    $fermierRepository = $this->getDoctrine()->getRepository(Fermier::class);
	    // on utilise cet objet pour Récupérer la liste de nos fermiers
	    $fermierList = $fermierRepository->findAll();
	
	    return $this->render('home/index.html.twig', [
		    "pouletList" => $pouletList,
		    "fermierList" => $fermierList
        ]);
    }
    
}
