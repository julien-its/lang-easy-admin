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
     * @Route("/api/lesson/{id}/vocabularies", name="lesson_vocabularies", requirements={"id": "\d+"})
     */
    public function lessonVocabulariesAction(Request $request, \AppBundle\Entity\Lesson $lesson)
    {
        return new Response(json_encode($lesson, JSON_FORCE_OBJECT));
    }
}
