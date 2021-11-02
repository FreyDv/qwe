<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Us;
use App\Repository\UsRepository;
use Doctrine\Common\Collections\Criteria;
//use http\Client\Request;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $res = $this->getDoctrine()->getRepository(Us::class)->findChildren();
        dd($res);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/usr-show-grown', name: 'showGrownUsers')]
    public function indexShowUsrGrown(): Response
    {
        $res = $this->getDoctrine()->getRepository(Us::class)->findGrown();
        dd($res);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/product-add', name: 'product-add')]
    public function indexTest( ): Response
    {
        //  http://lali.print:8000/product-add
        $product =new Product();
        $product->setTitle('Product_'.rand(1,100));
        $product->setQuantity(rand(0,15));
        $product->setPrice(rand(20,80));
        $product->setDescription("something new");

        $em=$this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        dd($product);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/product-show', name: 'showAllProduct')]
    public function indexProduct(): Response
    {
        //  http://lali.print:8000/product-show
        $em=$this->getDoctrine()->getManager();
        $productList = $em->getRepository(Product::class)->findAll();
        dd($productList);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/product-deleted/{title}', name: 'product-deleted')]
    public function indexDeleted($title): Response
    {
        //  http://lali.print:8000/product-deleted/Product_44
        $em=$this->getDoctrine()->getManager();
        $forDelete= $em->getRepository(Product::class)->findBy(array('title'=>$title));
        foreach($forDelete as $d){
            $em->remove($d);
        }
        $em->flush();
        dd($forDelete);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/product-change-prise/{title}/{newPrise}', name: 'product-change-prise')]
    public function indexChengePrise($title,$newPrise): Response
    {
        //  http://lali.print:8000/product-change-prise/Product_16/999
        $em=$this->getDoctrine()->getManager();
        $forChange= $em->getRepository(Product::class)->findBy(array('title'=>$title));
        foreach($forChange as $d){
            $d->setPrice($newPrise);
            $em->persist($d);
        }
        $em->flush();
        dd($forChange);
        return $this->render('main/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/edit-product/{id}', name: 'product_edit', requirements: array('id' => '\d+'), methods: 'GET|POST')]
    #[Route('/add-product/', name: 'product_add',methods: 'GET|POST')]
    public function editProduct(Request $request,int $id=null): Response
    {
        // http://lali.print:8000/edit-product/6
        // http://lali.print:8000/add-product/
        $em=$this->getDoctrine()->getManager();
        $product = null;
        if($id){
            $product = $em->getRepository(Product::class)->find($id);
        }
        if($product!=null){
            $i=0;
        }
        else{
            $product = new Product();
            $product->setTitle('asd');
            $product->setDescription('asd');
            $product->setPrice(123);
            $product->setQuantity(100);
            $em->persist($product);
            $em->flush();
        }
        $form= $this->createFormBuilder($product)
            ->add('title',TextType::class)
            ->getForm();
//        dd($product,$form);
        //  http://lali.print:8000/edit-product/1
        return $this->render('main/default/edit_product.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
//  http://lali.print:8000/usrtest
//  http://lali.print:8000/usr-add/daniil/23/15000
//  http://lali.print:8000/usr-add/veleri/23/8000
//  http://lali.print:8000/usr-add/ana/14/50
//  http://lali.print:8000/usr-add/natasha/42/30000
//  http://lali.print:8000/usr-show   Показать всех юзеров
//  http://lali.print:8000/usr-show-children
//  http://lali.print:8000/usr-show-grown
//  http://lali.print:8000/product-add
//  http://lali.print:8000/product-show
//  http://lali.print:8000