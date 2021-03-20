<?php
namespace App\Controller;

use App\Entity\Song;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController{

    /** 
    * @Route("/")
    * @Method({"GET"})
    */
    public function index() {
        // return new Response('<html><body>Hello</body></html>');

        $songs= $this->getDoctrine()->getRepository(Song::class)->findAll();
        return $this->render('articles/index.html.twig', array('songs' => $songs));


    }
    /**
     * @Route("/song/save")
     */
    public function save() {
        $entityManager = $this->getDoctrine()->getManager();

        // $song = new Song();
        // $song->setTitle('way shejker');
        // $song->setBody('tekst tutaj');
        // $song->setBpm('123');
        // $song->setArtist('Lalaland');
        // $song->setChords('A/tD/tH');
        // $entityManager->persist($song);
        // $entityManager->flush();


        

        return new Response('Saved id= '.$song->getId());
    }
    

}