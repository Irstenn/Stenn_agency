<?php
namespace App\Controller;

use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;

class PropertyController extends AbstractController
{

    /**
     *@var PropertyRepository
     **/
    private $repository;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/biens",name="property.index")
     * return Response
     */

    public function index(): Response
    {
//        $property = $this->repository->findAllVisible();
//        $property[0]->setAddress(false);
//        $this->em->flush();
//        $repository = $this->getDoctrine()->getRepository(Property::class);
//        dump($repository);
//        $property = new Property();
//        $property->setTitle('Nos premiers bien')
//            ->setPrice(10000)
//            ->setRooms(5)
//            ->setBedrooms(9)
//            ->setDescription('Une description de base de mon agence')
//            ->setFloor(12)
//            ->setHeat(2)
//            ->setCity('Brazzaville')
//            ->setAddress('Gagarine 63')
//            ->setPostalCode(390035);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($property);
//        $em->flush();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */

       // on puvait aussi faire public function show($slug, $id): Response
    public function show(Property $property, string $slug): Response 
    {
        //on redirectionne sur le mm lien mem si le slugg est mal mis ou taper
        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
      
        // $property = $this->repository->find($id);
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
