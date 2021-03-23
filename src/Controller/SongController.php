<?php
namespace App\Controller;

use App\Entity\Song;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class SongController extends AbstractController{

    /** 
    * @Route("/", name="song_list")
    * @Method({"GET"})
    */
    public function index() {
        // return new Response('<html><body>Hello</body></html>');

        $songs= $this->getDoctrine()->getRepository(Song::class)->findAll();
        return $this->render('song/index.html.twig', array('songs' => $songs));


    }

    /**
     * @Route("/song/new", name="new_song")
     * Method({"GET", "POST"})
     */
    public function new(Request $request) {
        $song = new Song();

        $form = $this->createFormBuilder($song) 
        ->add('title', TextType::class, array('attr' => array('class' => 'form-control'))) 
        ->add('body', TextareaType::class, array(
            'required' => false, 
            'attr' => array('class' => 'form-control')
        ))
        ->add('artist', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('chords', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('bpm', IntegerType::class, array('attr' => array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Create',
            'attr' => array( 'class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $song = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($song);
            $entityManager->flush();

            return $this->redirectToRoute('song_list');
        }

        return $this ->render('song/new.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/song/edit/{id}", name="edit_song")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $song = new Song();
        $song = $this->getDoctrine()->getRepository(Song::class)->find($id);


        $form = $this->createFormBuilder($song) 
        ->add('title', TextType::class, array('attr' => array('class' => 'form-control'))) 
        ->add('body', TextareaType::class, array(
            'required' => false, 
            'attr' => array('class' => 'form-control')
        ))
        ->add('artist', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('chords', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('bpm', IntegerType::class, array('attr' => array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
            'label' => 'Update',
            'attr' => array( 'class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('song_list');
        }

        return $this ->render('song/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/song/{id}", name="song_show")
     */
    public function show($id) {
        $song = $this->getDoctrine()->getRepository(Song::class)->find($id);
        
        return $this->render('song/show.html.twig', array('song' => $song));
    }

    /**
     * @Route("/song/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $song = $this->getDoctrine()->getRepository(Song::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($song);
        $entityManager->flush();

        $response = new  Respons();
        $response->send();

    }

}