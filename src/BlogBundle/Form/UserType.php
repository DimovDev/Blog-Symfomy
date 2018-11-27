<?php

namespace BlogBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use BlogBundle\Entity\User;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
	$builder->add('email',TextType::class)
		     ->add('password', RepeatedType::class, array(
			'first_options'  => array('label' => 'Password'),
			'second_options' => array('label' => 'Repeat Password')))

		->add('fullName',TextType::class);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
$resolver->setDefaults(array('data_class'=> User::class));
	}


}
