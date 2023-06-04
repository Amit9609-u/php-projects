


<html>

  <head><title>Read Database</title></head>

<style>
input{
  font-size: 4em;
}
.btn-elmnt{
 
}
td,th{
    padding: 20px;
    font-size: 2.3em;

    border: 2px solid black;
  }
    table {
        border-collapse: collapse;
    }
    
input  {
font-size: 2.8em;
width: 350px;
height:100px;
background: #f64767;
color: #ffffff;
border-radius: 2em;
font-weight: 999;
  
}
#box1{
  margin-top: 3em;
  display:flex;
  justify-content: space-around;
  align-items: center;
  width: 1150px;
  box-sizing: border-box;
}
</style>

<body>
  
<?php
include "dbsetup.php";
$is_data_available = $conn->query("SELECT * FROM Student");

if($is_data_available->num_rows>0){


echo "<br>";
?>

<table id ="tab" style="border:2px solid black;">

  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>City</th>
    <th>Course</th>
    <th>Mobile No.</th>
   <th>Pictures</th>

  </tr>
<?php
while($row = $is_data_available->fetch_assoc()){
$fn = $row["studentImage"];
  $html = "<tr class= 'gol'>"."<td>".$row["Id"]."</td>"
  ."<td>".$row["Name"]."</td>" ."<td>".$row["City"]."</td>".
"<td>".$row["Course"]."</td>".
"<td>".$row["Mobile"]."</td>".
"<td><img width='200px' height='200px' src="."form_pics/".$row['studentImage']."/></td>".
  "</tr>";
  echo $html;


}?>

</table>

<?php

}else{
echo "Nothing to Show!";
}
$conn->close();
?>

<div id="box1">
  <form class="btn-elmnt" action="index.php">

  <input class="inpt" type="submit" value="Add Data">

  </form>

 <form action="update.php">
      <input  value="Update" type="submit" >
  </form>

 <form class="btn-elmnt" action="delete.php">
    <input type="submit" value="Delete Data">
  </form>
  </div>
  
  </body>
  </html>