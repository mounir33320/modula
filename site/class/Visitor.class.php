<?php 
class Visitor{
	protected $id,
			  $lastName,
			  $firstName,
			  $email,
			  $message,
			  $ip,
			  $dateSendMessage;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $data){
		foreach($data as $key => $value){
			$method = "set" .ucfirst($key);

			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}

	public function mailValide($mail){
		return preg_match("#^[a-z0-9_.-]+@[a-z0-9_.-]{2,}.[a-z]{2,4}$#", $mail);
	}

	//Getters
	public function id(){
		return $this->id;
	}

	public function lastName(){
		return $this->lastName;
	}

	public function firstName(){
		return $this->firstName;
	}

	public function email(){
		return $this->email;
	}

	public function message(){
		return $this->message;
	}

	public function ip(){
		return $this->ip;
	}

	public function dateSendMessage(){
		return $this->dateSendMessage;
	}

	//Setters
	public function setId($id){
		$id = (int) $id;
		$this->id = $id;
	}

	public function setLastName($lastName){
		$lastName = htmlspecialchars($lastName);
		if(is_string($lastName)){
			$this->lastName = $lastName;
		}
	}

	public function setFirstName($firstName){
		$firstName = htmlspecialchars($firstName);
		if(is_string($firstName)){
			$this->firstName = $firstName;
		}
	}

	public function setEmail($email){
		$email = htmlspecialchars($email);
		$this->email = $email;		
	}

	public function setMessage($message){
		$message = htmlspecialchars($message);
		if(is_string($message)){
			$this->message = $message;
		}
	}

	public function setIp($ip){
		$this->ip = $ip;
	}

	public function setDateSendMessage($dateSendMessage){
		$this->dateSendMessage = $dateSendMessage;
	}
}