<?php
namespace FloribellaPonce\ObjectOrientedProject;
require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * This is the information that is stored for a author.
 *
 * @author Floribella Ponce <fponce2@cnm.edu>
 * @version 0.0.1
 **/

class Author implements \JsonSerializable {
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
	 * @param string|Uuid $newAuthorId string containing new author id
	 * @param string $newAuthorActivationToken string containing new activation token
	 * @param string $newAuthorAvatarUrl string containing new avatar url
	 * @param string $newAuthorEmail string containing new email
	 * @param string $newAuthorHash string containing new hash
	 * @param string $newAuthorUsername string containing new username
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/

	public function __construct($newAuthorId, ?string $newAuthorActivationToken, string $newAuthorAvatarUrl, string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} catch(\InvalidArgumentException | \RangeException | \Exception |\TypeError $exception) {
			//determine wat exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
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
	 * @param Uuid| string $newAuthorId new value for author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if Author Id is not a uuid or string
	 **/

	public function setAuthorId($newAuthorId): void {
		try{
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
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

	public function getAuthorActivationToken() : ?string {
		return ($this->authorActivationToken);
	}

	/**
	 * mutator method for author activation token
	 *
	 * @param string $newAuthorActivationToken new value for author activation token
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */

	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
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
	 * @param string $newAuthorAvatarUrl new value for author avatar url
	 * @throws \InvalidArgumentException  if $newAuthorAvatarUrl is not a string
	 * @throws \RangeException if $newAuthorAvatarUrl is > 255 characters
	 * @throws \TypeError if $newAuthorAvatarUrl is not a string
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
	 * @param string $newAuthorEmail new value for author email
	 * @throws \InvalidArgumentException  if the $newAuthorEmail is not a string
	 * @throws \RangeException if the $newAuthorEmail is > 128 characters
	 *  @throws \TypeError if $newAuthorEmail is not a string
	 */

	public function setAuthorEmail(string $newAuthorEmail): void {
		//verify email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("email is empty or insecure"));
		}
		//verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("email is too long"));
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
	 * mutator method for author username
	 *
	 * @param string $newAuthorUsername new value for author username
	 * @throws \InvalidArgumentException  if $newAuthorUsername is not a string
	 * @throws \RangeException if the $newAuthorUsername is > 32 characters
	 * @throws \TypeError if $newAuthorUsername is not a string
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
		//store the author username
		$this->authorUsername = $newAuthorUsername;
	}

	/**
	 * insert this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function insert(\PDO $pdo) : void {
		//query template
		$query = "INSERT INTO author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) VALUES(:authorId, :authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holders in this template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken, "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * updates author Avatar Url for from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function update(\PDO $pdo) : void {
		$query = "UPDATE author SET authorId=:authorId, authorActivationToken=:authorActivationToken, authorAvatarUrl=:authorAvatarUrl, authorEmail=:authorEmail, authorHash=:authorHash, authorUsername=:authorUsername WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken, "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * deletes author from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */

	public function delete(\PDO $pdo) : void {
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * gets the author by author id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorId author id to search for
	 * @return Author|null Author found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 */

	public static function getAuthorByAuthorId(\PDO $pdo, $authorId): Author {
		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		$query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		try {
			$Author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$Author = new Author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
			}
		} catch (\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($Author);
	}

	/**
	 * gets Author by author email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorEmail author email to search by
	 * @return \SplFixedArray SplFixedArray of Authors found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */

	public static function getAuthorbyAuthorEmail(\PDO $pdo, string $authorEmail) : \SplFixedArray {
			$authorEmail = trim($authorEmail);
			$authorEmail = filter_var($authorEmail, FILTER_VALIDATE_EMAIL);
			if(empty($authorEmail) === true) {
				throw(new \PDOException("author email is not valid"));
			}
			$authorEmail = str_replace("_","\\_", str_replace("%", "\\%", $authorEmail));

			$query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername FROM author WHERE authorEmail = :authorEmail";
			$statement = $pdo->prepare($query);

			$authorEmail = "%$authorEmail%";
			$parameters = ["authorEmail"=> $authorEmail];
			$statement-> execute($parameters);

			$authors = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			while(($row = $statement->fetch()) !== false) {
				try{
					$author = new Author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
					$authors[$authors->key()] = $author;
					$authors->next();
				} catch(\Exception $exception) {
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
				return($authors);
			}
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
