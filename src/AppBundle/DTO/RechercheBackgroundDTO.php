<?php

namespace AppBundle\DTO;

/**
 * Description of RechercheBackgroundDTO
 *
 * @author Administrateur
 */
class RechercheBackgroundDTO {
    private $heureDate;
    
    function getHeureDate() {
        return $this->heureDate;
    }

    function setHeureDate($heureDate) {
        $this->heureDate = $heureDate;
    }


}
