<?php

  class Config
  {

            private $SERVERNAME = "localhost";
            private $USERNAME = "root";
            private $PASSWORD = "";
            private $DATABASENAME = "whopay";
            private $CONN;
            private $USER = "user";
            private $POINT = "point";

            public function Connection()
            {
                $this->CONN = mysqli_connect($this->SERVERNAME,$this->USERNAME,$this->PASSWORD,$this->DATABASENAME);
            }


            public function InsertUser($First_Name,$Last_Name,$Email_Id,$Password)
            {
                
                    $this->Connection();
                
                    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

                    $qu = "Insert into $this->USER(first_name,last_name,email,password) values('$First_Name','$Last_Name','$Email_Id','$hashed_password')";

                    $res1 = mysqli_query($this->CONN,$qu);
                    $res  = mysqli_insert_id($this->CONN);
                    return [$res1,$res];
                
            }

            public function GoogletUser($First_Name,$Last_Name,$Email_Id,$Password)
            {
                
                    $this->Connection();

                    $qu = "Insert into $this->USER(first_name,last_name,email,password) values('$First_Name','$Last_Name','$Email_Id','$Password')";

                    $res1 = mysqli_query($this->CONN,$qu);

                    return $res1;
                
            }


            public function checkUser($Email_Id)
            {
                $this->Connection();

                $query = "SELECT * FROM $this->USER WHERE email='$Email_Id';";

                $res = mysqli_query($this->CONN, $query);
                
                
                return $res;

            }

            public function F_L_Name($id,$fname,$lname)
            {
                $this->Connection();

                $query = "Update $this->USER set first_name = '$fname',last_name='$lname' WHERE u_id= $id ;";

                $res = mysqli_query($this->CONN, $query);
                
                return $res;

            }

            public function signin_user($Email_Id, $Password) {
                $this->Connection();
    
                $query = "SELECT * FROM $this->USER WHERE email='$Email_Id';";
    
                $res = mysqli_query($this->CONN, $query);  // obj of mysqli_result class
    
                $record = mysqli_fetch_assoc($res);
    
                if($record) {
    
                    // password_verify(raw_password, hashed_password);   => return bool
                    $k =[];
                    $isVerified = password_verify($Password, $record['password']);
                    $k['isVerified'] = $isVerified;
                    $k['u_id'] = $record['u_id'];
                    return $k;  // true or false
                } else {
                    return false;
                }
            }

            public function addPoinData($total_amount,$u_id,$last_withdraw,$ad_count)
            {

                $this->Connection();
                

                $qu = "Insert into $this->POINT(total_amount,u_id,last_withdraw,ad_count) values($total_amount,$u_id,$last_withdraw,$ad_count)";

                $res1 = mysqli_query($this->CONN,$qu);

                return $res1;

            }

            public function AmountPoint($id,$total_amount)
            {
                $this->Connection();

                $query = "Update $this->POINT set total_amount = $total_amount WHERE u_id= $id;";

                $res = mysqli_query($this->CONN, $query);
                
                return $res;

            }
            public function LastWithdrawPoint($id,$last_withdraw)
            {
                $this->Connection();

                $query = "Update $this->POINT set last_withdraw = $last_withdraw WHERE u_id= $id;";

                $res = mysqli_query($this->CONN, $query);
                
                return $res;

            }
            public function AdCountPoint($id,$ad_count)
            {
                $this->Connection();

                $query = "Update $this->POINT set ad_count = $ad_count WHERE u_id= $id;";

                $res = mysqli_query($this->CONN, $query);
                
                return $res;

            }

           public function checkPoint($id)
            {
                $this->Connection();

                $query = "SELECT * FROM $this->POINT WHERE u_id=$id;";

                $res = mysqli_query($this->CONN, $query);
            
                return $res;
            }

            public function AllData($id)
            {
                $this->Connection();

                $query = "SELECT * FROM $this->POINT p ,$this->USER u WHERE  p.u_id = u.u_id and u.u_id=$id;";

                $res = mysqli_query($this->CONN, $query);
            
                return $res;
            }
  }


?>