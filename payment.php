<?php
session_start();

$PaymentError = 0;
$DeliveryError = 0;
include 'includes\functions.php'; // including the functions page

// checking if there GET for payment error is set
if(isset($_GET['PaymentError']))
    $PaymentError = $_GET["PaymentError"];
?>
<html>  
    
<header>
<script>
alert("If a non-validation field error occur after this page \nCheck the commented code in the order.php page!");
</script>
<link rel="stylesheet" type="text/css" href="stylePayment.css" />
</header>
<body>
<h1>Florist Shop</h1>
    
    
    
    <?php
	//saving all delivery information in array if there is no error
    if($PaymentError == 0)
    {
    $details = array(
        "Name" => $_POST["fullname"], 
        "Address" => $_POST["address"],
     "City" => $_POST["city"],
      "Date" => $_POST["Ddate"],
      "PostCode" => $_POST["postcode"],
      "Time" => $_POST["Dtime"], 
      "Quantity" => $_POST["qnt"], 
      "msg" => $_POST["msg"],
       "Price" => $_POST["price"],
        "FName" => $_POST["name"], 
       "IMG" => $_POST["img"],
       "ERROR" => NULL);
    
    }
    else
    {
        $details = $_SESSION["details"];
    }       
        


  
   // if there is 0 means that no error was detected or no validations was made
    if($PaymentError == 0){
        //check date
        if(!check_future_date($details["Date"]) && $details["Date"] != "")
        {
        $DeliveryError = 1; // 1 = date error;
        
        }

        if($details["Name"] == "" || $details["Address"] == "" || $details["City"] == "" || $details["PostCode"] == "")
        $DeliveryError = 2; // Empty requied fields

        if($details["Quantity"]< 1)
        $DeliveryError = 3;

        if($DeliveryError == NULL)
        $_SESSION["details"] = $details;
        
        if($DeliveryError != NULL and $PaymentError == 0)
        {
            
            //pass variables through the url for previous page due an error found
            
            header("Location: delivery.php?img=".$details["IMG"]."&price=".$details["Price"]."&name=".$details["FName"]."&error=".$DeliveryError."");
            
        }
}


    
    ?>
   
<hr>
    <!-- -->
    <div class="order">
        <svc class="step1">Delivery Details</svc>
        <text style="color:aqua" class="stepText">--------------------------</text>
        <svc class="step2">Payment</svc>
        <text class="stepText">--------------------------</text>
        <svc class="step3">Confirmation</svc>
      
    </div>
	<!-- if any erro on payment error page is going to be showed in this div -->
    <div class="error">
        <?php
		// checking what type of error was detected if payment is different of 0
        if($PaymentError != 0)
             switch($PaymentError)
            {
            case '1': echo "<p> ERROR: Email Invalid!"; break;
            case '2': echo "<p> ERROR: All fields are required! "; break;
            case '3': echo "<p> ERROR: CVC Invalid!"; break;
            case '4': echo "<p> ERROR: Card number Invalid!"; break;
            case '5': echo "<p> ERROR: Phone number invalid! "; break;
            case '6': echo "<p> ERROR: Expiration date invalid! "; break;
            default: break;
            }     
            ?>  
</div>

<div class="main">
    <!-- div for form input of the payment information  -->
    <div class="FormDiv">
    <form action="order.php" method="post">
        <p class="pForm"> Card Name:<br> <input name="fullname" type="text"></p>
        <p class="pForm">Credit Card Address: <br> <input name="address" type="txt">
        </p>
        <p class="pForm"v>Card Number:<br> <input name="cardnumber" type="number"> </p>
        <p class="pForm">Expiry Date<br><input name="exDate" type="month"></p>
        <p class="pForm">Security Code: <br> <input name="cvc" type="number">
        </p>
        <p class="pForm">Contact Phone number: <br> <input name="phoneNumber" type="tel">
        </p>
        <p class="pForm">Email address: <br> <input name="email" type="text">
        </p>
        
        
        <button type="submit" >Confirm</button>

    </div>
     
    <div class="infoDiv">
    
    <!-- information of the product selected in index.php page -->
    <img src=<?php echo $details["IMG"]; ?> /> 
        <p><Text>Flower Name: </Text><Text><?php echo $details["FName"]; ?></Text></p>
        
        <p><Text>Price: </Text><Text><?php echo "£".$details["Price"]." + £10 Delivery fee"?></Text></p>
        
        <p><Text>Quantity: </Text><Text><?php echo $details["Quantity"]; ?></Text></p>
        
        <p><Text>Total Value: </Text><Text><?php 
        $total = "";
        $total = (($details["Price"]*$details["Quantity"])+10);
        echo "£".$total; ?>
        
        </Text></p>
        <input name="total" type="hidden" value="<?php echo $total ?>">
        
        </form>
        </div>
</div>
    
</body>
</html>





