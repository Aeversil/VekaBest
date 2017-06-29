<div id="admin_users" style="display: none">
  <button onclick='Add()' id='add'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'> </i></button>
  <table>
  	<thead>
  		<tr>
  			<th>ID </th>
  			<th>Gebruikersnaam </th>
  			<th>Type </th>
  			<th>Bewerken</th>
  			<th></th>
  		</tr>
  	</thead>
  	<tbody>
    <?php
    $con= mysqli_connect($host, $username, $password, $db_name);

      $query = "SELECT * FROM users ORDER BY id";
  		if ($result=mysqli_query($con,$query))
  		{
  			  // Fetch one and one row
  		  while ($row=mysqli_fetch_row($result))
  		    {
  		    	$row['id'] = $row['0'];
  		    	printf("<tr>");
  		    	printf("<td>". $row['0'] ."</td>");
  		    	printf("<td>". $row['1'] ."</td>");
  		    	printf("<td>". $row['3'] ."</td>");
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
<script>

</script>
