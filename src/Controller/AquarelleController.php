<?php
namespace App\Controller;

use App\Entity\Aquarelle;
use App\Form\ContactArtisteType;
use App\Repository\AquarelleRepository;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AquarelleController extends AbstractController
{
    /**
     * @var AquarelleRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(AquarelleRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/aquarelles", name="aquarelle.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $aquarelles = $this->repository->findAll();
        return $this->render('aquarelles/index.html.twig', compact('aquarelles'));
    }

    /**
     * @Route("/aquarelles/{slug}-{id}", name="aquarelle.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Aquarelle $aquarelle
     * @param string $slug
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function show(Aquarelle $aquarelle, string $slug, Request $request, MailerInterface $mailer): Response
    {
        if ($aquarelle->getSlug() !== $slug) {
            return $this->redirectToRoute('aquarelle.show', [
                'id' => $aquarelle->getId(),
                'slug' => $aquarelle->getSlug(),
            ], 301);
        }
//        form de contact
        $form = $this->createForm(ContactArtisteType::class);
//        traitement du form
        $contact = $form->handleRequest($request);
//        gestion du formulaire
        if($form->isSubmitted() && $form->isValid()){
//            on cree le mail
            $email = (new TemplatedEmail())
                ->from($contact->get('email')->getData())
                ->to($aquarelle->getAdmin()->getEmail())
                ->subject('Message concernant l aquarelle"' . $aquarelle->getNom() .'"')
                ->htmlTemplate('emails/contact_aquarelle.html.twig')
                ->context([
                    'aquarelle'=> $aquarelle,
                    'mail' => $contact->get('email')->getData(),
                    'message' => $contact->get('message')->getData()
                ]);
//            envoi du message
            $mailer->send($email);
//            confirmation et redirection
            $this->addFlash('message', 'Votre e-mail a bien été envoyé');

            return $this->redirectToRoute('aquarelle.show',[
                'id' => $aquarelle->getId(),
                'slug' => $aquarelle->getSlug()
            ]);
        }

        return $this->render('aquarelles/show.html.twig', [
            'aquarelle' => $aquarelle,
            'form' => $form->createView(),
            'current_menu' => 'aquarelles']);
    }

//    /**
//     * @Route("/aquarelles/{slug}-{id}", name="aquarelle.show", requirements={"slug": "[a-z0-9\-]*"})
//     * @param Aquarelle $aquarelle
//     * @param string $slug
//     * @return Response
//     */
//    public function aquarelleVendue(aquarelle $aquarelle, string $slug): Response
//    {
//        $aquarelleVendue = $aquarelle->getVendue();
//        if ($aquarelleVendue == 1) {
//            echo 'vendue';
//        }
//        else if ($aquarelleVendue == 0) {
//            echo 'à vendre';
//        }
//
//        return $this->render('aquarelles/show.html.twig', [
//            'aquarelle' => $aquarelle,
//            'aquarelleVendue' => $aquarelleVendue,
//
//        ]);
//
//
//
//
//    }

}