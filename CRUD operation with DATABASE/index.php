

<html>
<head><title>Database</title>
<meta name="viewport" content="width=device-width">

</head>
<style>
*{
  padding: 0;
  margin: 0;
}
input {
  border: 2px solid black;
}
#box1{
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: column;
  width: 1150px;
  height:100vh;
  margin-top: 1em;
 box-sizing: border-box;
}
#sbmt{
font-size: 3em;
width: 350px;
height:100px;
background: #f64767;
color: #ffffff;
border-radius: 2em;
font-weight: 999;
  
}
#box2{
  margin-top: 3em;
  display:flex;
  justify-content: space-around;
  align-items: center;
  width: 1150;
}
 div input{
    font-size: 2em;
    padding: .5em;
  }
  #dl,#upd,#rd{
font-size: 3em;
width: 350px;
height:100px;
background: #f64767;
color: #ffffff;
border-radius: 2em;
font-weight: 999;

   
  }
  td,th{
    padding: 1em;
    font-size: 1.83em;
border: 2px solid black;
  }
  table {
border-collapse: collapse;
  }
  #msg{
    margin-top: 1em;
    width: 1159px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: "red";
  }
</style>
<body >
<form id = "f1" action="" enctype="multipart/form-data" method="post" >
  <div id="box1">
  <input type="hidden" name="is_form_submitted" value = "true">
  
<input   placeholder="Name" name="name">

<input  name="city" placeholder="City">

<input name="course" placeholder="Course">

<input name="mobile_no" placeholder="Mobile No.">

<input name="pic" type="file">


<input id="sbmt" type="submit" name="sb" value="Add Data">
</div>

</form>
    <form action="delete.php">
      <div id="box2">

      <input id="dl" value="Delete" type="submit" >
      </form>
    <form  action="update.php">

      <input id="upd"  value="Update" type="submit" >


    </form>
<form action="read.php">
  <input id="rd" type="submit" value="Display Data">
</form>
</div>
</body>

</html>

<?php


include "dbsetup.php";

if($conn->error){
echo "Not connected";
}

function table_exist($conn, $table_name){

$res = $conn->query("SHOW TABLES LIKE '$table_name'");
return $res->num_rows>0;

}



//create

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["sb"]) && isset($_POST["name"])){


//header("Refresh:5; Location: /index.php");
echo "<h1>Added to DataBase</h1>";
$name = $_POST["name"];
$city = $_POST["city"];
$course = $_POST["course"];
$mobile_no = $_POST["mobile_no"];

if(isset($_FILES["pic"]) && $_FILES["pic"]["error"]===UPLOAD_ERR_OK){

$file = $_FILES["pic"];
print_r($file);
$pic = $file["name"];
$studentImage = $file["name"];
move_uploaded_file($file["tmp_name"],"form_pics/$pic");

}
  $row_create = "INSERT INTO Student(Name, City, Course, Mobile, studentImage) VALUES('$name','$city','$course','$mobile_no','$studentImage');";

$conn->query($row_create);

?>

<script>

j=document.querySelector("#f1");
j.reset();
j.submit();

</script>
<?php

}


if(!table_exist($conn, "Student")){

echo "Nothing to Show!";
$crTbquery ="create table Student(Id int  not null auto_increment primary key ,
Name text not null ,
City text not null,
Course text not null ,
Mobile text not null,studentImage varchar(100) not null ) auto_increment = 1000;";
$conn->query($crTbquery);

}



$is_data_available = $conn->query("SELECT * FROM Student");

if($is_data_available->num_rows>0){
echo "<br><div id='msg'><h1>Click on Display data to See Available data!</h1></div>";
/*
echo "<br>";
?>

<table id ="tab" style="border:2px solid black;margin-left:1em;">

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
*/

}else{
echo "Nothing to Show!";
}
$conn->close();




//read


/*
create();
read();
update();
delete();
*/


?>

