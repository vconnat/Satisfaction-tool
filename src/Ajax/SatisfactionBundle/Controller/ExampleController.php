<?php

namespace Ajax\SatisfactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ExampleController extends Controller
{
    public function indexAction( Request $request )
    {
    	$exampleParams = array();
    	$exampleParams["year"] 	= date("Y");
    	$exampleParams["month"] = date("m");
    	
        return $this->render( 'AjaxSatisfactionBundle:Example:index.html.twig', $exampleParams );
    }
}
