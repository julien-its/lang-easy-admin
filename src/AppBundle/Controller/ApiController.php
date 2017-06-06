<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/api/lessons", name="lessons")
     */
    public function lessonsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository('AppBundle:Lesson')->findAll();
        $arr = array_map( function($lesson){
                                return array(
                                    'id' => $lesson->getId(),
                                    'number' => $lesson->getNumber(),
                                    'title' => $lesson->getTitle()
                                ); }
                        , $lessons );

        return new Response(json_encode($arr));
    }

    /**
     * @Route("/api/lesson/{id}/vocabularies", name="lesson_vocabularies", requirements={"id": "\d+"})
     */
    public function lessonVocabulariesAction(Request $request, \AppBundle\Entity\Lesson $lesson)
    {
        return new Response(json_encode($lesson));
    }

}
