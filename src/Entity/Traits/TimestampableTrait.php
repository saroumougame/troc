<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 12/11/2018
 * Time: 14:44
 */


namespace App\Entity\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{


    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $createdBy;


    /**
     * @return DateTime
     */
    public function getCreated()//: DateTime
    {
        return $this->created;
    }


    /**
     * @return DateTime
     */
    public function getUpdated()//: DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated($created)//: void
    {
        $this->created = $created;
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated($updated)//: void
    {
        $this->updated = $updated;
    }


}