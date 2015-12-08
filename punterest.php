<?php
class Punterest{
/*
    function __construct(){
        //database configuration
        $dbHost = "tcp:punterestserver.database.windows.net,1433";
        $dbUsername = 'alpuente@punterestserver';
        $dbPassword = 'Dankeschoen1';
        $dbName = 'punterestdb_2015-12-07T15-30Z';
        
        try {
            $conn = new PDO( "sqlsrv:Server= $dbHost ; Database = $dbName ", $dbUsername, $dbPassword);
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->db = $conn;
            
        }
        catch(Exception $e){
            die(var_dump($e));

            }
        }
  */  
    function get_rows($id = ''){
        if($id != ''){
            //fetch single row
            $query = $this->db->query("SELECT * FROM puns WHERE id = $id");
            $data = $query->fetch_assoc();
        }else{
            //fetch all rows
            $query = $this->db->query("SELECT * FROM puns");
            if($query->num_rows > 0){

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
            }else{
                $data = array();
            }
        }
        return $data;
    }
    
    function update( $data = array(), $conditions = array()){
        $data_array_num = count($data);
        $cols_vals = "";
        $condition_str = "";
        $i=0;
        foreach($data as $key=>$val){
            $i++;
            $sep = ($i == $data_array_num)?'':', ';
            $cols_vals .= $key."='".$val."'".$sep;
        }
        foreach($conditions as $key=>$val){
            $i++;
            $sep = ($i == $data_array_num)?"":" AND ";
            $condition_str .= $key."='".$val."'";
        }
        //update data
        $update = $this->db->query("UPDATE puns SET $cols_vals WHERE $condition_str");
        return $update?TRUE:FALSE;
    }
}
?>

