<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\XmlFile;
use App\Form\FileUploadType;
use App\Repository\MovieRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'movie')]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        return $this->render('movie/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(int $id, MovieRepository $movieRepository): Response
    {
        $movie = $movieRepository->find($id);
        if(!$movie)
        {
            throw $this->createNotFoundException('Ce film n\'est pas en base de données');
        };
            return $this->render('movie/details.html.twig',
            [
                "movie" => $movie
            ]);
        
    }


    #[Route('/upload', name: 'upload')]
    public function new(Request $request, FileUploader $fileUploader, EntityManagerInterface $em): Response
    {
        $xml = new XmlFile();
        $movie = new Movie();
        $form = $this->createForm(FileUploadType::class, $xml);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $XmlFile = $form->get('XmlFile')->getData();
           
            if ($XmlFile) {
                $XmlFileName = $fileUploader->upload($XmlFile);
                $xml->setXmlFileName($XmlFileName);
            
                $file = $xml->getXmlFileName();
                
                $XmlMovies = simplexml_load_file('../var/xmlFiles/' . $file, 'SimpleXMLElement');
                
                foreach($XmlMovies->movie as $movieXml)
                
                {  
                    $movie = new Movie(); 
                    $movie->setId2($movieXml->id);
                    $movie->setTitle($movieXml->title);
                    $movie->setGenre($movieXml->genre);
                    $movie->setDescription($movieXml->description);
                    $movie->setDirector($movieXml->director);
                    $movie->setYear($movieXml->year);
                    $movie->setRuntime($movieXml->runtime);
                    $movie->setRate($movieXml->rate);
                    $em->persist($movie);
                    $em->flush();
                    $this->addFlash('success','Nouveau fichier inséré en base de données');
                }
            }
            return $this->redirectToRoute('movie'); 
        }
       
        
        return $this->render('service/upload.html.twig', [
            'form' => $form,
        ]);
    } 
}
