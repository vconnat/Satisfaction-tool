<?php

namespace Ajax\SatisfactionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

use Ajax\SatisfactionBundle\Entity\PSHumorType;
use Ajax\SatisfactionBundle\Entity\PSEquilibriumType;

/**
 * This command is called by request to create the base data - humor/equilibrium - for the Satisfaction tool.
 */
class CreateBaseDataCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    public function configure()
    {
        parent::configure();
        $this
            ->setName('ajax:satisfaction:create:data')
            ->setDescription('Create the base data - humor/equilibrium - for the Satisfaction tool.');
    }

    /**
     * @param InputInterface  $input  The params the user gave
     * @param OutputInterface $output The output to display some things
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        try {
            $baseHumorArray         = $this->retrieveBaseHumorArray();
            $baseEquilibriumArray   = $this->retrieveBaseEquilibriumArray();

            $flushBase      = false;
            $psHumorRepository  = $em->getRepository('AjaxSatisfactionBundle:PSHumorType');
            $psEquilRepository  = $em->getRepository('AjaxSatisfactionBundle:PSEquilibriumType');

            foreach ( $baseHumorArray as $baseHumor ) {
                // Check for base irritant already in DB
                $existingHumor = $psHumorRepository->findBy( array( "humorName" => $baseHumor["message"] ) );

                if( count( $existingHumor ) > 0 )
                    continue;

                // Save new irritants
                $flushBase      = true;
                $humor = new PSHumorType();

                $humor->setHumorName( $baseHumor["message"] );
                $humor->setHumorImageName( $baseHumor["image"] );
                $humor->setShowIrritant( $baseHumor["showIrritant"] );

                $em->persist( $humor );
            }

            foreach ( $baseEquilibriumArray as $baseEquilibrium ) {
                // Check for base irritant already in DB
                $existingEquil = $psEquilRepository->findBy( array( "equilibriumName" => $baseEquilibrium["message"] ) );

                if( count( $existingEquil ) > 0 )
                    continue;

                // Save new irritants
                $flushBase      = true;
                $equilibrium = new PSEquilibriumType();

                $equilibrium->setEquilibriumName( $baseEquilibrium["message"] );
                $equilibrium->setEquilibriumImageName( $baseEquilibrium["image"] );

                $em->persist( $equilibrium );
            }


            if( $flushBase ){
                $em->flush();
                $output->writeln("<info>Saved Entries</info>");
            }
            
        } catch (\Exception $e) {
            $output->writeln("<info>".$e->getMessage()."</info>");
        }
    }

    private function retrieveBaseHumorArray(){
        $baseArray = array();

        $element = array();
        $element["message"] = "Très Mauvaise";
        $element["image"]   = "hmr-very-bad.png";
        $element["showIrritant"] = TRUE;
        $baseArray[] = $element;

        $element = array();
        $element["message"] = "Mauvaise";
        $element["image"]   = "hmr-bad.png";
        $element["showIrritant"] = TRUE;
        $baseArray[] = $element;

        $element = array();
        $element["message"] = "Bonne";
        $element["image"]   = "hmr-good.png";
        $element["showIrritant"] = FALSE;
        $baseArray[] = $element;

        $element = array();
        $element["message"] = "Très Bonne";
        $element["image"]   = "hmr-very-good.png";
        $element["showIrritant"] = FALSE;
        $baseArray[] = $element;

        return $baseArray;
    }

    private function retrieveBaseEquilibriumArray(){
        $baseArray = array();

        $element = array();
        $element["message"] = "Impacte l'équilibre";
        
        $element["image"]   = "eq-impact.png";
        $baseArray[] = $element;

        $element = array();
        $element["message"] = "Supportable";
        $element["image"]   = "eq-bearable.png";
        $baseArray[] = $element;

        $element = array();
        $element["message"] = "Ça roule";
        $element["image"]   = "eq-ok.png";
        $baseArray[] = $element;

        return $baseArray;
    }
}
