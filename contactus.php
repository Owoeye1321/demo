<?php
    include "header.html";
     include "nav.html";
      function test_data($data)
     {
       $data = trim($data);
       $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;   
     }
     $connection = new mysqli("localhost","root","","Edtech");

     if(isset($_POST["submit"])){
         
       $fullname =  test_data($_POST["fullname"]);
       $phone = test_data( $_POST["phone"]);
       $email =  test_data($_POST["email"]);
       $message =  test_data($_POST["message"]);

       if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
        $_SESSION["err"] = "<span style='color:red;'>Only letters and white space allowed for username</span>";
      }     if (!preg_match("/^[a-zA-Z ]*$/",$message)) {
        $_SESSION["err"] = "<span style='color:red;'>Only letters and white space allowed for username</span>";
      }  
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["err"] = "<span style='color:red;'>Invalid email format</span>";
      }
      if (preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)) {
         $_SESSION["err"] = "";
       } 
       elseif(preg_match('/^[0-9]{11}+$/', $phone)){
       $_SESSION["err"] = "";
       }elseif(preg_match('/^\+[0-9]{1,3}-[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)){
      $_SESSION["err"] = "";
      }
      if(empty($_SESSION["err"]) & isset($fullname) & isset($phone) & isset($email) & isset($message)){
        if($connection){
          $sql = "INSERT INTO `clients` (`fullname`,`phone`,`email`,`message`) VALUES ('$fullname','$phone','$email','$message')";
          $result = $connection->query($sql);
          if($result > 0){
            echo "<script>alert('Operation Successful')</script>";      
            //Sending email notification to official
            if(mail('Owoeye1321@gmail.com',$fullname,$message,"from:$email")){
              echo "<script>alert('Access successfully')</script>";
              mail($email,"Mr seun website","Thanks for your message,we are on it","From:Owoeye1321@gmail.com");
              }else{
                  echo "<script>alert('Unable to send email')</script>";
              }
          }else{
            echo "<script>alert('Operation failed')</script>";
          }
         
        }else{
          echo "<script>alert('Database connection failed')</script>";
        }


      }
      
     }

    ?>
    <div class = "imageDescription" style = "height:70vh">
        <center><p class ="bigphrase">Contact Us</p></center>


    </div>
    <div class = "row" style="margin-top: 30px;">
    <div class ="col-sm-12 col-md-6 col-lg-6" style = "padding-top:80px;padding-left:60px;">
    <strong style = 'color:black;font-size:35px;'>Address</strong>
    <p>42,church avenue street<br> alagdado lagos state <br> nigeria and africa and other shogunle<br> and oshodi</p>
    <p style = 'color:black;font-size:35px;font:lighter;margin-top:30px;'>Email</p><br>
    <p  style = 'color:black;font-size:25px;margin-bottom:-5px;'>Scolarship/Admission</p>
    <a href ="https://www.Owoeye1321@gmail.com" style = 'color:blue;font-size:18px;text-decoration:none'>Owoeye1321@gmail.com</a><br><br>
    <p  style = 'color:black;font-size:20px;margin-bottom:-5px;'>Accomodation</p>
    <a href ="https://www.Owoeye1321@gmail.com"   style = 'color:blue;font-size:18px;text-decoration:none'>Owoeye1321@gmail.com</a><br><br>

</div>
           
    <div  class ="col-sm-12 col-md-6 col-lg-6" style = "padding:150px 40px 20px 40px ;">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype ="multipart/form-data">
    <input class="form-control" type="text" required placeholder="Full name"  name="fullname" style="margin-bottom: 10px; border-radius:5px;">
  <input class="form-control" type="text" required placeholder="Phone" name="phone" style=" border-radius:5px;margin-bottom: 10px;">
   <input class="form-control" type="email" required placeholder="Email" name="email" style=" border-radius:5px;margin-bottom: 10px;">
   <textarea name ="message" placeholder= "Type message here" class ="form-control"></textarea>
             <i style="color:red; font-size:13px;">
    		 				<?php if (isset($_SESSION["err"])){
     echo $_SESSION["err"];
                   }
                    ?></i><br>
 <input class="btn btn-outline-primary" type="submit" value="Submit" name="submit" style="width: 195px;border-radius:5px;float: left;box-shadow: 2px 2px 2px 2px lightblue;"><br>
    		 	
       
    		
    </form>
       
    
    </div>

</div>



    <?php
  include "footer.html";
  ?>