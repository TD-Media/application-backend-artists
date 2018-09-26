<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artists")
 */
class Artist
{
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", unique=true)
     */
    protected $token;
    
    /**
     * @var Album[]|Collection
     * 
     * @ORM\OneToMany(targetEntity="Album", mappedBy="artist", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $albums;
}