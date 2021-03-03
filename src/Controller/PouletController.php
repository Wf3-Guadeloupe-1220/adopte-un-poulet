<?php
	
	namespace App\Controller;
	
	use App\Entity\Adoption;
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
			
			// on récupère l'objet adoption de notre poulet
			$adoption = $poulet->getAdoption();
		
			//si l'objet est null on crée un nouvel objet adoption
			if($adoption === null){
				$adoption = new Adoption();
				// on attribue le poulet actuel a cette nouvelle adoption
				$adoption->setPoulet($poulet);
			}
			
			//créer notre formulaire d'adoption
			$form = $this->createForm(AdoptionType::class, $adoption);
			
			//traiter la validation du formulaire
			$form->handleRequest($request);
			// si le formulaire est soumis et qu'il est valide
			if ($form->isSubmitted() && $form->isValid()) {
				//traitement des informations du formulaire
				//récupère le manager (entité symfony qui execute les requetes BDD)
				$manager = $this->getDoctrine()->getManager();
				
				//attribue l'utilisateur actuel en tant que Famille du poulet dans l'objet ADOPTION
				$adoption->setFamille($this->getUser());
				//attribue la date actuelle a notre objet adoption
				$adoption->setDate(new \DateTime());
				
				//dis à doctrine d'enregistrer notre adoption dans la base
				$manager->persist($adoption);
				
				//execute la requete en attente
				$manager->flush();
			}
			
			return $this->render('poulet/detail.html.twig', [
			  "poulet" => $poulet,
			  "nombreFreres" => count($autresPoulets) - 1,
			  "form" => $form->createView(),
			]);
		}
	}
