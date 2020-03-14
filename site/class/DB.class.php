<?php 
class DB{
	protected $host = "localhost",
			  $dbname = "cdm",
			  $username = "root",
			  $password = "",
			  $db;

	public function __construct($host = null, $dbname = null, $username = null, $password = null){
		if($host != null){
			$this->host = $host;
			$this->dbname = $dbname;
			$this->username = $username;
			$this->password = $host;
		}

		try{
			$this->db = new PDO("mysql:host=".$this->host.";
										dbname=".$this->dbname.";
										charset=utf8",
										$this->username, 
										$this->password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}
		catch(EXCEPTION $e){
			die("<h1>Impossible de se connecter à la base de données</h1>". $e->getMessage());
		}
	}

	public function add(Visitor $visitor){
		$q = $this->db->prepare("INSERT INTO visitors(lastName, firstName, email, message, ip, dateSendMessage)
											VALUES(:lastName, :firstName, :email, :message, :ip, NOW())");

		$q->bindValue(":lastName", $visitor->lastName());
		$q->bindValue(":firstName", $visitor->firstName());
		$q->bindValue(":email", $visitor->email());
		$q->bindValue(":message", $visitor->message());
		$q->bindValue(":ip", $visitor->ip());
		$q->execute();

		$visitor->hydrate(["id" => $this->db->lastInsertId()]);
	}

	public function delete(Visitor $visitor){
		$this->db->exec("DELETE FROM visitors WHERE id = " .$visitor->id());
	}

	public function get($id){
		$info = (int) $id;
		$q = $this->db->prepare("SELECT * FROM visitors WHERE id = :id");
		$q->bindValue(":id", $id, PDO::PARAM_INT);
		$q->execute();

		$data = $q->fetch();
		
		return new Visitor($data);
	}

	public function getList(){
		$allVisitors = [];
		$q = $this->db->query("SELECT * FROM visitors ORDER BY dateSendMessage DESC");

		while($data = $q->fetch(PDO::FETCH_ASSOC)){
			$allVisitors[] = new Visitor($data);
		}
		return $allVisitors;
	}

	public function exists($id){
		$id = (int) $id;
		return (bool) $this->db->query("SELECT COUNT(*) FROM visitors WHERE id = " .$id)->fetchColumn();
	}

	public function getUser($login){
		$q = $this->db->prepare("SELECT * FROM admin WHERE user = :user");
		$q->bindValue(":user", $login);
		$q->execute();
		return $q->fetch(PDO::FETCH_OBJ);
		
	}

	public function userExists($login){
		$q = $this->db->prepare("SELECT COUNT(*) FROM admin WHERE user = :user");
		$q->bindValue(":user", $login);
		$q->execute();
		return (bool) $q->fetchColumn();
	}
}