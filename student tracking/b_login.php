<?php
include 'header.php';
?>
        
<style>
    .form-horizontal{
                position: fixed;
                width:450px;
                margin-top: 200px;
                margin-left: 350px;
                    
     }
            .form-contents{
                border: 1px solid #c0c0c0;
                padding-top: 20px;
                padding-left: 20px;
            }
            .btn{
                width: 280px
            }
            
</style>     
     
 <body>    
    <div class="banner">
        <div class="banner-content">
            <h1>Student Tracking System</h1>
        </div>
        
    </div>   
    <div class="container">    
    
        <form class="form-horizontal" method="post" action="validate_user.php" role="form">
        <div class="form-contents">   
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                <input type="email" name="user_id" class="form-control" id="inputEmail3" placeholder="Email" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                <input type="password" name="user_passwd" class="form-control" id="inputPassword3" placeholder="Password" required>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Log In</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                        <label style="margin-left:35px"><a href="forgot_password.php">Forgot Password ?</a></label>
                    </div>
                      
                </div>
            </div>
        </div>
            
        </form>
        
 </div>   
    
      <script type="text/javascript" src="assets/js/jquery.min.js"></script>
      
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>               