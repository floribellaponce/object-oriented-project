<?php

namespace FloribellaPonce\ObjectOrientedProject;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Exception;
use http\Exception\UnexpectedValueException;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use RangeException;
use TypeError;

/**
 * This is the information that is stored for a author.
 *
 * @author Floribella Ponce <fponce2@cnm.edu>
 * @version 0.0.1
 **/
class Author {
	use ValidateUuid;
	/**
	 * id for the author who owns this account; this is the primary key.
	 * @var Uuid $authorId
	 */
	private $authorId;
	/**
	 * activation token for the author account
	 * @var string $authorActivationToken
	 */
	private $authorActivationToken;
	/**
	 * avatar (image) url for author
	 * @var string $authorAvatarUrl
	 */
	private $authorAvatarUrl;
	/**
	 * email for author; this has a unique index.
	 * @var string $authorEmail
	 **/
	private $authorEmail;
	/**
	 * hash for password for author
	 * @var string $authorHash
	 **/
	private $authorHash;
	/**
	 *username for author; this has a unique index.
	 * @var string $authorUsername
	 **/
	private $authorUsername;

	/**
	 *constructor for this author
	 *
	 * @param string $newAuthorId string containing new author id
	 * @param string $newAuthorActivationToken string containing new activation token
	 * @param string $newAuthorAvatarUrl string containing new avatar url
	 * @param string $newAuthorEmail string containing new email
	 * @param string $newAuthorHash string containing new hash
	 * @param string $newAuthorUsername string containing new username
	 * @throw UnexpectedValueException if any of the parameters are invalid
	 **/
	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} catch(UnexpectedValueException $exception) {
			// rethrow to the caller
			throw (new UnexpectedValueException("Unable to construct Auhtor", 0, $exception));
		}
	}
	/**
	 * accessor method for author id.
	 *
	 *@return Uuid value of author id
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	/**
	 * mutator method for author id
	 *
	 * @param Uuid new value for author id
	 * @throw UnexpectedValueException if $newAuthorId is not a Uuid
	 **/
	public function setAuthorId($newAuthorId): void {
		try{
			$uuid = self::validateUuid($newAuthorId);
		} catch(InvalidArgumentException | RangeException | Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the author id
		$this->authorId = $uuid;
	}
	/**
	 * accessor method for author activation token
	 *
	 * @return string value for activation token
	 */
	public function getAuthorActivationToken() : string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 * @param string new value for author activation token
	 * @throws InvalidArgumentException  if the token is not a string or insecure
	 * @throw \UnexpectedValueException if $newAuthorActivationToken is not valid
	 * @throws RangeException if the token is not exactly 32 characters
	 */
	public function setAuthorActivationToken(string $newAuthorActivationToken): void {
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
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for author avatar url
	 *
	 * @return string value for avatar url
	 */
	public function getAuthorAvatarUrl() : string {
		return ($this->authorAvatarUrl);
	}
	/**
	 * mutator method for author avatar url
	 *
	 * @param string new value for author avatar url
	 * @throws InvalidArgumentException  if the url is not a string
	 * @throw \UnexpectedValueException if $newAuthorAvatarUrl is not valid
	 * @throws RangeException if the avatar url is > 255 characters
	 */
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl): void {
		//if avatar url is null return it right away
		if($newAuthorAvatarUrl === null) {
			$this->authorAuthorAvatarUrl = null;
			return;
		}
		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorAvatarUrl) === true) {
			throw(new\InvalidArgumentException("avatar url is empty or insecure"));
		}
		//verify the avatar url will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new\RangeException("author avatar url is too long"));
		}
		//store the avatar url
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	/**
	 * accessor method for author email
	 *
	 * @return string value for email
	 */
	public function getAuthorEmail() : string {
		return ($this->authorEmail);
	}
	/**
	 * mutator method for author email
	 *
	 * @param string new value for author email
	 * @throws InvalidArgumentException  if the email is not a string
	 * @throw \UnexpectedValueException if $newAuthorEmail is not valid
	 * @throws RangeException if the email is > 128 characters
	 */
	public function setAuthorEmail(string $newAuthorEmail): void {
		//verify email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorEmail) === true) {
			throw(new\InvalidArgumentException("email is empty or insecure"));
		}
		//verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new\RangeException("email is too long"));
		}
		//store the email
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accessor method for author Hash
	 *
	 * @return string value of hash
	 */
	public function getAuthorHash(): string {
		return $this->authorHash;
	}
	/**
	 * mutator method for author hash password
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 97 characters
	 * @throws \TypeError if author hash is not a string
	 */
	public function setAuthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		$newAuthorHash = strtolower($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("Author password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newAuthorHash)) {
			throw(new \InvalidArgumentException("Author password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("Author hash must be 97 characters"));
		}
		//store the hash
		$this->authorHash = $newAuthorHash;
	}
	/**
	 * accessor method for author username
	 *
	 * @return string value for username
	 */
	public function getAuthorUsername() : string {
		return ($this->authorUsername);
	}
	/**
	 * mutator method for author email
	 *
	 * @param string new value for author username
	 * @throws InvalidArgumentException  if the username is not a string
	 * @throw \UnexpectedValueException if $newAuthorUsername is not valid
	 * @throws RangeException if the token is > 32 characters
	 */
	public function setAuthorUsername(string $newAuthorUsername): void {
		//verify username is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new\InvalidArgumentException("username is empty or insecure"));
		}
		//verify the username will fit in the database
		if(strlen($newAuthorUsername) > 32) {
			throw(new\RangeException("username is too long"));
		}
		//store the avatar url
		$this->authorUsername = $newAuthorUsername;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() : array {
		$fields = get_obeject_vars($this);
		$fields[] = $this->authorId-> toString();
		unset($fields["authorHash"]);
		return ($fields);
	}
}
?>
