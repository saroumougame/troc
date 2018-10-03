<?php


namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->objet = new ArrayCollection();
// your own logic
    }


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
     * @ORM\Column(name="namephoto", type="string", length=20, nullable=true)
     */
    protected $namePhoto;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objet", mappedBy="user")
     */
    private $objet;



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
     * @return Collection|Product[]
     */
    public function getObjet(): Collection
    {
        return $this->objet;
    }


}