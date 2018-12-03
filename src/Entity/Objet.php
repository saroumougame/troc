<?php


namespace App\Entity;


use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="objet")
 */
class Objet
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    protected $description;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="object")
     */
    private $user;

    /**
     * Many Objet have Many Groups.
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="objets")
     */
    private $tags;





    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom():? string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getDescription():? string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


    public function __toString()
    {
        return (string) $this->getNom();
    }


//protected $photo;

 use TimestampableTrait;



    /**
     * @Assert\Image(
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
     */
    protected $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="namephoto", type="string", length=100, nullable=true)
     */
    protected $namePhoto;



    public function setPhoto(File $file = null)
    {
        $this->photo = $file;
    }

    public function getPhoto()
    {
        return $this->photo;
    }



    public function setNamePhoto($namePhoto)
    {
        $this->namePhoto = $namePhoto;
    }

    public function getNamePhoto()
    {
        return $this->namePhoto;
    }




}