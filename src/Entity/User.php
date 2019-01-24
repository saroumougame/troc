<?php


namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

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
        $this->amis = new ArrayCollection();
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Amis", mappedBy="user")
     */
    private $amis;

    



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
     * @return Collection|Amis[]
     */
    public function getAmis(): Collection
    {
        return $this->amis;
    }

    public function addAmi(Amis $ami): self
    {
        if (!$this->amis->contains($ami)) {
            $this->amis[] = $ami;
            $ami->setUser($this);
        }

        return $this;
    }

    public function removeAmi(Amis $ami): self
    {
        if ($this->amis->contains($ami)) {
            $this->amis->removeElement($ami);
            // set the owning side to null (unless already changed)
            if ($ami->getUser() === $this) {
                $ami->setUser(null);
            }
        }

        return $this;
    }










}