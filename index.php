<?php
session_start();  // starting the session in the page


// getting the list for the flowers information
require 'includes\lists.php'; 
require 'includes\functions.php'; // including the functions page
?>
<html>

    <!-- linking the css style sheet  -->
<link rel = "stylesheet" type = "text/css" href = "style.css" />



<h1> Florist Shop </h1>
    
<hr>
    
<body>

<?php
    

	//creating the DIV for each flower content
    $final ="<div class=\"infoDiv\">";
	// posting the imagens and the information getting from the list.php page
    for ($idx = 1; $idx <= count($description);$idx++)
    {
        
    
    $div = 
    // creating the form with the input in get method
    "<div class=\"pForm\">
    <form action=\"delivery.php\" method=\"get\">
            <p><img  class=\"img\"  src=\"images/".$idx.".jpg\"/></p> 
            <input type=\"hidden\" name=\"img\" value=\"images/".$idx.".jpg\" />
            <p class=\"pName\">Name: <input name=\"name\" type=\"hidden\" value=\"".$description[$idx]."\" />".$description[$idx]."</p>

             <p class=\"pName\">Price: £<input name=\"price\" value=\"".$price[$idx]."\" type=\"hidden\" />".$price[$idx]." </p> 
             
            <button type=\"submit\"> Add to Card</button>   
            
            <input type=\"hidden\" name=\"error\" value=\"0\" />
            </form>
            </div>";
            
        $final.=$div;
            
    }
    $final.="</div>";
    echo $final; // echo out the final div
    
    ?>

    
</body>
</html>
