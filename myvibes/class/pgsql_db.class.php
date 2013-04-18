<?php

	#  Author        : Rex S. Sacayan
	#  Modified by   : Aiko Katherine L. Olaer
	#  Date created  : June 20, 2012	
	#  Date modified : August 12, 2012		
	#  Description   : Class to make it very easy to deal with PostgreSQL database connections.
	
	
	class pgsql_db 
	{
		
		var $db_name = "myvibes";      # default db name
		var $db_user = "postgres"; 	# default db user
		var $db_pwd  = "password";     # default db password
		var $db_host = "localhost";  # default db host 
		var $db_port = 5432;
		var $db_conn = NULL;         # established database connection resource
		var $result  = NULL;         # resource from SQL statement
		
		
		function pgsql_db($dbuser="", $dbpwd="", $dbname="", $dbhost="")
		# Description: DB Constructor - connects to the server and selects a database
		{
			# replace class properties
			if($dbuser != "") $this->db_user = $dbuser;
			if($dbpwd  != "") $this->db_pwd  = $dbpwd;
			if($dbname != "") $this->db_name = $dbname;
			if($dbhost != "") $this->db_host = $dbhost;
			
			if ( !$this->connect() )
			{
				echo ("<ol><strong>Error establishing a database connection!</strong>
				          <li>Are you sure you have the correct user/password?</li>
						  <li>Are you sure that you have typed the correct hostname?</li> 
						  <li>Are you sure that the database server is running?</li>
					  </ol>");
			}
		}
		
		function connect($dbuser='', $dbpwd='', $dbname='', $dbhost='')
		{
			$debug = 0;
			$return_val = false;

			// Try to establish the server database handle
			if (!$this->db_conn)
			{       
				if($dbuser != "") $this->db_user = $dbuser;
				if($dbpwd  != "") $this->db_pwd  = $dbpwd;
				if($dbname != "") $this->db_name = $dbname;
				if($dbhost != "") $this->db_host = $dbhost; 
				
                $this->db_conn = @pg_connect("host=".$this->db_host." user=".$this->db_user." password=".$this->db_pwd." dbname=".$this->db_name." port=".$this->db_port); 
				
				if($this->db_conn){
					$return_val = true;
				}
				else{
					$return_val = false;
				}
			}
			else{ $return_val = true; }
	
			return $return_val; 
		}
		
		function query($sql)
		# Description: Use this function for Insert/Update/Delete/ query only
		{
			$str = "";
	        # Remove extra spaces in a string
			$sql = trim($sql);

			# If there is no existing database connection then try to connect again
			if(!isset($this->db_conn) || !$this->db_conn)
			{   
				$this->connect($this->db_user, $this->db_pwd, $this->db_name);
			}

			# Perform the query via std postgresql_query function..
			$this->result = @pg_query($this->db_conn, $sql);

			# If there is an error then take note of it..
			if($str=@pg_last_error($this->db_conn))
			{
				echo "<p>".$str."</p>";
				return false; 
			}
			
			return $this->result;
		}
		
		function get_var($sql)
		# Description: Return only a single data (one value) like SELECT email FROM customers WHERE id=12 
		{
			$data = array();
			if($sql == ""){return 0;}
			
			$this->result = pg_query($this->db_conn,$sql);
			if(pg_num_rows($this->result)>0){
   				$data = pg_fetch_array($this->result,0);
			}
	
			return $data[0];
		}
		
		function get_row($sql,$type="o")
		# Description: Returns a single row of data. Type is either Object or Array result. Default is Object
		# e.g. SELECT * FROM customers WHERE id=7
		{
	    	$data = array();
			if($sql == ""){return 0;}
			
			$this->result = pg_query($this->db_conn,$sql);
			if (pg_num_rows($this->result)>0){
   				if($type == "o"){ $data = pg_fetch_object($this->result,0); }
  				elseif($type == "a") { $data = pg_fetch_array($this->result,0); }
			}
	
			return $data;
		}
		
		function get_results($sql,$type="o")
		# Description: Returns a multiple rows of data. Type is either Object or Array result. Default is Object
		# e.g. SELECT * FROM customers WHERE address iLIKE '%suarez%'
		{
			$data = array();
			$i = 0;
			if($sql == ""){return $data;}
			
			$this->result = pg_query($this->db_conn,$sql);
			if($type == "o")
			{
				while ($row = @pg_fetch_object($this->result)){
	 			$data[$i++] = $row ;
				}
			}
			elseif($type == "a")
			{
				while ($row = @pg_fetch_array($this->result)){
					$data[$i++] = $row ;
				}		
			}
	
			return $data;
		}
	}
?>
