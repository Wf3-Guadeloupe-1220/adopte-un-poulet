<?php
	
	namespace App\Controller;
	
	use App\Entity\Poulet;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	
	class PouletController extends AbstractController {
		/**
		 * @Route("/poulet", name="poulet")
		 */
		public function index(): Response {
			// on initialise un objet pour gérer nos Poulets
			$pouletRepository = $this->getDoctrine()->getRepository(Poulet::class);
			// on utilise cet objet pour Récupérer la liste de nos poulets
			$pouletList = $pouletRepository->findAll();
			
			return $this->render('poulet/index.html.twig', [
			  'pouletList' => $pouletList
			]);
		}
		
		/**
		 * @Route("/poulet/{name}", name="pouletDetail")
		 * @param string $name
		 * @return Response
		 */
		public function detail(string $name): Response {
			$pouletRepository = $this->getDoctrine()->getRepository(Poulet::class);
			// On récupère UN poulet 
			$poulet = $pouletRepository->findOneBy(["prenom" => htmlspecialchars($name)]);
			
			// Récupère le nombre de poulets de notre fermier
			$autresPoulets= $poulet->getFermier()->getPoulets();
			
			return $this->render('poulet/detail.html.twig', [
			  "poulet" => $poulet,
			  "nombreFreres"=> count($autresPoulets) - 1
			]);
		}
	}
