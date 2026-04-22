<?php
include 'db.php';

if(isset($_POST['add'])){

  $guest = $_POST['guest_id'];
  $room = $_POST['room_id'];
  $date = $_POST['date'];
  $stmt = $conn->prepare("INSERT INTO Reservation_Tbl (guest_id, room_id, date) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $guest, $room, $date);
  $stmt->execute();

  echo "<p style='color:green;'>Reservation added successfully!</p>";

}

?>
<form method="POST">
  Guest:
  <select name="guest_id" required>
    <option value="">Select Guest</option>
    <?php
    $guests = $conn->query("SELECT * FROM Guests_Tbl");
    while($g = $guests->fetch_assoc()){
      echo "<option value='{$g['guest_id']}'>
          {$g['firstname']} {$g['lastname']}
         </option>";
    }
    ?>

  </select>

  Room:
  <select name="room_id" required>
    <option value="">Select Room</option>
    <?php
    $rooms = $conn->query("SELECT * FROM Rooms_Tbl");
    while($r = $rooms->fetch_assoc()){
      echo "<option value='{$r['room_id']}'>
          {$r['room_type']} - {$r['price']}
         </option>";
    }

    ?>
  </select>

  Date:
  <input type="date" name="date" required>
  <button type="submit" name="add">Add</button>
</form>

<hr>
<table border="1" cellpadding="10">
<tr>
  <th>ID</th>
  <th>Guest Name</th>
  <th>Room Type</th>
  <th>Date</th>
  <th>Price</th>

</tr>
<?php

$sql = "SELECT 
      r.reservation_id,
      CONCAT(g.firstname, ' ', g.lastname) AS guest_name,
      rm.room_type,
      rm.price,
      r.date
    FROM Reservation_Tbl r
    INNER JOIN Guests_Tbl g ON r.guest_id = g.guest_id
    INNER JOIN Rooms_Tbl rm ON r.room_id = rm.room_id
    ORDER BY r.reservation_id DESC";

$result = $conn->query($sql);

if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    echo "<tr>
      <td>{$row['reservation_id']}</td>
      <td>{$row['guest_name']}</td>
      <td>{$row['room_type']}</td>
      <td>{$row['date']}</td>
      <td>{$row['price']}</td>
    </tr>";

  }
}else{
  echo "<tr><td colspan='5'>No reservations found</td></tr>";
}
?>
</table>