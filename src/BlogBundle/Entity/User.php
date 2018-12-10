<?php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;
	/**
	 * @var ArrayCollection
	 *
	 * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\Role",inversedBy="users")
	 * @ORM\JoinTable(name="user_roles", joinColumns={@ORM\JoinColumn(name="user_id",referencedColumnName="id")},inverseJoinColumns={@ORM\JoinColumn(name="role_id",referencedColumnName="id")})
	 */
private $roles;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

	/**
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Article",mappedBy="author")
	 */
	private $articles;

	public function __construct()
	{
		$this->articles=new ArrayCollection();
		$this->roles=new ArrayCollection();
	}
	/**
	 * @return ArrayCollection
	 */
	public function getArticles()
	{
		return $this->articles;
	}

	/**
	 * @param Article $article
	 * @return User
	 */
	public function addPost( Article $article)
	{
		$this->articles[] = $article;
		return $this;
	}


	/**
	 * Returns the roles granted to the users.
	 *
	 *     public function getRoles()
	 *     {
	 *         return array('ROLE_USER');
	 *     }
	 *
	 * Alternatively, the roles might be stored on a ``roles`` property,
	 * and populated in any number of different ways when the users object
	 * is created.
	 *
	 * @return (Role|string)[] The users roles
	 */
	public function getRoles()
	{
		$stringRoles=[];
		foreach ($this->roles as $role){
			/**
			 * @var $role Role
			 */
			$stringRoles[]=$role->getRole();
		}
		return $stringRoles;
	}

	/**
	 * @param Role $role
	 * @return User
	 */
	public function addRole(Role $role){
		$this->roles[]=$role;

		return $this;
	}

	/**
	 * @param Article $article
	 * @return bool
	 */
	public function isAuthor(Article $article):bool
	{
		return $article->getAuthorId()===$this->getId();
	}

	/**
	 * @return bool
	 */
	public function isAdmin():bool
	{
		return \in_array('ROLE_ADMIN', $this->getRoles(), true);
	}

	/**
	 * Returns the salt that was originally used to encode the password.
	 *
	 * This can return null if the password was not encoded using a salt.
	 *
	 * @return string|null The salt
	 */
	public function getSalt()
	{
		// TODO: Implement getSalt() method.
	}

	/**
	 * Returns the username used to authenticate the users.
	 *
	 * @return string The username
	 */
	public function getUsername()
	{
		return $this->email;
	}

	/**
	 * Removes sensitive data from the users.
	 *
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 */
	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}
}

