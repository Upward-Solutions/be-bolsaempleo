<?php
#[AllowDynamicProperties]

class PersonData {
	public static $tablename = "person";
    
	public function PersonData(){
        $this->id = "";
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,lastname,file,phone,email,job_id,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->file\",\"$this->phone\",\"$this->email\",$this->job_id, NOW())";
		return Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto PersonData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set code=\"$this->code\",name=\"$this->name\",ruc=\"$this->ruc\",phone=\"$this->phone\",email=\"$this->email\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PersonData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonData());
	}
	
	public static function getAllPaginated($page = 1, $limit = 20){
		$offset = ($page - 1) * $limit;
		$sql = "select * from ".self::$tablename." order by created_at desc limit $limit offset $offset";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonData());
	}
	
	public static function countAll(){
		$sql = "select count(*) as total from ".self::$tablename;
		$query = Executor::doit($sql);
		$total = $query[0]->fetch_object();
		return $total->total;
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonData());
	}
	
	public static function getByJobId($job_id, $page = 1, $limit = 20){
		$offset = ($page - 1) * $limit;
		$sql = "select * from ".self::$tablename." where job_id=$job_id order by created_at desc limit $limit offset $offset";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonData());
	}
	
	public static function countByJobId($job_id){
		$sql = "select count(*) as total from ".self::$tablename." where job_id=$job_id";
		$query = Executor::doit($sql);
		$total = $query[0]->fetch_object();
		return $total->total;
	}
}

?>