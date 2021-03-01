<?php
	
	namespace App\Controller;
	
	use App\Entity\Fermier;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	
	class FermierController extends AbstractController {
		/**
		 * @Route("/fermier", name="fermier")
		 */
		public function index(): Response {
			// on initialise un objet pour gérer nos Fermiers
			$fermierRepository = $this->getDoctrine()->getRepository(Fermier::class);
			// on utilise cet objet pour Récupérer la liste de nos fermiers
			$fermierList = $fermierRepository->findAll();
			
			return $this->render('fermier/index.html.twig', [
			  'fermierList' => $fermierList
			]);
		}
		
		/**
		 * @Route("/fermier/{name}", name="fermierDetail")
		 * @param string $name
		 * @return Response
		 */
		public function detail(string $name): Response {
			$fermierRepository = $this->getDoctrine()->getRepository(Fermier::class);
			// On récupère UN fermier 
			$fermier = $fermierRepository->findOneBy(["prenom" => htmlspecialchars($name)]);
			
			return $this->render('fermier/detail.html.twig', [
			  "fermier" => $fermier,
				"pouletList"=> $fermier->getPoulets()
			]);
		}
	}
