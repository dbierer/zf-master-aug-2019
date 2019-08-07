<?php
namespace MyDoctrine\Repository;

//*** DOCTRINE LAB:
//*** need "use" statements
use MyDoctrine\Entity\Attendee;

class AttendeeRepo extends EntityRepository
{

    /**
     * @param Application\Entity\Registration $regEntity
     * @param string $nameOnTicket
     * @return Application\Entity\Attendee
     */
    public function persist($regEntity, $nameOnTicket)
    {
        //*** DOCTRINE LAB:
        $attendee = new Attendee();
        $attendee->setRegistration($regEntity);
        $attendee->setName($nameOnTicket);
        $em = $this->getEntityManager();
        //*** need code to save to the database
        //*** don't forget to flush!!!
        return $attendee;
    }
}
