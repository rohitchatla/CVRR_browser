<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=cvrrbrowser','root','');
$search=$_GET['q'];
$searche = explode("",$search);
//print_r($searche);
//$results = $pdo->query("SELECT * FROM 'index'");
//print_r($results->fetchAll());


$x = 0;
$construct = "";
foreach($searche as $term) {
	$x++;
	if($x ==1){
		$construct .="title LIKE CONCAT('%','$term','%') OR description LIKE CONCAT('%','$term','%') OR keywords LIKE CONCAT('%','$term','%')"
	}else{
		$construct .= "AND title LIKE CONCAT('%','$term','%')OR desciption LIKE CONCAT('%','$term','%') OR keywords LIKE CONCAT('%','$term','%')";//'%$term%'
	}
	$params[":search$x"] =$term;
}
//SELECT * FROM 'index' WHERE
//SELECT * FROM 'index' WHERE title LIKE '%$how%'
//SELECT * FROM 'index' WHERE title LIKE '%$how%' OR title LIKE '%$to%'
//SELECT * FROM 'index' WHERE title LIKE '%$how%' OR title LIKE '%$to%' OR title LIKE '%$code%'


$results = $pdo->query("SELECT * FROM 'index' WHERE $construct");
$results->execute($params);
if($results->rowCount() == 0) {
	echo "0 results found! <hr />";
}else{
echo $results->rowCount()."results found <hr />";
}
echo "<pre>";
foreach($results->fetchAll() as $result) {
echo $results['title']."<br />";
if($results['description'] == ""){
	echo "NO DEscription available."."<br />";
}else{
	echo $results['description']."<br />";

}
echo $results['url']."<br />";
echo "<hr />"

}
//print_r($results->fetchAll());
