<div id="admin_inventory" style="display: none">

<style>
table {
border-collapse: collapse;
width: 100%;
}

.th-inv, .td-inv {
text-align: left;
padding: 8px;
}

.td-inv:nth-child(even){
background-color: #f2f2f2
}

.th-inv {
background-color: #00adff;
color: white;
}
</style>

<?php
$con= mysqli_connect($host, $username, $password, $db_name);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$query = "SELECT * FROM boeken ORDER BY boeksoort";

$id=$_POST['id'];
$boeknaam=$_POST['boeknaam'];
$categorie=$_POST['categorie'];
$afbeelding=$_POST['afbeelding'];
$prijs=$_POST['prijs'];
$sku=$_POST['sku'];
mysql_query("INSERT INTO boeken VALUES('$id', '$prijs', '$afbeelding', '$boeknaam', '$categorie', '$sku')");
?>

<button onclick='Add()' id='add'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'> </i></button>
<table>
	<thead>
		<tr>
			<th class="th-inv">ID </th>
			<th class="th-inv">Boeknaam </th>
			<th class="th-inv">Catergorie </th>
			<th class="th-inv">Afbeelding </th>
			<th class="th-inv">Prijs </th>
			<th class="th-inv">Sku </th>
			<th class="th-inv">Bewerken </th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<script>
		    function Add() {
				my_window = window.open("", "mywindow1", "status=1,width=350,height=350");
				// my_window.document.write('<link rel="stylesheet" type="text/css" href="">');
				my_window.document.write('<div id="forminvoer">');
				my_window.document.write('<form method="post">');
				my_window.document.write('ID :');
				my_window.document.write('</br>');
				my_window.document.write('<input id="input" name="id" value="" type="text">');
				my_window.document.write('</br>');
				my_window.document.write('BoekNaam :');
				my_window.document.write('</br>');
				my_window.document.write('<input id="input" name="boeknaam" value="" type="text">');
				my_window.document.write('</br>');
				my_window.document.write('Categorie :');
				my_window.document.write('</br>');
				my_window.document.write('<input id="input" name="categorie" value="" type="text">');
				my_window.document.write('</br>');
				my_window.document.write('Afbeelding :');
				my_window.document.write('</br>');
				my_window.document.write('<input id="input" name="afbeelding" value="" type="text">');
				my_window.document.write('</br>');
				my_window.document.write('Prijs :');
				my_window.document.write('</br>');
				my_window.document.write('<input id="input" name="prijs" value="" type="text">');
				my_window.document.write('</br>');
				my_window.document.write('Sku:');
				my_window.document.write('</br>');
				my_window.document.write('<input id="input" name="sku" value="" type="text">');
				my_window.document.write('</br>');
				my_window.document.write('</br>');
				my_window.document.write('<button id="change2">Toevoegen</button>');
				my_window.document.write('</form>');
				my_window.document.write('</div>');
			}
		    </script>
		<?php
		// if (is_int($_GET["id"]) {
		//     $query2 = "DELETE FROM boeken WHERE boekid =". $_GET["id"];
		//     $result2 = mysqli_query($con, $query2);
		// }
		if ($result=mysqli_query($con,$query))
		{
			  // Fetch one and one row
		  while ($row=mysqli_fetch_row($result))
		    {
		    	$row['id'] = $row['0'];
		    	printf("<tr>");
		    	printf("<td class='td-inv'>". $row['0'] ."</td>");
		    	printf("<td class='td-inv'>". $row['3'] ."</td>");
		    	printf("<td class='td-inv'>". $row['4'] ."</td>");
		    	printf("<td class='td-inv'>". $row['2'] ."</td>");
		    	printf("<td class='td-inv'>". $row['1'] ."</td>");
		    	printf("<td class='td-inv'>". $row['5'] ."</td>");
		    	printf("<td class='td-inv'><button onclick='Change()' id='change'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'> </i></button></td>");
		    	printf("<td class='td-inv'><button onclick='Delete()' id='change'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button></td>");
		    	printf("</tr>");
		    }
		  // Free result set
		  mysqli_free_result($result);
		}
		mysqli_close($con);
		?>
	</tbody>
</table>
</div>
