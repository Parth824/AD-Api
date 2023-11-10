<?php


include('../Config/config.php');

    class Api{
        public function regUser($First_Name,$Last_Name,$Email_Id,$Password)
        {
             $Config = new Config();
             $res1 = $Config->checkUser($Email_Id); 
             
             if(mysqli_num_rows($res1)>0)
             {
                 echo json_encode(['result'=>'Have User']);
             }
             else{
                 $res = $Config->InsertUser($First_Name,$Last_Name,$Email_Id,$Password);

                 if($res[0])
                 {
                     echo json_encode(['result'=>'Insert Succfully']);
                 }
                 else
                 {
                     echo json_encode(['result'=>'Not Insert']);
                 }
             }
        }

        public function AuthGoogle($First_Name,$Last_Name,$Email_Id,$Password)
        {
             $Config = new Config();
             $res1 = $Config->checkUser($Email_Id); 
             
             if(mysqli_num_rows($res1)>0)
             {
                $k = mysqli_fetch_assoc($res1);
                if($k)
                {
                    echo json_encode(['result'=>'Sign in successfully...','u_id'=>$k['u_id']]);
                }
             }
             else
              {
                 $res = $Config->InsertUser($First_Name,$Last_Name,$Email_Id,$Password);
                
                 if($res[0])
                 {
                    
                     echo json_encode(['result'=>'Insert Succfully' ,'u_id'=> $res[1]]);
                 }
                 else
                 {
                     echo json_encode(['result'=>'Not Insert']);
                 }
             }
        }


        public function updateUser($id,$fname,$lname){

                 $Config = new Config();
                 $res = $Config->F_L_Name($id,$fname,$lname);
                
                 if($res)
                 {
                    
                     echo json_encode(['result'=>'update Succfully']);
                 }
                 else
                 {
                     echo json_encode(['result'=>'Not update']);
                 }
        }
        
        public function singin_to_user($Email_Id,$Password)
           {
                $Config = new Config();

                $res = $Config->signin_user($Email_Id,$Password);
                if($res)
                {
                    if($res['isVerified']) {
                        echo json_encode(['result'=>'Sign in successfully...','u_id'=>$res['u_id']]);
                    } else {
                        echo json_encode(['result'=>'password invalid']);
                    }
                }
                else {
                    echo json_encode(['result'=>'email not reguser']);
                }
            
           }

           
           public function AddPoint($total_amount,$u_id,$last_withdraw,$ad_count){

            $Config = new Config();
            $res = $Config->addPoinData($total_amount,$u_id,$last_withdraw,$ad_count);
           
            if($res)
            {
               
                echo json_encode(['result'=>'Insert Succfully']);
            }
            else
            {
                echo json_encode(['result'=>'Not Insert']);
            }

            }


            public function updateAmount($id,$total_amount){

                $Config = new Config();
                $amount = ($_POST['total_amount'] * 70) / 100;
                $res1 = $Config->checkPoint($id);
                $data = mysqli_fetch_assoc($res1);
                if($res1)
                {
                    $amount = $amount + $data['total_amount'];
                    $res = $Config->AmountPoint($id,$amount);
               
                    if($res)
                    {
                    
                        echo json_encode(['result'=>'update Succfully']);
                    }
                    else
                    {
                        echo json_encode(['result'=>'Not update']);
                    }
                }
                else{
                    echo json_encode(['result'=>'Not Select']);
                }

                
            }

            public function updateWithdrw($id,$last_withdraw){

                $Config = new Config();
                $res = $Config->LastWithdrawPoint($id,$last_withdraw);
               
                if($res)
                {
                   
                    echo json_encode(['result'=>'update Succfully']);
                }
                else
                {
                    echo json_encode(['result'=>'Not update']);
                }
            }

            public function updateAd($id,$ad_count){

                $Config = new Config();
                $res = $Config->AdCountPoint($id,$ad_count);
               
                if($res)
                {
                   
                    echo json_encode(['result'=>'update Succfully']);
                }
                else
                {
                    echo json_encode(['result'=>'Not update']);
                }
            }

            public function allData($id)
            {
                $Config = new Config();
                $res = $Config->AllData($id);

                $arry =[];
                if($res)
                {
                    while($data = mysqli_fetch_assoc($res))
                    {
                         array_push($arry,$data);
                    }
                    echo json_encode($arry);
                }
                else
                {
                    echo json_encode(['result' => 'selection failed']);
                }
            }
    }

?>