<?php

namespace App\Controller;

use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artists", methods={"GET"})
 */
class ArtistController extends AbstractController
{
    /**
     * @Route()
     */  
    public function getArtists(): JsonResponse
    {        
        $em = $this->getDoctrine()->getManager();
        $artists = $em->getRepository(Artist::class)->findAllAndPopulateAlbums();
        
        $return = [];
        
        foreach ($artists as $artist) {
            $return[] = $this->artistToArray($artist);
        }
        
        return $this->json($return);
    }
    
    /**
     * @Route("/{token}")
     */    
    public function getArtist(Artist $artist): JsonResponse
    {        
        $return = $this->artistToArray($artist);
        
        return $this->json($return);
    }
    
    private function artistToArray($artist): array
    {
        $return = [
            'token' => $artist->getToken(),
            'name' => $artist->getName(),
            'albums' => [],
        ];
        
        foreach ($artist->getAlbums() as $album) {
            $return['albums'][] = [
                'token' => $album->getToken(),
                'title' => $album->getTitle(),
                'cover' => $album->getCover(),
            ];
        }
        
        return $return;
    }
}