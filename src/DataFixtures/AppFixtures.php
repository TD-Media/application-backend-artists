<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Song;
use App\Utils\TokenGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const TOKEN_LENGTH = 6;
    
    /**
     * @var array
     * 
     * Save all used tokens in here to prevent duplicates
     */
    protected $usedTokens = [];
    
    public function load(ObjectManager $manager): void
    {
        $json = file_get_contents('https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json');
        $artists = json_decode($json, true);
        
        foreach ($artists as $artistArray) {
            $artist = new Artist;
            $artist->setName($artistArray['name']);
            $artist->setToken($this->generateUniqueToken(self::TOKEN_LENGTH));
            
            $this->addAlbums($artist, $artistArray['albums']);
                        
            $manager->persist($artist);
        }
        
        $manager->flush();
    }
    
    private function addAlbums($artist, $albums): void
    {
        foreach ($albums as $albumArray) {
            $album = new Album;
            $album->setTitle($albumArray['title']);
            $album->setCover($albumArray['cover']);
            $album->setDescription($albumArray['description']);
            $album->setToken($this->generateUniqueToken(self::TOKEN_LENGTH));
            
            $this->addSongs($album, $albumArray['songs']);

            $artist->addAlbum($album);
        }
    }
    
    private function addSongs($album, $songs): void
    {
        foreach ($songs as $songArray) {
            $song = new Song;
            $song->setTitle($songArray['title']);

            $exp = explode(':', $songArray['length']);
            $seconds = ((int) $exp[0] * 60) + (int) $exp[1];
            $song->setSeconds($seconds);

            $album->addSong($song);
        }
    }
    
    private function generateUniqueToken(int $length): string
    {
        do {
            $token = TokenGenerator::generate($length);
        }  while (in_array($token, $this->usedTokens));
        
        $this->usedTokens[] = $token;
        
        return $token;
    }
}