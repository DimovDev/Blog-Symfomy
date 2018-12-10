<?php
namespace BlogBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use BlogBundle\{Entity\Role, Entity\User, AdminType, Form\UserType};
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
class AdminController extends Controller
{


	/**
	 * @Route("/admin_my", name="all_users")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction()
	{
		$allUsers = $this
			->getDoctrine()
			->getRepository(User::class)
			->findAll();
		$allRoles = $this
			->getDoctrine()
			->getRepository(Role::class)
			->findAll();
		return $this->render('admin/index.html.twig',
			['allUsers' => $allUsers ,'allRoles'=>$allRoles]);
	}

	/**
	 * @Route("/user_profile/{id}", name="admin_user_profile")
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function userProfile($id)
	{
		$user = $this
			->getDoctrine()
			->getRepository(User::class)
			->find($id);

		return $this->render('admin/user_profile.html.twig',
			['user' => $user]);
	}
}

