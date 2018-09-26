<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="songs")
 */
class Song
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
     * @var integer
     * 
     * @ORM\Column(type="integer")
     */
    protected $seconds;
    
    /**
     * @var Album

     * @ORM\ManyToOne(targetEntity="Album", inversedBy="songs")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $album;
    
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
    
    public function getSeconds(): ?int
    {
        return $this->seconds;
    }
        
    public function setSeconds(?int $seconds): void
    {
        $this->seconds = $seconds;
    }
    
    public function getAlbum(): ?Album
    {
        return $this->album;
    }
    
    public function setAlbum(?Album $album): void
    {
        $this->album = $album;
    }
}