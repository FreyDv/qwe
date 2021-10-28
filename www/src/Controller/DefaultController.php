<?php

namespace App\Controller;

use App\Entity\Product;
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
        $usrList = $Manager->getRepository(User::class)->findBy(array('age'<23));
        dd($usrList);

        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);

    }
    #[Route('/show-usr', name: 'showplace')]
    public function indexshowusr(): Response
    {
//        $entityManager=$this->getDoctrine()->getManager();
//        $productList = $entityManager->getRepository(Product::class)->findAll();
//        dd($productList);

        $Manager=$this->getDoctrine()->getManager();
        $criteria  = new Criteria();
        $criteria->where($criteria->expr()->gt('age',23));
        $usrList = UserRepository->match ($criteria);
//        match ($criteria);

//        $usrList = $Manager->getRepository(User::class)->findBy(array('age'=>'>23'));
        dd($usrList);

        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);

    }

    #[Route('/product-add',methods:'GET', name: 'product-add')]
    public function productAdd(): Response
    {
        $product = new Product();
        $product->setTitle('Product#'.rand(1,100));
        $product->setDescription("IPhone");
        $product->setPrice(10);
        $product->setQuantity(1);

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    #[Route('/usr-add/{name}/{age}/{phone}',methods:'GET', name: 'usr-add')]
    public function userAdd($name,$age,$phone): Response
    {
        $usr = new User();
        $usr->setName($name);
        $usr->setAge("$age");
        $usr->setPhone($phone);

        $Manager=$this->getDoctrine()->getManager();
        $Manager->persist($usr);
        $Manager->flush();

        return $this->redirectToRoute('homepage');
    }

}

//  /usr-add/daniil/23/+380992239852
//  /usr-add/veleri/23/+380992239858
//  /usr-add/ana/14/+380994598561