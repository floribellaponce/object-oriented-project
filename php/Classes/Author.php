<?php
//This is a Doc Block. This is to communicate to developers to what you are doing (what the class is about).
/**
 *Typical Profile for an eCommerce cite //h1
 *
 * This Profile is an abbreviated example of data collected and stored about a user for eCommerce purposes. //p
 * This can be extended to include more information such as address, phone number, etc. //p
 *
 * @author Floribella Ponce <fponce2@cnm.edu> //below p tag
 **/
//these are the state variables. These are the part of the class that will occupy memory and that will be in the database.
class Profile {
	// This is a mini Doc Block.
	/**
	 * id for this Profile; this is the primary key
	 */
	private $profileId;
	/**
	 * id for the User who owns this Profile; this is a foreign key
	 */
	private $userId;
	/**
	 * first name of this person
	 */
	private $firstName;
	/**
	 * last name of this person
	 */
	private $lastName;

	/**
	 * accessor method for profile id. An accessor is an Output method.
	 * Its a safe way of accessing what is currently in our data without allowing someone to manipulate it.
	 *
	 *@return int (the type we can expect which is integer) value of profile id  (the rest is what you should expect)
	 */
	//accessor will use get
	public function getProfileId() {
		//this is a special key word that states im talking to myself
		return($this->profileId);
	}

	/**
	 * mutator method for profile id. Mutator allows a person to set a new id for the profile.
	 *
	 * @param int $newProfileId new value of profile id. Param is short for parameter.
	 * @throws UnexpectedValueException if $newProfileId is not an integer. Throws means we are throwing an exception. This is what happens when things go wrong.
	 * It handles exceptional cases that shouldn't happen.
	 */
	public function setProfileId($newProfileId) {
		//filter.var is php function to do canned verification data for you.
		//FILTER_VALIDATE_INT states what you are filtering. In this case its an integer.
		//verify the profile id is valid.
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT) ;
		if($newProfileId === false) {
			throw(new UnexpectedValueException("profile id is not a valid interger"));
		}

		// convert and store the profile id
		$this->profileId = intval($newProfileId);
}
	/**
	 * accessor method for first name.
	 *
	 * @return string value of first name
	 */
	public function getFirstName() {
		return($this->firstName);
	}

	/**
	 * mutator method for first name.
	 *
	 * @param string $newFirstName new value of first class.
	 * @throws UnexpectedValueException if $newFirstName is not valid.
	 */
	public function setFirstName($newFirstName) {
		//verify the first name is valid.
		//FILTER_SANITIZE_STRING > works on strings.
		$newFirstName= filter_var($newFirstName, FILTER_SANITIZE_STRING) ;
		if($newFirstName === false) (
			throw(new UnexpectedValueException("first name is not a valid string"));
		)

		// no converter because no need to convert a string into a string.
}
?>