<?php

namespace Models;

class Master_Model {
	
	protected $table;
	protected $where;
	protected $columns;
	protected $limit;
    protected $join;
    protected $orderBy;
	protected $dbconn;
	
	public function __construct( $args = array() ) {
		$args = array_merge( array(
			'where' => '',
			'columns' => '*',
			'limit' => 0,
            'join' => '',
            'orderBy' => '',
            'page' => 0
		), $args );
		
		if ( ! isset( $args['table'] ) ) {
			die( 'Table not defined. Please define a model table.' );
		}
		
		extract( $args );
		
		$this->table = $table;
		$this->where = $where;
		$this->columns = $columns;
 		$this->limit = $limit;
        $this->join = $join;
        $this->orderBy = $orderBy;

		$db = \Lib\Database::get_instance();
		$this->dbconn = $db::get_db();
        mysqli_set_charset($this->dbconn, 'utf8');
	}

    public function find( $args = array() ) {
        $args = array_merge( array(
            'table' => $this->table,
            'join' => '',
            'where' => '',
            'columns' => '*',
            'orderBy' => '',
            'limit' => $this->limit
        ), $args );

        extract( $args );

        $query = "SELECT {$columns} FROM {$table}";

        if(!empty($join)) {
            $query .= ' JOIN ' . $join;
        }

        if( ! empty( $where ) ) {
            $query .= ' WHERE ' . $where;
        }

        if(!empty($orderBy)) {
            $query .= ' ORDER BY ' . $orderBy;
        }

        if( ! empty( $limit ) ){
            $skip = 0;
            if( ! empty( $page ) ) {
                $skip = $limit * ($page - 1);
            }

            $query .= " LIMIT {$skip}, {$limit}";
        }

        $result_set = $this->dbconn->query( $query );
        $results = $this->process_results( $result_set );
        return $results;
    }

    public function get( $idName , $id ) {
		$results = $this->find( array( 'where' => $idName . ' = ' .$id ) );

		return $results;
	}

    public function add( $pairs ) {
		$keys = array_keys( $pairs );
		$values = array();

		foreach( $pairs as $key => $value ) {
			$values[] = "'" . $this->dbconn->real_escape_string( $value ) . "'";
		}

		$keys = implode( $keys, ',' );
		$values = implode( $values, ',' );

		$query = "insert into {$this->table}($keys) values($values)";
		$this->dbconn->query( $query );

		return $this->dbconn->affected_rows;
	}

    public function delete( $idName, $id ) {
		$query = 'DELETE FROM ' . $this->table . ' WHERE ' . $idName . '  = ' . intval( $id );
		$this->dbconn->query( $query );
		return $this->dbconn->affected_rows;
	}

    public function update( $idIdent, $model ) {
		$query = "UPDATE " . $this->table . " SET ";

		foreach( $model as $key => $value ) {
			if( $key === 'id' ) continue;
			$query .= "$key = '" . $this->dbconn->real_escape_string( $value ) . "',";
		}

		$query = rtrim( $query, "," );
		$query .= " WHERE " . $idIdent . " = " . $model['id'];
		$this->dbconn->query( $query );
		return $this->dbconn->affected_rows;
	}

	protected function process_results( $result_set ) {
		$results = array();
		
		if( ! empty( $result_set ) && $result_set->num_rows > 0) {
			while($row = $result_set->fetch_assoc()) {
				$results[] = $row;
			}
		}
		
		return $results;
	}
}