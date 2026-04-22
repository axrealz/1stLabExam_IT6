<?php
include 'db.php';

if(isset($_POST['add'])){
  $type = $_POST['room_type'];
  $price = $_POST['price'];
  $stmt = $conn->prepare("INSERT INTO Rooms_Tbl (room_type, price) VALUES (?, ?)");
  $stmt->bind_param("sd", $type, $price);
  $stmt->execute();
}
?>

<form method="POST">
  Room Type:
  <input type="text" name="room_type" required>
  Price:
  <input type="number" name="price" step="0.01" required>
  <button type="submit" name="add">Add</button>
</form>

<br>

<table border="1">

<tr>
  <th>Room ID</th>
  <th>Room Type</th>
  <th>Price</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM Rooms_Tbl");

if($result->num_rows > 0){

  while($row = $result->fetch_assoc()){

    echo "<tr>
        <td>{$row['room_id']}</td>
        <td>{$row['room_type']}</td>
        <td>{$row['price']}</td>
       </tr>";

  }

}else{
  echo "<tr><td colspan='3'>No rooms found</td></tr>";
}

?>

</table>

<br>
<a href="index.php">Back</a>