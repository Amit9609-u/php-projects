
<html>
  <head>
    <title>
      Update Database
    </title>
  </head>
  <style>
    input{
      font-size: 3em;
      border: 2px solid black;
    }
#box1 input,#sbupdt  {
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
#name,#city,#course,#mobile{
  font-size: 3em;
  margin-top: 1em;
  padding: .5em;
}
#updbox{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  width: 1150px;
  box-sizing: border-box;
}
img{
  margin-top: .5em;
  border: 2px solid black;
}
  </style>
  <body>
   
    <form action="" method="post">
      
 <div id="box">
      <input name="id" placeholder="Enter Id to update">
      <input name="sb" value="Search Id for Update" type="submit" >
      </div>
      </form>
      
    <div id="box1">


 <form action="index.php">
      <input  value="Add Data" type="submit" >
      </form>

 <form action="read.php">
      <input  value="Display Data" type="submit" >
      </form>
 <form action="delete.php">
      <input  value="Delete Data" type="submit" >
      </form>

</div>

      <br>




<?php
include "dbsetup.php";



if(isset($_POST["sb"])){
$id = $_POST["id"];

$is_data_available = $conn->query("SELECT * FROM Student WHERE Id = '$id'");
//print_r($is_data_available);
if($is_data_available->num_rows>0){
  while($row = $is_data_available->fetch_assoc()){
    $data = $row;
  }
  $name = strval($data["Name"]);
  $studentImage = $data["studentImage"];

 ?>
 <form method="POST" action="" enctype="multipart/form-data">
   <div id="updbox">
      <input  name="id" hidden value="<?php echo $id?>">
 <input id="name" name="name" value="<?php echo  $data['Name']?>">
 <input id="city" name="city" value="<?php echo  $data['City']?>">
 <input id="course" name="course" value="<?php echo  $data['Course']?>">
 <input id="mobile" name="mobile_no" value="<?php echo  $data['Mobile']?>">
 <br>
 <img id="chimg" src="<?php echo 'form_pics/'.$data['studentImage'] ?>" width="300px" height="300px">
 <br>

<input hidden name="pic" id="btn1" onchange="previewImg(event)" type="file" >

<br>
 <input id="sbupdt" name="update" value="Submit" type="submit">
 </div>
      </form>
<script>
  document.querySelector("#chimg").onclick=function (){
    document.querySelector("#btn1").click();
  }
  function previewImg(event){
    if(event.target.files && event.target.files[0]){
     flr =  new FileReader ();
     flr.onload=(e)=>{
       document.querySelector("#chimg").src=e.target.result;
     }
flr.readAsDataURL(event.target.files[0])
    }
  }
  
</script>

 <?php


}
else{
   echo "<br>"."<h1>Id does not Exist!</h1>";
}
}


if(isset($_POST["update"]) && $_FILES["pic"] ){

    $id = $_POST["id"];
    $name = $_POST["name"];
    $city = $_POST["city"];
    $course = $_POST["course"];
    $mobile_no = $_POST["mobile_no"];
if(isset($_FILES["pic"]) && $_FILES["pic"]["error"]===UPLOAD_ERR_OK){

$file = $_FILES["pic"];

$pic = $file["name"];

$studentImage = $file["name"];
move_uploaded_file($file["tmp_name"],"form_pics/$pic");
}else{

$is_data_available = $conn->query("SELECT * FROM Student WHERE Id = '$id'");
//print_r($is_data_available);
if($is_data_available->num_rows>0){
  while($row = $is_data_available->fetch_assoc()){
    $data = $row;
  }
 $studentImage =$data['studentImage'];
}}

$update_query = "UPDATE Student SET Name = '$name' ,City = '$city', Course='$course', Mobile='$mobile_no', studentImage= '$studentImage' WHERE Id = '$id'";
$conn->query($update_query);
echo "<br>"."<h1>Id No.".$_POST["id"]. " Updated Successfully! </h1>";

}
?>
</body>
</html>
