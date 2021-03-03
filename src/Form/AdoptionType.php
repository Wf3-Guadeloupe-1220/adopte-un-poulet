<?php
	
	namespace App\Form;
	
	use App\Entity\Adoption;
	use App\Entity\Famille;
	use App\Entity\Poulet;
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\MoneyType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class AdoptionType extends AbstractType {
		public function buildForm(FormBuilderInterface $builder, array $options) {
			$builder
//			  ->add('poulet', EntityType::class, ["class" => Poulet::class, "choice_label" => "prenom"])
//			  ->add('famille', EntityType::class, ["class" => Famille::class, "choice_label" => "prenom"])
//			  ->add('date')
			  ->add('montantMensuel', MoneyType::class);
		}
		
		public function configureOptions(OptionsResolver $resolver) {
			$resolver->setDefaults([
			  'data_class' => Adoption::class,
			]);
		}
	}
