<?php
include 'db.php';

if(isset($_POST['add'])){
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $conn->query("INSERT INTO Guests_Tbl (firstname, lastname)

         VALUES ('$fname', '$lname')");
}

?>

<table border="1">

<tr>
  <th>ID</th>
  <th>First Name</th>
  <th>Last Name</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM Guests_Tbl");

while($row = $result->fetch_assoc()){
  echo "<tr>
      <td>{$row['guest_id']}</td>
      <td>{$row['firstname']}</td>
      <td>{$row['lastname']}</td>
     </tr>";

}
?>
</table>