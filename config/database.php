<?php
	/*
	--
	Code by Ganjar Hadiatna
	--
	*/
	class database
	{
		private $hostname = '127.0.0.1';
		private $username = 'root';
		private $password = 'delapanbelas';
		private $db_name = 'db_rentalmobil';
		public $conn = '';

		//connection
		function cn()
		{
			$this->conn = mysqli_connect(
				$this->hostname, 
				$this->username, 
				$this->password, 
				$this->db_name);
			if ($this->conn) {
				return true;
			}
			if (!$this->conn) {
				return false;
			}
			if (mysqli_connect_errno()) {
				return "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		}
		function cl()
		{
			return $this->conn->close();
		}

		//library
		function query($q)
		{
			if ($this->cn()) {
				$rest = $this->conn->query($q);
	            if ($rest) {
	                return $rest;
	            } else {
	                return $this->conn->error;
	            }
	        } else {
	            return $this->conn->error;
	        }

	        $this->cl();
		}
		function query_select($q)
		{
			if ($this->cn()) {
				$rest = $this->conn->query($q);
				if ($rest) {
		    		if ($rest->num_rows > 0) {
						$rows = [];
		    			while ($r = $rest->fetch_assoc()) {
		    				$rows[] = $r;
		    			}
						return $rows;
					}
					else if (empty($rest->num_rows)) {
						return 'Username atau password salah';
					} else {
						return $cn->conn->error;
					}
		    	}
	        } else {
	            return $this->conn->error;
	        }

	        $this->cl();
		}

		function convert_array($data, $stt)
		{
			$prep = [];
			foreach ($data as $key => $value) {
				$prep[$key] = "'".$data[$key]."'";
			}

			if ($stt == 'column') {
				return implode(', ', array_keys($data));
			}

			if ($stt == 'values') {
				return implode(', ', array_values($prep));
			}

		}
		
	}
	