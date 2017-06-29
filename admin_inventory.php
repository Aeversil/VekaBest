<div id="admin_inventory" style="display: none">

<style>
table {
border-collapse: collapse;
width: 100%;
}

th, td {
text-align: left;
padding: 8px;
}

tr:nth-child(even){
background-color: #f2f2f2
}

th {
background-color: #00adff;
color: white;
}
</style>

<?php
$con= mysqli_connect("localhost","root","root","vekabestwebsite");
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
// $sql("INSERT INTO boeken VALUES('1','3','j.jpg','t','auto','500')");
// if(mysqli_query($con, $sql)){
//     echo "Records added successfully.";
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
// }
?>

<h1>Admin inventory edit page</h1>
<button onclick='Add()' id='add'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'> </i></button>
<table>
	<thead>
		<tr>
			<th>ID </th>
			<th>Boeknaam </th>
			<th>Catergorie </th>
			<th>Afbeelding </th>
			<th>Prijs </th>
			<th>Sku </th>
			<th>Bewerken </th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<div id="myModal" class="modal">

  <!-- Modal content -->
	  <div class="modal-content">
	    <span class="close">&times;</span>
	    <!-- <link rel="stylesheet" type="text/css" href=""> -->
	    <div id="forminvoer">
		    <form method="post">
			    ID :
			    </br>
			    <input id="input" name="id" value="" type="text">
			    </br>
			    BoekNaam :
			    </br>
			    <input id="input" name="boeknaam" value="" type="text">
			    </br>
			    Categorie :
			    </br>
			    <select>
					<option value="categorie">Auto</option>
					<option value="categorie">Brommer</option>
					<option value="categorie">Bus</option>
					<option value="categorie">Motor</option>
					<option value="categorie">Spiegels</option>
					<option value="categorie">Vrachtwagen</option>
				</select>
			    </br>
			    Afbeelding :
			    </br>
			    <input id="input" name="afbeelding" value="" type="text">
			    </br>
			    Prijs :
			    </br>
			    <input id="input" name="prijs" value="" type="text">
			    </br>
			    Sku :
			    </br>
			    <input id="input" name="sku" value="" type="text">
			    </br>
			    </br>
			    <button id="change2">Toevoegen</button>
		    </form>
	    </div>
	  </div>
	</div>
		<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the button that opens the modal
		var btn = document.getElementById("add");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		btn.onclick = function() {
		    modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		    modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
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
		    	printf("<td>". $row['0'] ."</td>");
		    	printf("<td>". $row['3'] ."</td>");
		    	printf("<td>". $row['4'] ."</td>");
		    	printf("<td>". $row['2'] ."</td>");
		    	printf("<td>". $row['1'] ."</td>");
		    	printf("<td>". $row['5'] ."</td>");
		    	printf("<td><button onclick='Change()' id='change'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'> </i></button></td>");
		    	printf("<td><button onclick='Delete()' id='change'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></button></td>");
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
