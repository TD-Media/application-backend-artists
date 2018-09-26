<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
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
    
    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getName(): ?string
    {
        return $this->name;
    }
        
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    
    public function getToken(): ?string
    {
        return $this->token;
    }
        
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }
    
    public function getAlbums(): ?Collection
    {
        return $this->albums;
    }
    
    public function addAlbum(Album $album)
    {
        $album->setArtist($this);
        $this->albums->add($album);
    }
    
    public function removeAlbum(Album $album)
    {
        $this->albums->removeElement($album);
        $album->setArtist(null);
    }
}