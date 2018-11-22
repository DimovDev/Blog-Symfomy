<?php

namespace BlogBundle\Form;


use BlogBundle\BlogBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use BlogBundle\Entity\User;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
	$builder->add("email",TextType::class)
		->add("password",TextType::class)
		->add("fullName",TextType::class);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
$resolver->setDefaults(array('data_class'=> User::class));
	}


}
