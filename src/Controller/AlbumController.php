<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/albums", methods={"GET"})
 */
class AlbumController extends AbstractController
{    
    /**
     * @Route("/{token}")
     */    
    public function getAlbum(Album $album): JsonResponse
    {        
        $return = $this->albumToArray($album);
        
        return $this->json($return);
    }
    
    private function albumToArray($album): array
    {
        $artist = $album->getArtist();
        
        $return = [
            'token' => $album->getToken(),
            'title' => $album->getTitle(),
            'description' => $album->getDescription(),
            'cover' => $album->getCover(),
            'artist' => [
                'token' => $artist->getToken(),
                'name' => $artist->getName(),
            ],
            'songs' => [],
        ];
        
        foreach ($album->getSongs() as $song) {
            $minutes = floor($song->getSeconds() / 60);
            $seconds = $song->getSeconds() % 60;
            
            $return['songs'][] = [
                'title' => $song->getTitle(),
                'length' => sprintf('%d:%02d', $minutes, $seconds),
            ];
        }
        
        print_r($return);die();
                
        return $return;
    }
}