<?php
namespace App\Controller;

use App\Entity\Exposition;
use App\Repository\ExpositionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpositionController extends AbstractController
{
    /**
     * @var ExpositionRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ExpositionRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/artistes", name="artistes.index")
     * @return Response
     */
    public function index ():Response
{
    $expositions = $this->repository->findAll();
    return $this->render('artistes/index',[
        'expositions'=>$expositions,
]);

}
}