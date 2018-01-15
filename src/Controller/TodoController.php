<?php

namespace App\Controller;

use App\Entity\Todo;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class TodoController extends Controller
{
    /**
     * Matches / exactly
     * @Route("/", name="home")
     */
    public function default(){
        return $this->list();
    }

    /**
     * @Route("/todo", name="index")
     */
    public function list(){

        $todos = $this->getDoctrine()->getRepository(Todo::class)->findAll();

        return $this->render('todo/index.html.twig', array('page' => "Home", 'todos' => $todos));
    }

    /**
     * @Route("/todo/create", name="create")
     */
    public function create(Request $request){
       $todo = new Todo();

       $todo->setDueDate(new \DateTime());
       $todo->setCreateDate(new \DateTime());

        $form = $this->createFormBuilder($todo)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('due_date', DateTimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('save', SubmitType::class, array('label' => 'Create Todo', 'attr' => array('class' => 'btn btn-primary float-right', 'style' => 'margin-bottom: 15px; margin-left:10px;')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $todo = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash('notice', 'Todo Added');
            return $this->redirectToRoute('index');
        }

        return $this->render('todo/create.html.twig', array('page' => "create", 'form' => $form->createView()));
    }

    /**
     * @Route("/todo/edit/{id}", name="edit", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request){
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);

        $form = $this->createFormBuilder($todo)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('due_date', DateTimeType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('save', SubmitType::class, array('label' => 'Update Todo', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $todo = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->getRepository(Todo::class);
            $em->flush();
            $this->addFlash('notice', 'Todo Updated');
            return $this->redirectToRoute('index');
        }

        return $this->render('todo/edit.html.twig', array('page' => "edit", 'form' => $form->createView()));
    }

    /**
     * Matches /delete exactly
     * @Route("/todo/delete/{id}", name="delete", requirements={"id"="\d+"})
     */
    public function delete($id){
        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Todo::class);
        $em->remove($todo);
        $em->flush();
        $this->addFlash('notice', 'Todo Updated');
        return $this->redirectToRoute('index');
    }

    /**
     * Matches /details exactly
     * @Route("/todo/details/{id}", name="details", requirements={"id"="\d+"})
     */
    public function details($id){

        $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);

        return $this->render('todo/details.html.twig', array('page' => "details", 'todo' => $todo));
    }

}