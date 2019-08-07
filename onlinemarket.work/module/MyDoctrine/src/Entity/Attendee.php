<?php
namespace MyDoctrine\Entity;

//*** DOCTRINE LAB:
//*** need "use" statement
use Doctrine\ORM\Mapping as ORM;

//*** DOCTRINE LAB:
//*** need entity annotation
/**
 * @ORM\Entity(???)
 * @ORM\Table("attendee_d")
 */
class Attendee
{
    //*** DOCTRINE LAB:
    //*** need annotations for each property
    /**
     * @ORM\???
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    //*** configure a many to one relationship to to Registration
    /**
     * @ORM\???
     */
    protected $registration;

    /**
     * @ORM\Column(type="string", length=255, name="name_on_ticket")
     */
    protected $name;

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $registration
     */
    public function getRegistration() {
        return $this->registration;
    }

    /**
     * @return the $name_on_ticket
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param field_type $registration
     */
    public function setRegistration(Registration $registration) {
        $this->registration = $registration;
    }

    /**
     * @param field_type $name_on_ticket
     */
    public function setName($name_on_ticket) {
        $this->name = $name_on_ticket;
    }

}
