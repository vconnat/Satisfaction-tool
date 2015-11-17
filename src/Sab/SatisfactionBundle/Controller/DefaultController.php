<?php

namespace Sab\SatisfactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sab\SatisfactionBundle\Entity\Stf_monthly;
use Sab\SatisfactionBundle\Form\Stf_monthlyType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $monthly = new Stf_monthly();
        $form_monthly = new Stf_monthlyType();
        $form = $this->createForm($form_monthly, $monthly);

        return $this->render('SatisfactionBundle:Default:index.html.twig', array(
                    'form_monthly' => $form->createView()
        ));
    }

    /**
     * Validate form 
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxSubmitAction(Request $request) {
        $data = array();
        try {
            $em = $this->getDoctrine()->getManager();

            $idUser = $this->getDoctrine()->getRepository("SatisfactionBundle:Stf_user")->findAll();

            if ($request->isXmlHttpRequest()) {
                $monthly = new Stf_monthly();
                $form_monthly = new Stf_monthlyType();
                $form = $this->createForm($form_monthly, $monthly);
                $form->submit($request);

                if ($form->isValid()) {
                    $d = $form->getData();
                    $id_humor = $d->getHumor()->getId();
                    $irritant = $d->getIrritant();
                    $id_equilibrium = $d->getEquilibrium()->getId();
                    $monthly->setUser($idUser[0]->getId());
                    $monthly->setHumor($id_humor);
                    $monthly->setEquilibrium($id_equilibrium);
                    $monthly->setIrritant($irritant);
                    $em->persist($monthly);
                    $em->flush();
                }
            }
        } catch (\Exception $exc) {
            $data['error_msg'] = $exc->getMessage();
        }
        return new JsonResponse($data);
    }
}
