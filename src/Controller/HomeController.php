<?php
namespace App\Controller;

use App\Form\ContactHomeType;
use App\Repository\ActualiteRepository;
use App\Repository\AquarelleRepository;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HomeController extends AbstractController
{

    public function __construct(PhotoRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;

    }

    /**
     * @Route("/", name="home")
     * @param AquarelleRepository $repository
     * @param PhotoRepository $photoRepository
     * @param ActualiteRepository $actualiteRepository
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function index(AquarelleRepository $repository, PhotoRepository $photoRepository, ActualiteRepository $actualiteRepository, Request $request, MailerInterface $mailer): Response
    {
        //formulaire de contact
        $form = $this->createForm(ContactHomeType::class);
        $contact = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to('sqr81@free.fr')
                ->subject('Message depuis Pat&Soaze')
                ->htmlTemplate('emails/contact_home.html.twig')
                ->context([
                    'mail' => $contact->get('email')->getData(),
                    'nom' => $contact->get('nom')->getData(),
                    'message' => $contact->get('message')->getData(),
//                    'telephone' => $contact->get('telephone')->getData(),
                ])
            ;
            $mailer->send($email);

            $this->addFlash('message', 'Mail de contact envoyé');

            return $this->redirectToRoute('home');

        }


        $aquarelles = $repository->findLatest();
        $photos = $photoRepository->findLatest();
        $actualites =$actualiteRepository->findLastTwo();
        return $this->render('pages/home.html.twig', [
            'aquarelles'=>$aquarelles,
            'photos'=>$photos,
            'actualites'=>$actualites,
            'form' => $form->createView(),

        ]);
    }

//    /**
//     * @Route("/", name="home")
//     */
//    public function contact()
//    {
//        return $this->render();
//    }
}