<!DOCTYPE html>
<html>
<head>
	<title>Banking</title>
	<?php require 'assets/autoloader.php'; ?>
	<?php require 'assets/function.php'; ?>
	<?php
    $con = new mysqli('localhost','root','','mybank');
    define('bankName', 'SPARKS BANK');
	
		$error = "";
		if (isset($_POST['userLogin']))
		{
			$error = "";
  			$user = $_POST['email'];
		    $pass = $_POST['password'];
		   
		    $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
		    if($result->num_rows>0)
		    { 
		      session_start();
		      $data = $result->fetch_assoc();
		      $_SESSION['userId']=$data['id'];
		      $_SESSION['user'] = $data;
		      header('location:index.php');
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
		    }
		}
		if (isset($_POST['signup']))
		{
  			$user = $_POST['uemail'];
		    $pass = $_POST['upassword'];
			$name = $_POST['uname'];
		  	$bal = $_POST['ubal'];
		  	$accnum = $_POST['accnum'];
			$branch = $_POST['branch'];
			$type =$_POST['accntype'];
			$error1='';
			$error='';

		   
		    $result ="INSERT INTO useraccounts (email,password,name,balance,accountNo,branch, accountType) VALUES('$user','$pass','$name','$bal','$accnum','$branch','$type')";
		    if(mysqli_query($con,$result))
		    { 
				$error1 = "<div class='alert alert-warning text-center rounded-0'>created successfully</div>";
				echo $error1;
		     }
		    else
		    {
		      $error = "<div class='alert alert-warning text-center rounded-0'>unable to process</div>";
		    }
		}
	 ?>
</head>
<body style="background: url(images/money.jpg);background-size: 100%">
<h1 class="alert alert-success rounded-0"><?php echo bankName; ?><small class="float-right text-muted" style="font-size: 12pt;"><kbd>Presented by:Srikar abhi</kbd></small></h1>
<br>
<?php echo $error ?>
<br>
<div id="accordion" role="tablist" class="w-25 float-right shadowBlack" style="margin-right: 222px">
	<br><h4 class="text-center text-black">Log-In</h4>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a style="text-decoration: none;" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <button class="btn btn-outline-success btn-block">User</button>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <form method="POST">
       	<input type="email"  name="email" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="password"  class="form-control" required placeholder="Enter Password">
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="userLogin">Enter </button>
       </form>
      </div>
    </div>
  </div>
	<br><h4 class="text-center text-black">Sign-up</h4>
  <div class="card rounded-0">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a style="text-decoration: none;" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
         <button class="btn btn-outline-success btn-block">Sign-up</button>
        </a>
      </h5>
    </div>

    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <form method="POST">
       	<input type="email"  name="uemail" class="form-control" required placeholder="Enter Email">
       	<input type="password" name="upassword"  class="form-control" required placeholder="create Password">
       	<input type="text" name="uname"  class="form-control" required placeholder="Enter Full name">
       	<input type="text" name="ubal"  class="form-control" required placeholder="Enter current balance">
       	<input type="text" name="accnum"  class="form-control" required placeholder="Enter account number">
       	<input type="text" name="branch"  class="form-control" required placeholder="Enter the branch ">
       <p>select your account type:<select name="accntype" id="atype">
  				<option value="savings">savings</option>
  				<option value="current">current</option>
  				<option value="fixed">fixed</option>
			</select></p>
       	<button type="submit" class="btn btn-primary btn-block btn-sm my-1" name="signup">Enter </button>
       </form>
      </div>
    </div>
  </div>
  </div>
  
  </div>
</div>
</body>
</html>