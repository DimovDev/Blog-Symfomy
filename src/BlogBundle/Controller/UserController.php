<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Role;
use BlogBundle\Entity\User;
use BlogBundle\Form\UserType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
	/**
	 * @Route("/register",name="user_register")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function registerAction(Request $request)
	{
		$user= new User();
		$form=$this->createForm(UserType::class,$user);
		$form->handleRequest($request);

		if ($form->isSubmitted()){
			$password=$this->get('security.password_encoder')
				->encodePassword($user,$user->getPassword());

			$roleRepository=$this->getDoctrine()
				->getRepository(Role::class);
			if ( $this->getCountOfRegisteredUsers() === 0) {
				$userRole = $roleRepository->findOneBy(['name' => 'ROLE_ADMIN']);
			} else {
				$userRole = $roleRepository->findOneBy(['name' => 'ROLE_USER']);
			}
//			$userRole=$roleRepository->findOneBy(['name'=>'ROLE_USER']);
				$user->addRole($userRole);
			$user->setPassword($password);
			$em=$this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();
			return $this->redirectToRoute('security_login');
		}
		return $this->render('users/register.html.twig', array('form' => $form->createView()));
	}
	/**
	 *  @Security("is_granted('IS_AUTHENTICATED_FULLY')")
	 * @Route("/profile",name="user_profile")
	 */
	public function profile()
	{
		$userId = $this->getUser()->getId();

		$user = $this
			->getDoctrine()
			->getRepository(User::class)
			->find($userId);

		return $this->render('users/profile.html.twig',
			['user' => $user]);
	}
	private function getCountOfRegisteredUsers(): int
	{
		return \count($this->getDoctrine()->getRepository(User::class)->findAll());
	}
}
