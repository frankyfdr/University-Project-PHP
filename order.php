<?php
session_start(); //starting session in the page
$details = $_SESSION["details"]; // adding to array all the delivery information


// adding the payment in the payment array
$payment = array("total"=>$_POST["total"],
"Address" => $_POST["address"],
"CardName" => $_POST["fullname"], 
"Card" => $_POST["cardnumber"],
"exDate" => $_POST["exDate"],
"CVC" => $_POST["cvc"],
"PaymentPhone" => $_POST["phoneNumber"],
"PaymentEmail" => $_POST["email"]);

//checking if any erro was detected if no saving in the details in session
if($details["ERROR"] == NULL)
$_SESSION["details"] = $details;

$PaymentError = 0;

// validating all the type of error required

//NOTE: if any erro occur in after payment age, comment this bis
// FROM HERE
//  **
if($payment["CardName"] == ""||
 $payment["Address"] == "" ||
 $payment["PaymentPhone"] == "" ||
 $payment["PaymentEmail"] == "" ||
 $payment["CVC"] == "" ||
 $payment["exDate"] == "" ||
 $payment["Card"] == "" 
 )
 $PaymentError = 2; //fields empty


 if(!filter_var($payment["PaymentEmail"],FILTER_VALIDATE_EMAIL))
        $PaymentError = 1; //email invalid
else
 if(mb_strlen($payment["CVC"]) != 3)
 {
         $PaymentError = 3; //cvc invalid
 }
else
 if(mb_strlen( $payment["Card"]) != 16)
 {
         $PaymentError = 4; //card number invalid
 }
else
 if( mb_strlen($payment["PaymentPhone"]) != 9)
 {
         $PaymentError = 5; //phone invalid
 }
 //** UNTIL HERE
 else
 if (date("Y-m") > $payment["exDate"])
 $PaymentError = 6;

//validating if any error was found
 if($PaymentError != NULL)
 {
     
      //passing variables to previuous page due an error found
     
   header("Location: payment.php?PaymentError=".$PaymentError."");
     
 }

?>
<html>  
    
<header>
<link rel="stylesheet" type="text/css" href="styleOrder.css" />
</header>
<body>

        <div>
        <table>
        <?php
			// html code for delivery information in the order page
        $table = "";
        $table .= "<tr><td>
        <p> <text class=\"title\">Delivery Info</text><br></p>
                   <p> Name: <text>".$details["Name"]." </text> <br></p>
                   <p>  Address:<text> ".$details["Address"]." </text> <br></p>
                   <p> City: <text>".$details["City"]."</text>  <br></p>
                   <p> PostCode: <text>".$details["PostCode"]." </text> <br></p>
                   <p>  Delivery Date:<text> ".$details["Date"]." </text> <br></p>
                   <p>  Delivery Time: <text>".$details["Time"]."</text>  <br></p>
                   
                   <p> Message:<text class=\"msg\"> ".$details["msg"]."</text></p></td>";
	// html code for payment information in the order page
        $table .= "<td>
        <p> <text class=\"title\">Payment Info</text><br></p>
        <p> CardName: <text>".$payment["Card"]." </text> <br></p>
        <p> Card Number:<text> ".$payment["Card"]." </text> <br></p>
        <p> Exp Date: <text>".$payment["exDate"]."</text>  <br></p>
        <p> CVC: <text>".$payment["CVC"]." </text> <br></p>
        <p> Phone :<text> ".$payment["PaymentPhone"]." </text> <br></p>
                   
        <p> Email: <text>".$payment["PaymentEmail"]." </text> <br>
                   <p>  </text></td></tr>";
// html code for Order  information in the order page   and the sign space for the staff
        $table .=  "<tr><td>
                <p> <text class=\"title\">Order Info</text><br>
                <p> Product Name: <text>".$details["FName"]." </text> <br></p>
                <p>  Price: <text>".$details["Price"]." </text> <br></p>
                <p> Quantity: <text>".$details["Quantity"]." </text> <br></p>
                <p> Total :<text> ".$payment["total"]." (delivery fee Included) </text> <br></p>
                </text></td>
          
                <td>
                <p><text class=\"steps\"> Order is Processed </text><br><br></p>
                <p> Staff Sign:  _____________________________ <br> Date: ___/_____/____</p>
                <br>
                <br>
                <br>
                <br>
                <br>

                <p>  <text class=\"steps\"> Delivered Order </text><br><br> </p>
                <p>  Staff Sign:  _____________________________ <br> Date: ___/_____/____
                        </td>
                ";

                
                        
        
        
        
            


        
        echo $table; // echo outing the html code for the page
        
        ?> 

        </table>
       </div>
    
</body>
</html>





