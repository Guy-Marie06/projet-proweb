<?php
	$lib=''; $id = '';
	$db= new PDO('mysql:host=127.0.0.1;dbname=parametres','root','');
	if(isset($_POST['btn']) && $_POST['btn'] == 'add'){
		$db->query('insert into para(lib) values("'.$_POST['lib'].'")');
	}
	elseif(isset($_POST['btn']) && $_POST['btn'] == 'update')
	{
		$db -> query('update para set lib = "'.$_POST['lib'].'"');
	}
	
	

	if(isset($_GET['task']) && $_GET['task'] == 'Modif')
	{
		$tab = json_decode(urldecode($_GET['data']), true);
		$lib = $tab['lib']; $id = $tab['id'];
	}
	elseif(isset($_GET['task']) && $_GET['task'] == 'supp')
	{
		$db -> query('delete from para where id = "'.$_GET['id'].'"');
	}
?>
<form method="POST" action="parametre.php" >
	<input type="text" name="lib" placeholder="libellé" value="<?=$lib?>" />
	<select name = "type">
		<option>Parametres</option>
		<option value="degres">degres</option>
		<option value="courses">courses</option>
		<option value="Profil">Profil</option>
	</select><br/>
	<?php
	
		
		$btn= (isset($_GET['task']))? '<input type="submit" name = "btn" value="update" />' : '<input type="submit" name="btn" value="add" />';
	echo $btn;
	?>
	
 </form>

<?php 
	$req = $db -> query('select * from para');
	if($req -> rowCount() != 0)
	{
		 echo '<table border=1>';
		  while ($dt = $req->fetch())
		  { 
		  echo '<tr>'; 
		  echo '<td><a href="parametre.php?task=Modif&data='.urlencode(json_encode($dt)).'">Modifier</a></td>';
		   echo '<td><a href="parametre.php?task=supp&id='.$dt['id'].'">Supprimer</a></td>';
		   echo '<td>'.$dt['lib'].'</td>'; 
		   echo '</tr>'; 
		}
		echo '</table>';
	}
	
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Tu as choisi : " . $_POST['type'];
}


?> 





