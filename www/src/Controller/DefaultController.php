<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Us;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
//        $entityManager=$this->getDoctrine()->getManager();
//        $productList = $entityManager->getRepository(Product::class)->findAll();
//        dd($productList);
        $Manager=$this->getDoctrine()->getManager();
//        $usrList = $Manager->getRepository(User::class)->findBy(array('age'<23));
//        dd($usrList);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/usr-add/{name}/{age}/{zp}', 'GET', name:'usr-add')]
    public function productAdd($name,$age,$zp): Response
    {
        $user = new Us($name,$age,$zp);
        $EM=$this->getDoctrine()->getManager();
        $EM->persist($user);
        $EM->flush();
        return $this->redirectToRoute('showAllUsers');
    }

    #[Route('/usr-show', name: 'showAllUsers')]
    public function indexShowUsr(): Response
    {
        $EM=$this->getDoctrine()->getManager();
        $userList = $EM->getRepository(Us::class)->findAll();
        dd($userList);
//        $usrList = UserRepository->match ($criteria);
//        match ($criteria);
//        $usrList = $Manager->getRepository(User::class)->findBy(array('age'=>'>23'));
//        dd($usrList);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/usr-show-children', name: 'showChildrenUsers')]
    public function indexShowUsrCildren(): Response
    {
        $EM=$this->getDoctrine()->getManager();
        $userList = $EM->getRepository(Us::class)->findAll();
        dd($userList);
//        $usrList = UserRepository->match ($criteria);
//        match ($criteria);
//        $usrList = $Manager->getRepository(User::class)->findBy(array('age'=>'>23'));
//        dd($usrList);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/usrtest', name: 'test')]
    public function indexTest(): Response
    {
        $EM = new UserRepository($this->getDoctrine());



//        dd($userList);
//        $usrList = UserRepository->match ($criteria);
//        match ($criteria);
//        $usrList = $Manager->getRepository(User::class)->findBy(array('age'=>'>23'));
//        dd($usrList);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


}

//  /usr-add/daniil/23/15000
//  /usr-add/veleri/23/8000
//  /usr-add/ana/14/50