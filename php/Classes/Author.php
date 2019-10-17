<?php

namespace FloribellaPonce\ObjectOrientedProject;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

	use Ramsey\Uuid\Uuid;
	/**
	 *This is a author user account.
	 *
	 * @author Floribella Ponce <fponce2@cnm.com>
	 * @version 0.0.1
	 **/
class Author {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this author. This is the primary key.
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * activation token to validate author at point of creation.
	 * @var string $authorActivationToken
	 **/
	private $authorActivationToken;
	/**
	 * image for this author.
	 *v@var $authorAvatarUrl
	 **/
	private $authorAvatarUrl;
	/**
	 * email for this author. This has a unique index.
	 * @var string $authorEmail
	 **/
	private $authorEmail;
	/**
	 * hash for author password
	 * @var string $authorHash
	 **/
	private $authorHash;
	/**
	 * username for this author. This has a unique index.
	 * @var string $authorUsername
	 **/
	private $authorUsername;



	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id (or null if new author)
	 **/

	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	/**
	 * mutator method for author id
	 *
	 **/
	public function setAuthorId( $newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the author id
		$this->authorId = $uuid;
	}
		/**
		 * mutator method for at handle
		 *
		 **/
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {
	// verify the avatar url is secure
	$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
	$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($newAuthorAvatarUrl) === true) {
		throw(new \InvalidArgumentException("author at handle is empty or insecure"));
	}
	// image for this author
	if(strlen($newAuthorAvatarUrl) > 32) {
		throw(new \RangeException("author at handle is too large"));
	}
	// store the avatar url
	$this->authorAvatarUrl = $newAuthorAvatarUrl;
}
	/**
	 * accessor method for author activation token
	 *
	 * @return string value of the activation token
	 */
	public function getAuthorActivationToken() : ?string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 */
	public function setAuthorActivationToken(?string $fnewAuthorActivationToken): void {
		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("author activation is not valid"));
		}
		//make sure author activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("author activation token has to be 32"));
		}
		$this->authorActivationToken = $authorActivationToken;
	}
	/**
	 * accessor method for at handle
	 *
	 * @return string value of at handle
	 **/
	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	}
	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}
	/**
	 * mutator method for email
	 *
	 **/
	public function setAuthorEmail(string $newAuthorEmail): void {
		// verify the email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("author email is too large"));
		}
		// store the email
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accessor method for authorHash
	 *
	 * @return string value of hash
	 */
	public function getAuthorHash(): string {
		return $this->authorHash;
	}

	/**
	 * mutator method for author hash password
	 *
	 */
	public function setAuthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$authorHashInfo = password_get_info($newAuthorHash);
		if($authorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("author hash must be 97 characters"));
		}
		//store the hash
		$this->authorHash = $newAuthorHash;
	}
	/**
	 * accessor method for phone
	 *
	 * @return string value of phone or null
	 **/
	public function getAuthorPhone(): ?string {
		return ($this->authorPhone);
	}
	/**
	 * mutator method for phone
	 *
	 **/
	public function setauthorPhone(?string $newAuthorPhone): void {
		//if $authorPhone is null return it right away
		if($newAuthorPhone === null) {
			$this->authorPhone = null;
			return;
		}
		// verify the phone is secure
		$newAuthorPhone = trim($newAuthorPhone);
		$newAuthorPhone = filter_var($newAuthorPhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorPhone) === true) {
			throw(new \InvalidArgumentException("author phone is empty or insecure"));
		}
		// verify the phone will fit in the database
		if(strlen($newAuthorPhone) > 32) {
			throw(new \RangeException("author phone is too large"));
		}
		// store the phone
		$this->authorPhone = $newAuthorPhone;
	}
}
