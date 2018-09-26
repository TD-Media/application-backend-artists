<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    
    public function __construct()
    {
        $this->songs = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
        
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }
    
    public function getCover(): ?string
    {
        return $this->cover;
    }
        
    public function setCover(?string $cover): void
    {
        $this->cover = $cover;
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    }
        
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    
    public function getToken(): ?string
    {
        return $this->token;
    }
        
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }
    
    public function getArtist(): ?Artist
    {
        return $this->artist;
    }
    
    public function setArtist(?Artist $artist): void
    {
        $this->artist = $artist;
    }
    
    public function getSongs(): ?Collection
    {
        return $this->songs;
    }
    
    public function addSong(Song $song)
    {
        $song->setAlbum($this);
        $this->songs->add($song);
    }
    
    public function removeSong(Song $song)
    {
        $this->songs->removeElement($song);
        $song->setAlbum(null);
    }
}