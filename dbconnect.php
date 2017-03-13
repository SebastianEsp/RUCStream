<?php
$s = strval($_GET['s']);
$c = strval($_GET['c']);
$t = strval($_GET['t']);
$servername = "127.0.0.1";
$username = "root";
$password = "ene23dfr";
$db = "stream";

if($s == "Subject ")
{
	$s = '';
}
if($c == "Course ")
{
	$c = '';
}
if($t == "Teacher")
{
	$t = '';
}

$conn = new mysqli($servername, $username, $password, $db);

if($conn->connect_error)
{
	die("Connection to Database Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `vods` WHERE `subject` LIKE '%".$s."' AND `course` LIKE '%".$c."' AND `name` Like '%".$t."'";
$result = $conn->query($sql);

echo "<table class=\"table\">
<thead>
<tr>
<th>Subject</th>
<th>Course</th>
<th>Title</th>
<th>Teacher</th>
<th>Date</th>
</tr>
</thead>
<tbody>";
if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$uri = $row['uri'];
		echo "<tr>";
		echo "<td id=\"play\" onClick=\"changeVideoSource('".$uri."')\">" . $row['subject'] . "</td>";
		echo "<td>" . $row['course'] . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['datestamp'] . "</td>";
		echo "</tr>";
	}
}else {
	echo "No result was found, please try a different combination";
}
echo "</tbody>";
echo "</table>";
mysqli_close($conn);
?>
