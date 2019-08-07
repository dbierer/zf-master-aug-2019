<?php
namespace MyDoctrine\Entity;

//*** DOCTRINE LAB:
//*** need "use" statement
use Doctrine\Common\Collections\ArrayCollection;
use MyDoctrine\Entity\Attendee;

//*** DOCTRINE LAB:
//*** need entity annotation
/**
 * @ORM\Entity("MyDoctrine\Entity\Registration")
 * @ORM\Table("registration_d")
 */
class Registration
{
    //*** DOCTRINE LAB:
    //*** need annotations for each property
    /**
     * @ORM\???
     */
    protected $id;

    /**
     * @ORM\???
     */
    protected $firstName;

    /**
     * @ORM\???
     */
    protected $lastName;

    /**
     * @ORM\???
     */
    protected $registrationTime;

    //*** configure a one to many relationship to Attendee
    /**
     * @ORM\???
     */
    protected $attendees = array();

    //*** configure a many to one relationship to to Event
    /**
     * @ORM\???
     */
    protected $event;

    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $firstName
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @return the $lastName
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @return the $registrationTime
     */
    public function getRegistrationTime() {
        return $this->registrationTime->format('l, d M Y');
    }

    /**
     * @return the $attendees
     */
    public function getAttendees() {
        return $this->attendees;
    }

    /**
     * @return the back-linked Event entity
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param field_type $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * @param field_type $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * @param field_type $registrationTime
     */
    public function setRegistrationTime($registrationTime = NULL) {
        if ($registrationTime == NULL) {
            $registrationTime = new \DateTime('now');
        }
        $this->registrationTime = $registrationTime;
    }

    //*** needs annotation
    /**
     * @param multitype: $attendees
     */
    public function setAttendees(Attendee $attendee) {
        //*** what goes here?
        $this->attendees[] = $attendee;
    }

    /**
     * @param int $event
     */
    public function setEvent($event) {
        $this->event = $event;
    }


}
