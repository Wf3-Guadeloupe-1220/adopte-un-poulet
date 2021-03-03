<?php
	
	namespace App\Controller;
	
	use App\Entity\Poulet;
	use App\Form\AdoptionType;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
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
		public function detail(string $name, Request $request): Response {
			$pouletRepository = $this->getDoctrine()->getRepository(Poulet::class);
			// On récupère UN poulet 
			$poulet = $pouletRepository->findOneBy(["prenom" => htmlspecialchars($name)]);
			
			// Récupère le nombre de poulets de notre fermier
			$autresPoulets = $poulet->getFermier()->getPoulets();
			
			//créer notre formulaire d'adoption
			$form = $this->createForm(AdoptionType::class, $this->getUser());
			
			//traiter la validation du formulaire
			$form->handleRequest($request);
			// si le formulaire est soumis et qu'il est valide
			if ($form->isSubmitted() && $form->isValid()) {
				//traitement des informations du formulaire
				//récupère le manager (entité symfony qui execute les requetes BDD)
				$manager = $this->getDoctrine()->getManager();
				
				//attribue l'utilisateur actuel en tant que Famille du poulet
				$poulet->setFamille($this->getUser());
				//dis à doctrine de mettre à jour notre Parent dans la base
				$manager->persist($this->getUser());
				//dis à doctrine d'enregistrer notre poulet dans la base
				$manager->persist($poulet);
				//execute les requetes en attente
				$manager->flush();
			}
			
			return $this->render('poulet/detail.html.twig', [
			  "poulet" => $poulet,
			  "nombreFreres" => count($autresPoulets) - 1,
			  "form" => $form->createView(),
			]);
		}
	}
