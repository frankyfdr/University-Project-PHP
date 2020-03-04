<?php
session_start();

// checking if GET price is set
if(isset($_GET['price']))
{
        $price = $_GET["price"];
        $name = $_GET["name"];
        $img = $_GET["img"];   
}
// checking if GET price is set
if(isset($_GET['error']))
        $error = $_GET["error"]; 

       
?>

<html>  
    
<head>
<link rel="stylesheet" type="text/css" href="styleDelivery.css" />
</head>
<body>
<h1>Florist Shop</h1>
  
    
    
   
<hr>
    <!-- steps view for user infromation -->
    <div class="order">
        <svc class="step1">Delivery Details</svc>
        <text class="stepText">--------------------------</text>
        <svc class="step2">Payment</svc>
        <text class="stepText">--------------------------</text>
        <svc class="step2">Confirmation</svc>
      
    </div>
	<!-- if there is any erro is going to be showed inside this div -->
    <div class="error">
        <?php
    
    // checking if there is any erro and what kind of error
    if($error != null)
        switch($error)
        {
        case '1': echo "<p>Delivery Date Invalid</p>";break;
        case '2': echo "<p>ERROR: Name, Address, City and Post Code is Required</p>";break;
        case '3': echo "<p>Quantity Error:   Minimum 1</p>";break;
        
        default:;
        }
        
        ?>
   
    </div>
    
<div class="FormDiv">
   <!-- form fields for the delivery information  -->
    <form action="payment.php" method="post">
        <p class="pForm"> Full Name:<br> <input name="fullname" type="text"></p>
        <p class="pForm"v>Address:<br> <input name="address" type="text"> </p>
        <p class="pForm">City: <br><input name="city" type="text"></p>
        <p class="pForm">Post Code:<br> <input name="postcode" type="text"></p>
        
        <p class="pForm">Delivery Date:<br> <input name="Ddate" type="date"></p>
        <p class="pForm">Delivery time: <br><input name="Dtime" type="datetime"></p>
        <p class="pForm">Quantity: <br><input style="width:50px" name="qnt" type="number" value="1"></p>
        <p class="pForm">Message to recipient: <br>
            <textarea style="width: 250px; height: 100px " class="pForm" name="msg" type="number" ></textarea></p>
        
        <input type="hidden" name="price" value=<?php echo $price; ?> /> 
        <input type="hidden" name="name" value=<?php echo $name; ?> />
        <input type="hidden" name="img" value=<?php echo $img; ?> /> 
        <button type="submit" >Confirm</button>
    </form>
    
    
        <div class="infoDiv">
        
        <!-- flower selected information -->
        <img class="img" src=<?php echo $img ?> /> 
            <p><Text>Flower Name: </Text><Text><?php echo $name; ?></Text></p>
            <p><Text>Price: </Text><Text><?php echo "£".$price; ?></Text></p>
        </div>
</div>
    
</body>
</html>






