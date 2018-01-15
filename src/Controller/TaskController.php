<?php
/**
 * Created by PhpStorm.
 * User: higor.bocutti
 * Date: 11/01/2018
 * Time: 12:03
 */

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{

    /**
     * @Route("/task", name="task")
     */
    public function default(){
        $tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();

        return $this->render('tasks/index.html.twig', array('page' => 'Tasks', 'tasks' => $tasks));
    }

    /**
     * @Route("/task/create", name="Create Tasks")
     */
    public function createTask(Request $request){
        $task = new Task();
        $form = $this->createFormBuilder($task)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('time_spent', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('save', SubmitType::class, array('label' => 'Add Task', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px')))
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $this->addFlash('notice', 'Task Added');
            return $this->redirectToRoute('task');
        }

        return $this->render('tasks/taskForm.html.twig', array('page' => 'Create Task', 'form' => $form->createView()));
    }

    /**
     * Matches /task/edit exactly
     * @Route("/task/edit/{id}", name="Edit Task", requirements={"id"="\d+"})
     */
    public function editTask($id, Request $request){
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);

        $form = $this->createFormBuilder($task)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('time_spent', IntegerType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
            ->add('save', SubmitType::class, array('label' => 'Edit Task', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->getRepository(Task::class);
            $em->flush();
            $this->addFlash('notice', 'Todo Updated');
            return $this->redirectToRoute('task');
        }

        return $this->render('tasks/taskForm.html.twig', array('page' => 'Edit Task', 'form' => $form->createView()));
    }

    /**
     * Matches /task/delete exactly
     * @Route("/task/delete/{id}", name="Delete Tasks", requirements={"id"="\d+"})
     */
    public function deleteTask($id, Request $request){
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Task::class);
        $em->remove($task);
        $em->flush();

        $this->addFlash('notice', 'Task Deleted');
        return $this->redirectToRoute('task');
    }
    
}