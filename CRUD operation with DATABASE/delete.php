


<html>

  <head><title>Delete Data</title></head>
  <style>
input{
  font-size: 4em;
}
#box1 input  {
font-size: 2.8em;
width: 350px;
height:100px;
background: #f64767;
color: #ffffff;
border-radius: 2em;
font-weight: 999;
  border: 2px solid red;
}
#box1{
 
  display:flex;
  justify-content: space-around;
  align-items: center;
  width: 1150px;
  box-sizing: border-box;
  margin-top:90px;
}
#box{
display:flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: column ;
  width: 1150px;
  height:280px;
  box-sizing: border-box;
  margin-top:50px;
}
#box :nth-child(1){
  font-size: 4em;
  padding: .3em;
}
#box :nth-child(2){
  margin-top: .5em;
font-size: 2.8em;
width: 50%;
padding: .2em;
height:100px;
background: #f64767;
color: #ffffff;
border-radius: 2em;
font-weight: 999;
  border: 2px solid red;
}
  </style>
  <body>
    <form action="">
      <div id="box">
      <input name="id" placeholder="Enter Id " >
      <input name="sb" value="Delete" type="submit" >
</div>
    </form>

<div id="box1">
 <form action="update.php">

      <input  value="Update" type="submit" >

      </form>
    <form action="index.php">
      <input type="submit" value="Add Data">
    </form>
    <form action="read.php">

      <input value="Display Data" type="submit" >

    </form>
    </div>
  </body>
</html>


<?php

include "dbsetup.php";
if(isset($_GET["sb"])){
$id = $_GET["id"];
//echo "hi";
$is_data_available = $conn->query("SELECT * FROM Student WHERE Id = '$id'");
//print_r($is_data_available);
if($is_data_available->num_rows>0){
$del_query = "DELETE FROM Student WHERE Id = ".$id;
$conn->query ($del_query);
echo "<br>"."<h1>Id No. {$id} Deleted Successfully! </h1>";

}
else{
   echo "<br>"."<h1>Id does not Exist!</h1>";
}
}
?>

