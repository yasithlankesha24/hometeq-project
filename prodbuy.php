<?php
    include("db.php"); //include db.php file to connect to DB
    $pagename = "A smart buy for a smart home"; //Create and populate a variable called $pagename
    echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
    echo "<title>" . $pagename . "</title>"; //display name of the page as window title
    echo "<body>";
    include("headfile.html"); //include header layout file
    echo "<h4>" . $pagename . "</h4>"; //display name of the page on the web page

    //retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
    //applied to the query string u_prod_id
    //store the value in a local variable called $prodid

    $prodid = $_GET['u_prod_id'];
    $SQL = "select prodId, prodName, prodPicNameLarge, prodDescripLong, prodQuantity, prodPrice from Product WHERE prodId = $prodid";
    //run SQL query for connected DB or exit and display error message
    $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
    echo "<table style='border: 0px'>";
    $selected = mysqli_fetch_array($exeSQL);

    //create an array of records (2 dimensional variable) called $arrayp.
    //populate it with the records retrieved by the SQL query previously executed.
    //Iterate through the array i.e while the end of the array has not been reached, run through it
    echo "<tr>";
    echo "<td style='border: 0px'>";
    echo "<img src=images/" . $selected['prodPicNameLarge'] . " height=400 width=350>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    
    echo "<p><h5>" . $selected['prodName'] . "</h5>"; //display product name as contained in the array
    echo "<p>" . $selected['prodDescripLong'] . "<br><br>";
    echo "<p><b>$" . $selected['prodPrice'] . "</b><br><br>";
    echo "<p> Left in Stock : " . $selected['prodQuantity'] . "<br><br>";

    echo "<p>Number to be purchased: ";
    //create form made of one text field and one button for user to enter quantity
    //the value entered in the form will be posted to the basket.php to be processed
    echo "<form action=basket.php method=post>";
    echo "<select name=>";
    for ($count = 0; $count <= $selected['prodQuantity']; $count++) {
        echo "<option value=> $count </option>";
    }
    "</select>";

    echo "<input type=submit name='submitbtn' value='ADD TO BASKET' id='submitbtn'>";
    //pass the product id to the next page basket.php as a hidden value
    echo "<input type=hidden name=h_prodid value=".$prodid.">";
    echo "</form>";
    echo "</p>";

    echo "</td>";
    echo "</tr>";
    echo "</table>";
    
    include("footfile.html"); //include head layout
    echo "</body>";
?>