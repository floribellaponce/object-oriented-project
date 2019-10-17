<?php

namespace FloribellaPonce\ObjectOrientedProject;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use http\Exception\UnexpectedValueException;use Ramsey\Uuid\Uuid;

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
	 */
	private $authorId;
	/**
	 * activation token for the author account
	 * @var Uuid $authorId
	 */
	private $authorActivationToken;
	/**
	 * avatar (image) url for author
	 *
	 */
	private $authorAvatarUrl;
	/**
	 * email for author; this has a unique index.
 	 */
	private $authorEmail;
	/**
	 *hash for password for author
	 */
	private $authorHash;
	/**
	 *username for author; this has a unique index.
	 */
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
		$this->setAuthorId($newAuthorId)
		$this->set
		$this->set
		$this->set
		$this->set
		$this->set
	} catch(\UnexpectedValueException $exception) {
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
	 *mutator method for profile id
	 *
	 */
	}
	public function getAuthorId($newAuthorId): void {
		try{
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the author id
		$this->authorId = $uuid;
	}
}
?>
