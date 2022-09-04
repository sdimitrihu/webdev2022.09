<?php

require_once("connect.php"); 

$result = $conn->query("SELECT * FROM vivlia");

echo "<h2>Δανειστική Βιβλιοθήκη</h2>
<h4><a href='create.php'>Προσθήκη νέου βιβλίου</a></h4>";
	
if ($result->num_rows > 0) {
	echo"
	<table border='1'>
		<tr>
			<th>Id</th>
			<th>Τίτλος</th>
			<th>Σελίδες</th>
			<th>Διαθεσιμότητα</th>
			<th>Διαγραφή</th>
			<th>Αλλαγή διαθεσιμότητας</th>
		</tr>";
		
	while($row = $result->fetch_assoc()) {
		if ($row["isAvailable"] == "yes") {
			$changeStatus = "<a href='make-unavailable.php?id=".$row["id"]."'>Αλλαγή σε μη διαθέσιμο</a>";
		} else {
			$changeStatus = "<a href='make-available.php?id=".$row["id"]."'>Αλλαγή σε διαθέσιμο</a>";
		}
		echo "<tr>
			<td>".$row["id"]."</td>
			<td>".$row["title"]."</td>
			<td>".$row["pages"]."</td>
			<td>".$row["isAvailable"]."</td>
			<td><a href='delete.php?id=".$row["id"]."'>Διαγραφή</a></td>
			<td>".$changeStatus."</td>
		</tr>";
	}
} else {
	echo "Δεν υπάρχουν βιβλία";
}

require_once("disconnect.php");

?>