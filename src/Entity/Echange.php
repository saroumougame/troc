<?php


namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\TimestampableTrait;


/**
 * @ORM\Entity
 * @ORM\Table(name="echange")
 */
class Echange
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="echange")
     */
    protected $userVendeur;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="echange")
     */
    protected $userAcheteur;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objet", inversedBy="echange")
     */
    protected $objectVendeur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objet", inversedBy="echange")
     */
    protected $objectAchteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="statue", type="integer", length=1, nullable=false)
     */
    protected $statue;


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
     * @return mixed
     */
    public function getUserVendeur()
    {
        return $this->userVendeur;
    }

    /**
     * @param mixed $userVendeur
     */
    public function setUserVendeur($userVendeur): void
    {
        $this->userVendeur = $userVendeur;
    }

    /**
     * @return mixed
     */
    public function getUserAcheteur()
    {
        return $this->userAcheteur;
    }

    /**
     * @param mixed $userAcheteur
     */
    public function setUserAcheteur($userAcheteur): void
    {
        $this->userAcheteur = $userAcheteur;
    }

    /**
     * @return mixed
     */
    public function getObjectVendeur()
    {
        return $this->objectVendeur;
    }

    /**
     * @param mixed $objectVendeur
     */
    public function setObjectVendeur($objectVendeur): void
    {
        $this->objectVendeur = $objectVendeur;
    }

    /**
     * @return mixed
     */
    public function getObjectAchteur()
    {
        return $this->objectAchteur;
    }

    /**
     * @param mixed $objectAchteur
     */
    public function setObjectAchteur($objectAchteur): void
    {
        $this->objectAchteur = $objectAchteur;
    }

    /**
     * @return int
     */
    public function getStatue(): int
    {
        return $this->statue;
    }

    /**
     * @param int $statue
     */
    public function setStatue(int $statue): void
    {
        $this->statue = $statue;
    }


    use TimestampableTrait;


}