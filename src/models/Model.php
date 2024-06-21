<?php

abstract class Model {
    private $dsn="mysql:dbname=rapidzburger;host=localhost;charset=utf8";
	private $login="root";
	private $password="";
	protected $pdo;
	protected $table;

    public function __construct(){

		if($this->pdo == null){	
			$this->pdo = new PDO($this->dsn, $this->login, $this->password);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		}
	}
	
	public function findById(int $id)
	{
		$query = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
		$query->execute(['id' => $id]);
		return $query->fetch();
	}

	public function findAll()
	{
		$query = $this->pdo->query("SELECT * FROM $this->table");
		return $query->fetchAll();
	}

	public function deleteById(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
		$query->execute(['id' => $id]);
    }
}