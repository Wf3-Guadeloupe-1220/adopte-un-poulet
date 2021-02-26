<?php

namespace App\Controller;

use App\Entity\Poulet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PouletController extends AbstractController
{
    /**
     * @Route("/poulet", name="poulet")
     */
    public function index(): Response
    {
    	// on initialise un objet pour gérer nos Poulets
    	$pouletRepository = $this->getDoctrine()->getRepository(Poulet::class);
    	// on utilise cet objet pour Récupérer la liste de nos poulets
    	$pouletList = $pouletRepository->findAll();
    	
        return $this->render('poulet/index.html.twig', [
            'controller_name' => 'PouletController',
	        'pouletList' => $pouletList
        ]);
    }
    
    
}
