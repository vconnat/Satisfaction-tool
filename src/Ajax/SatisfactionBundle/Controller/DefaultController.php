<?php

namespace Ajax\SatisfactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Ajax\SatisfactionBundle\Entity\PersonSatisfaction;

class DefaultController extends Controller
{
	/**
     * MainPage for the AjaxIndex Template
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * Route: ajax_satisfaction_ajaxIndex
     */

    public function ajaxIndexAction( Request $request )
    {
		$jsonParams = array();

		try {
			if($request->isXmlHttpRequest()) {
            	$em = $this->getDoctrine()->getManager();

            	$hmrRepository = $em->getRepository('AjaxSatisfactionBundle:PSHumorType');
				$eqlRepository = $em->getRepository('AjaxSatisfactionBundle:PSEquilibriumType');

            	$rqMonth 	= $request->get("rqMonth")? $request->get("rqMonth") : date("m");
            	$rqYear 	= $request->get("rqYear")? $request->get("rqYear") : date("Y");

				// Retrieve Satisfaction entry
				$entryParams = array();
				$entryParams["userId"] 	= $this->getUser()->getId();
				$entryParams["month"] 	= $rqMonth;
				$entryParams["year"] 	= $rqYear;

				$personSatisfaction = $em->getRepository('AjaxSatisfactionBundle:PersonSatisfaction')->findOneBy( $entryParams );

				// Create if not exists
				if( !$personSatisfaction ){
					$humorDefault   = $hmrRepository->find(4);
					$equilDefault   = $eqlRepository->find(3);

					$personSatisfaction = new PersonSatisfaction();
					$personSatisfaction->setUserId( $this->getUser()->getId() );
					$personSatisfaction->setMonth( $rqMonth );
					$personSatisfaction->setYear( $rqYear );
					$personSatisfaction->setPsHumorType( $humorDefault );
					$personSatisfaction->setPsEquilibriumType( $equilDefault );
					$personSatisfaction->setAvailabilityManager( TRUE );
				}

				// Retrieve Form
				$form = $this->createForm( "satisfaction_form", $personSatisfaction );

				// Retrieve Entity data
				$humors         = $hmrRepository->findAll();
				$equilibriums   = $eqlRepository->findAll();

				$humorValues    = array();
				$equilValues    = array();

				foreach ( $humors as $k => $humor ) {
					$element = array();
					$element['message'] = $humor->getHumorName();
					$element['image'] 	= $humor->getHumorImageName();
					$element['showIrr'] = $humor->getShowIrritant()? 1 : 0;
					$humorValues[ $humor->getId() ] = $element;
				}

				foreach ( $equilibriums as $k => $equilibrium ) {
					$element = array();
					$element['message'] = $equilibrium->getEquilibriumName();
					$element['image'] 	= $equilibrium->getEquilibriumImageName();
					$equilValues[ $equilibrium->getId() ] = $element;
				}

				$params = array();
				$params['form'] 		= $form->createView();
				$params['humors'] 		= $humorValues;
				$params['equilibriums'] = $equilValues;

				$jsonParams["status"] 	= "success";
				$jsonParams["template"] = $this->renderView( 'AjaxSatisfactionBundle:Ajax:satisfactionTemplate.html.twig', $params );
	        }
    	} catch ( \Exception $e ) {
    		$jsonParams["status"] 	= "error";
			$jsonParams["message"] 	= $e->getMessage();
    	}

        return new JsonResponse( $jsonParams );
    }

    /**
     * Submission page for the AjaxIndex Template
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * Route: ajax_satisfaction_ajaxIndexSubmit
     */
    public function ajaxIndexSubmitAction( Request $request )
    {
		$jsonParams = array();

		try {
			if($request->isXmlHttpRequest()) {
            	$em = $this->getDoctrine()->getManager();

            	$requestData = $request->request->all();

            	$rqMonth 	= $requestData["satisfaction_form"]["month"]? $requestData["satisfaction_form"]["month"] : date("m");
            	$rqYear 	= $requestData["satisfaction_form"]["year"]? $requestData["satisfaction_form"]["year"] : date("Y");

				// Retrieve Satisfaction entry
				$entryParams = array();
				$entryParams["userId"] 	= $this->getUser()->getId();
				$entryParams["month"] 	= $rqMonth;
				$entryParams["year"] 	= $rqYear;

				$personSatisfaction = $em->getRepository('AjaxSatisfactionBundle:PersonSatisfaction')->findOneBy( $entryParams );

				// Create if not exists
				if( !$personSatisfaction ){
					$personSatisfaction = new PersonSatisfaction();
					$personSatisfaction->setUserId( $this->getUser()->getId() );
					$personSatisfaction->setMonth( $rqMonth );
					$personSatisfaction->setYear( $rqYear );
				}

				// Retrieve Form
				$form = $this->createForm( "satisfaction_form", $personSatisfaction );

				// assign data to personSatisfaction Object
				$form->submit( $request );

				if( $form->isValid() ){
					$em->persist( $personSatisfaction );
					$em->flush();

					$jsonParams["status"] 	= "success";
				}else{
					$jsonParams["status"] 	= "error";
					$jsonParams["message"] 	= "Error while saving data!";
				}
	        }
    	} catch ( \Exception $e ) {
    		$jsonParams["status"] 	= "error";
			$jsonParams["message"] 	= $e->getMessage();
    	}

        return new JsonResponse( $jsonParams );
    }
}
