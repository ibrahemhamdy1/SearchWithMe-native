<?php
// sleep(2);
session_start();

$func ="includes/functions/"; 
include $func.'functions.php';
include 'admin/connect.php';
//$pageTitle=lang('Login');
if(isset($_SESSION['user'])){header('Location: index.php');}
///here  we will  star the  code  
if($_SERVER['REQUEST_METHOD']=='POST'){
    ///if  it  comes  from  the  Signup Post
		
		$userFirtstname  = $_POST['username'];
		$userlastname    = $_POST['lastname'];
		$userMobile      = $_POST['Mobile'];
		$userCity        = $_POST['City'];
		$useraddres      = $_POST['addres'];

		$password        = $_POST['password'];
		$password2 		 = $_POST['password2'];
		$email     		 = $_POST['email'];
		// $image 			 = $_POST['image'];
		//Start Image  Upload Staff
		

			# code...

		//End Image  Upload Staff

		
				

				// $file_name =$_FILES['image']['name'];
                // $file_tmp= $_FILES['image']['tmp_name'];
                // $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
                // $base64 = file_get_contents($file_tmp);
                // $file_name =base64_encode($base64);

				//Check if there is no Error Proced The Update Operation
				
				//Update The  Userinfo In  Database 
                    try{
                            $check=ceckItem("Email","users",$email);
                            if ($check==0) {
                                
                                    // get the uploaded file name
                                    
                                        $stmt=$con->prepare("INSERT INTO 
                                                                users(Username,user_last_name,User_mobile,User_city,User_address,Password,Email,RgSttatus,Dated) 
                                                            values(:zfirstuserName,:zuser_last_name,:zUser_mobile,:zUser_city,:zUser_address,:zpass,:zemail,0,now())");

                                    if($stmt->execute(array(
                                            'zfirstuserName'  =>$userFirtstname,
                                            'zuser_last_name' =>$userlastname,
                                            'zUser_mobile'    =>$userMobile,
                                            'zUser_city'      =>$userCity,
                                            'zUser_address'   =>$useraddres,
                                            'zpass'           =>sha1($password),
                                            'zemail'          =>$email,
                                            // 'zimage'          =>$file_name,
                
                                            )))
                                            {
                                               

                                                     //here  we  start to  set  the  sessin to  the  user  after  he  registered
                                                //check if  the user Exist In Datebase
                                                 $stmt2=$con->prepare("SELECT 
                                                 *  FROM 
                                             users 
                                        where 
                                                 Email = ? 
                                         and 
                                                 password=?
                                         

                                             ");
                                     $stmt2->execute(array($email ,sha1($password)));
                                     $Get=$stmt2->fetch();
                                     $count=$stmt2->rowCount();
                                     //if  count >0 this Mean the Datebase Contain Record aboit this Username
                                     if ($count>0) {
                                     $_SESSION['user']= $Get['Email'] ; 
                                     $_SESSION['userImage']=$Get['image'];
                                     //Register Session Name
                                     $_SESSION['uid']=$Get['UserID'];  //Register Session UserID	

                                     }


                                                    echo "registered";
                                            }else{
                                                echo"Query could not execute !";
                                            }	

                                        /* //ECHO Success Message
                                        $successMsg=lang('Congrats'); */
                                            
                            }else{
                                echo"1"; //  not available
                            }

                                
                
							
}catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>
