<?php
namespace MyDoctrine\Repository;

//*** DOCTRINE LAB:
//*** need "use" statements
use MyDoctrine\Entity\ {Registration, Event};

class RegistrationRepo extends EntityRepository
{

    //*** DOCTRINE LAB:
    /**
     * @param Application\Entity\Event $eventEntity
     * @param array $regData
     * @return Application\Entity\Registration $registration
     */
    public function persist(Event $eventEntity, $regData)
    {
        //*** DOCTRINE LAB: complete registration persist
        $registration = new Registration();
        return ???;
    }
    public function update($registration)
    {
        $em = $this->getEntityManager();
        $em->persist($registration);
        $em->flush();
        return $registration;
    }
}
