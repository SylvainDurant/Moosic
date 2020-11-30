<?php
include('db.php');

// Frontend
function fetchAllSongs($conn) {
	$request = "SELECT * FROM songs
				LEFT JOIN users
				ON users.id = songs.user_id
				LEFT JOIN categories
				ON categories.id = songs.category_id"; 

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

// Backend
function fetchAllUsers($conn) {
	$request = "SELECT * FROM users
				LEFT JOIN songs
				ON songs.id = users.id";
				/*LEFT JOIN comments
				ON comments.id = users.id"; */

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;

	return $rows;
}

function fetchUserById($conn, $id = 2) {
	$request = "SELECT * FROM users
				LEFT JOIN songs
				ON users.id = songs.user_id
				LEFT JOIN categories
				ON songs.category_id = categories.id
				WHERE users.id = $id";

	$stmt = $conn->prepare($request); // prepare the request in a statement
	$stmt->execute(); // execute the statement

	// set the resulting array to associative & fetch all
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$rows = $result ? $stmt->fetchAll() : null;
	$data = [];
	// var_dump($rows);

	if ($rows) {
		$data['id'] = $rows[0]['id'];
		$data['last_name'] = $rows[0]['last_name'];
		$data['first_name'] = $rows[0]['first_name'];
		$data['email'] = $rows[0]['email'];
		$data['birthday'] = $rows[0]['birthday'];
		$data['created_at'] = $rows[0]['created_at'];
		$songs = [];

		foreach ($rows as $row) {
			$song = [];
			$song['id'] = $row['id'];
			$song['title'] = isset($row['title']) ? $row['title'] : "";
			$song['album_name'] = isset($row['album_name']) ? $row['album_name'] : "";
			$song['source'] = isset($row['source']) ? $row['source'] : "";
			$song['category'] = isset($row['name']) ? $row['name'] : "";

			array_push($songs, $song);
		}

		$data['songs'] = $songs;
	}

	return $data;
}


?>