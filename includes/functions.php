

<?php

/*
Name: email_couk
Description: Checks that a given email address is valid and ends with .co.uk
Parameter: String – The email address to check to check.
Return: Boolean – true if email address is valid and ends with .co.uk, otherwise false.
*/

$emailstring = "franklin@anglia.co.uk";

function email_couk($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		return false;
	if(strpos($email,'.co.uk') == true) //checking if the string has '.co.uk'
		return true; //returning true
	else  //if not contains '.co.uk is going to return false
		return false;
}


/*
Name: hypotenuse
Description: Calculate the length of the hypotenuse of a right angled triangle.
Parameter1: float –  The length of the first side of the triangle
Parameter2: float – The length of the second side of the triangle
Return: float – The length of the hypotenuse
(NOTE: If you do not know how to calculate the hypotenuse of a right angled triangle look up Pythagoras’ theorem.)
*/

function hypotenuse($sideA, $sideB){
	/*
		sqrt function is returning the square root
		Pow Returns x raised to the power of y
		its combining the two math functions to calculate de hypotenuse and 
		returning the value of it.
	*/
		return sqrt(pow($sideA,2) + pow($sideB,2)); 
}



/*
Name: anti_shout
Description: Removes all capitalisation from a sentence except for the first letter.
Parameter: String –  The sentence to be corrected.
Return: String – The corrected sentence.
*/


function anti_shout($string){
	
	$string = strtolower($string); // editing every word as lowcase
	$string = ucfirst($string); //editing the FIRST letter as UPPERcase
	
	return "$string"; //returning the correct format string
	
	
}

/*
Name: array_subset
Description: Checks if all elements of an array (child) are contained within another array (parent).
Parameter1: Array –  The child array
Parameter2: Array – The parent array
Return: Boolean – Returns true if all values in the child array occur at least once in the parent array otherwise false.
(HINT: There is no requirement to check that a child value exists only once in the parent array.)
*/


function array_subset($arrayChild, $arrayParent){
	$conatain = false;
	foreach($arrayChild as $value){ // going through every value on the child array
		if(!in_array($value,$arrayParent)) //checking if there is NOT the value in the array parent
		{
			return false; //returning false if not find de value in the array parent
		}	
	}
	return true; //retuning true if DO find every value on the parrent array
}


/*
Function 5
Name: check_future_date
Description: Checks a date in yyyy-mm-dd format is in the future.
Parameter: String –  The date to be checked in yyyy-mm-dd format
Return: Boolean – True if the date is later than (but not equal to) the current date, otherwise false.

*/

function check_future_date($date){	
	if(date("Y-m-d") < $date)  //comparing if the date is older or lates than today date
		return true;	//returning true if the $date is in the furture
	else
		return false; // returning false if the $date is in the past
}

 





/*
Function 6
Name: card_date_valid
Description: Checks if a credit card is valid based on the start and end date of the card in mm/yy format.
Parameter1: String –  The start date of the card in mm/yy format
Parameter2: String – The end date of the card in mm/yy format
Return: Boolean – True if the credit card is in date, otherwise false.
*/

function card_date_valid($startD, $endD){
	
	//validating if the start date is older then the currect date and end date is latest then current date
	if($startD >= date("m/y") and $endD > date("m/y"))
	{
		return true;
	}
	else
	{
		
		return false;
	}
}





/*
Function 7

Name: list_files
Description: Returns an array of all files in a given path with a specified file extention. 
If no file extention is supplied the function should return an array of all files in the given location.
Parameter1: String – The path to the location to be checked for files.
Parameter2: String – The file extention
Return: Indexed Array – An array containing the names of all the files of the specified type in the specified path.

*/
 
function list_files($path, $ext = NULL){

    
	$rFiles[] = NULL; //final returning array
    $files = scandir($path,1); //getting all files and folder from the location
	
	foreach($files as $value)
	{
		if($ext == NULL and strpos($value,".")) //validating if there is any extension to check and if is a file and not folder
		$rFiles[] =$value; // saving non checking ext, int to array
		else
			if(strpos($value, $ext)) // validating files with extension given
			
			$rFiles[] = $value; // saving files into array.
			//filesize($path."\\".$value)."</p>";
			
    }
	return $rFiles; // returning files
}

/*
Function 8

Name: get_file_sizes
Description: Returns an associative array of files and their sizes (in bytes) given a path to the files.
Parameter1: String –  The path to the location to check.
Return: Associative Array – An array of file names (without file extensions) as keys and the file size in bytes as the value for each member.
*/


function get_file_sizes($path){
	 $files = scandir($path); //geting the information in the path
	 $fSize[] = NULL;
	 foreach($files as $value){
		 if(strpos($value, ".")){
			 $str = explode(".",$value); //getting just the file name without extension
			$fSize[$str[0]] = filesize($path."\\".$value); // saving the file size with key as name of the file
		}
	 }
	 return $fSize;
	 
}
/*
Function 9

Name: hex_to_rgb_array
Description: Converts a hexadecimal colour code in #rrggbb format to an associative array 
with indexes of red, green and blue and corresponding values from 0 to 255
Parameter: String – The hexadecimal colour code with leading hash (#)
Return: Associative array – Array containing integer values derived from input parameter 
in an associative array with indexes of red, green and blue.
*/
	function hex_to_rgb_array($rgb){
		
		$red = hexdec(substr($rgb, 1,-4)); //getting the carcartes corresponding to RED and converting hex to dec
		$green = hexdec(substr($rgb, 3,-2)); //getting the carcartes corresponding to GREEN and converting hex to dec
		$blue = hexdec(substr($rgb, 5)); //getting the carcartes corresponding to BLUE and converting hex to dec
		
		//saving the value already converted to Decimal into associative array
		$colour["red"]=$red;
		$colour["green"]=$green;
		$colour["blue"]=$blue;
		
	
		
		return $colour; // returning the array
		
		
	}
	
	
	/*Function 10

Name: times_table
Description: Returns a string containing a multiplication table from 1 to the given number.
The result should be returned in an HTML table with classes assigned to odd and even columns
odd and even rows and a class for the table element.
Parameter: Integer – The upper limit of the table (integer)
Return: String – A string containing an HTML table of multiplication values.
*/
	
	function times_table($limit){
		$table = "<table border=1>\n"; // starting the table tag
		
		
		for($i = 1;$i <= $limit ;$i++) // loop for row
		{
			//validating if is a odd or even number and saving into string
			if ($i % 2 == 0) {   
				$class = "evenrow";   
			} else {
				$class = "oddrow";
			}
			//adding the class into the tr tag
			$table .= "<tr class=\"$class\">";
			for($i2= 1; $i2 <= $limit; $i2++) //loop for columns
			{
				$result =  $i*$i2; //doing the maths
				if($result % 2 == 0) //checking if is a odd or even number
					//adding the even class into colum tag
					$table .= "<td class=\"evencol\">";
			else
				$table .= "<td class=\"oddcol\">"; //adding the odd class into the colum
			// adding the math in the table and closing the colum tag
			$table .=  $i*$i2."</td>\n"; 
			}
			$table .= "</tr>\n"; // closing the row tag
			
		}
			
			
		
		$table .=  "</table>"; // closing the table tag
		return $table; // returning the final table string
	}
	
	
?>



