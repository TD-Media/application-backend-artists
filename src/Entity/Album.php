<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="albums")
 */
class Album
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
    protected $title;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $cover;
    
    /**
     * @var string

     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", unique=true)
     */
    protected $token;
    
    /**
     * @var Artist

     * @ORM\ManyToOne(targetEntity="Artist", inversedBy="albums")
     * @ORM\JoinColumn(name="artist_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $artist;
    
    /**
     * @var Song[]|Collection
     * 
     * @ORM\OneToMany(targetEntity="Song", mappedBy="album", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $songs;
}