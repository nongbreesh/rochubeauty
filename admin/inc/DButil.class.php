<?
/*********************
Code by : Supachok Thotong
Email : Sthotong@gmail.com
*********************/

class DButil {
	var $db;
	var $dbtype;
	var $affected_rows;

	function DButil($dbtype='', $dbserver='', $dbuser='', $dbpassword='', $dbname='', $dbchar='') {
		$this->dbtype = $dbtype;
		if (empty($this->dbtype)) $this->dbtype = DBtype;
		if (empty($dbserver)) $dbserver = DBserver;
		if (empty($dbuser)) $dbuser = DBuser;
		if (empty($dbpassword)) $dbpassword = DBpassword;
		if (empty($dbname)) $dbname = DBname;
		if (empty($dbchar)) $dbchar = DBchar;
		if ($this->dbtype == 'mysql') {
			$this->db = mysql_connect($dbserver, $dbuser, $dbpassword);
			mysql_select_db($dbname, $this->db);
			if (!empty($dbchar)) {
				mysql_query("SET NAMES '".$dbchar."'", $this->db);
			}
		}
	}

	function close() {
		if ($this->db) {
			switch ($this->dbtype) {
				case "mysql" : mysql_close($this->db); break;
				case "mssql" : mssql_close($this->db); break;
			}
		}
		unset($this->db);
	}

	function change($dbname) {
		switch ($this->dbtype) {
			case "mysql" : mysql_select_db($dbname, $this->db); break;
			case "mssql" : mssql_select_db($dbname, $this->db); break;
		}
	}

	function row($rs) {
		$rs = $this->resultset($rs);
		$row = mysql_fetch_assoc($rs);
		mysql_free_result($rs);
		return $row;
	}

	function fetch($rs, $pk='', $fetch=MYSQL_ASSOC) {
		$rs = $this->resultset($rs);
		$result = array();
		switch ($this->dbtype) {
			case "mysql" : 
					while ($row = mysql_fetch_array($rs, $fetch)) {
						if (empty($pk)) array_push($result, $row);
						else $result[$row[$pk]] = $row;
					}
					mysql_free_result($rs);
				break;
			case "mssql" : 
					while ($row = mysql_fetch_array($rs)) {
						if (empty($pk)) array_push($result, $row);
						else $result[$row[$pk]] = $row;
					}
					mssql_free_result($rs);
				break;
		}
		return $result;
	}

	function fetchkey($rs, $key='') {
		$rs = $this->resultset($rs);
		$result = array();
		$fetch = MYSQL_NUM;
		if (!empty($key)) $fetch = MYSQL_ASSOC;
		switch ($this->dbtype) {
			case "mysql" : 
					while ($row = mysql_fetch_array($rs, $fetch)) {
						if (!empty($key)) $result[$row[$key]] = $row;
						else if (isset($row[1])) $result[$row[0]] = $row[1];
						else array_push($result, $row[0]);
					}
					mysql_free_result($rs);
				break;
			case "mssql" : 
					while ($row = mssql_fetch_row($rs)) {
						$result[$row[0]] = $row[1];
					}
					mssql_free_result($rs);
				break;
		}
		return $result;
	}

	function fetchgroup($rs, $group, $key='') {
		$rs = $this->resultset($rs);
		$result = array();
		switch ($this->dbtype) {
			case "mysql" : 
					while ($row = mysql_fetch_assoc($rs)) {
						if (!empty($key)) $result[$row[$group]][$row[$key]] = $row;
						else {
							if (!isset($result[$row[$group]])) {
								$result[$row[$group]] = array();
							}
							array_push($result[$row[$group]], $row);
						}
					}
					mysql_free_result($rs);
				break;
		}
		return $result;
	}

	function resultset($sql) {
		if (strpos($sql, " ") === false) $sql = "SELECT * FROM " . $sql;
		return $this->query($sql);
	}

	function limit($range, $page=0) {
	    if ($page == 0) return " LIMIT " . $range;
		else return " LIMIT " . (($page-1)*$range) . ", " . $range;
	}

	function execute($sql) {
		switch ($this->dbtype) {
			case "mysql" : $rs = mysql_query($sql, $this->db); break;
			case "mssql" : $rs = mssql_query($sql, $this->db); break;
			default : $rs = false;
		}
		if (!$rs) {
			$this->affected_rows = 0;
			//echo "ERROR : ",$sql;
			return false;
		}
		else {
			$this->affected_rows = mysql_affected_rows($this->db);
		}
		return $rs;
	}

	function slice($rows, $pageno, $pagesize) {
		return array_slice($rows, ($pageno-1)*$pagesize, $pagesize);
	}

	function query($sql) {
		switch ($this->dbtype) {
			case "mysql" : $rs = @mysql_query($sql, $this->db); break;
			case "mssql" : $rs = @mssql_query($sql, $this->db); break;
		}
		if (!$rs) {
			echo "ERROR : ",$sql;
			return false;
		}
		else return $rs;
	}

	function numrows($rs) {
		$rs = $this->resultset($rs);
		switch ($this->dbtype) {
			case "mysql" : 
					$numrows = mysql_num_rows($rs);
					mysql_free_result($rs);
				break;
			case "mssql" : 
					$numrows = mssql_num_rows($rs); 
					mssql_free_result($rs);
				break;
		}
		return $numrows;
	}

	function str($str, $limit=0) {
		if ($limit != 0) {
			$str = substr($str, 0, abs($limit));
		}
		$str = mysql_real_escape_string($str);
		return $str;
	}

	function sqlfind($sql, $parameters) {
		$i = 0;
		$position = strpos($sql, "?");
		while ($position !== false) {
			$sql = substr_replace($sql, $parameters[$i], $position, 1);
			$position = strpos($sql, "?", $position+strlen(strval($parameters[$i])));
			$i++;
		}
		return $sql;
	}

	function sqlfindkey($sql, $parameters) {
		foreach ($parameters as $key=>$value) {
			$position = strpos($sql, "?".$key);
			if ($position !== false) {
				$sql = substr_replace($sql, mysql_real_escape_string($value), $position, strlen($key)+1);
			}
		}
		return $sql;
	}

	function lastid() {
		switch ($this->dbtype) {
			case "mysql" : return mysql_insert_id($this->db);
		}
	}

	function maxid($pk, $table) {
		$sql = "SELECT MAX(" . $pk . ") FROM " . $table;
		$rs = $this->resultset($sql);
		switch ($this->dbtype) {
			case "mysql" : 
					$max = mysql_result($rs, 0)+1;
					mysql_free_result($rs);
				break;
			case "mssql" : 
					$max = mssql_result($rs, 0)+1;
					mssql_free_result($rs);
				break;
		}
		return $max;
	}

	function single($rs) {
		$rs = $this->resultset($rs);
		switch ($this->dbtype) {
			case "mysql" : if (mysql_num_rows($rs) == 0) return 0; break;
			case "mssql" : if (mssql_num_rows($rs) == 0) return 0; break;
		}
		switch ($this->dbtype) {
			case "mysql" : 
					$numrows = mysql_result($rs, 0);
					mysql_free_result($rs);
				break;
			case "mssql" :
					$numrows = mssql_result($rs, 0);
					mssql_free_result($rs);
				break;
		}
		return $numrows;
	}

}

function handle_connection_close() {
	if (isset($GLOBALS['db']->db)) {
		$GLOBALS['db']->close();
	}
}

$db = new DButil('mysql',ServerName,UserName,UserPassword,DataBaseName,'utf8');

register_shutdown_function("handle_connection_close");

?>
