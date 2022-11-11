<?php
include "./models/DB.php";

class Item
{
	public $id;
	public $name;
	public $category;
	public $price;
	public $about;

	public function __construct($id = null, $name = null, $category = null, $price = null, $about = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->category = $category;
		$this->price = $price;
		$this->about = $about;
	}

	public static function all()
	{
		$items = [];
		$db = new DB();
		$query = "SELECT * FROM `items`";
		$result = $db->conn->query($query);

		while ($row = $result->fetch_assoc()) {
			$items[] = new Item($row['id'], $row['name'], $row['category'], $row['price'], $row['about']);
		}
		$db->conn->close();
		return $items;
	}

	public static function create()
	{
		if (($_POST['category'] == "Virtuvė") || ($_POST['category'] == 'Miegamasis') || ($_POST['category'] == "Tualetas") || ($_POST['category'] == "Svetainė")) {
			$db = new DB();

			$stmt = $db->conn->prepare("INSERT INTO `items`( `name`, `category`, `price`, `about`) VALUES (?,?,?,?)");
			$stmt->bind_param("ssds", $_POST['name'], $_POST['category'], $_POST['price'], $_POST['about']);
			$stmt->execute();

			$stmt->close();
			$db->conn->close();
		}
	}

	public static function find($id)
	{
		$item = new Item();
		$db = new DB();
		$query = "SELECT * FROM `items` where `id`=" . $id;
		$result = $db->conn->query($query);

		while ($row = $result->fetch_assoc()) {
			$item = new Item($row['id'], $row['name'], $row['category'], $row['price'], $row['about']);
		}
		$db->conn->close();
		return $item;
	}

	public function update()
	{
		$db = new DB();
		$stmt = $db->conn->prepare("UPDATE `items` SET `name`= ? ,`category`= ? ,`price`= ? ,`about`= ? WHERE `id` = ?");
		$stmt->bind_param("ssdsi", $_POST['name'], $_POST['category'], $_POST['price'], $_POST['about'], $_POST['id']);
		$stmt->execute();

		$stmt->close();
		$db->conn->close();
	}

	public static function destroy($id)
	{
		$db = new DB();
		$stmt = $db->conn->prepare("DELETE FROM `items` WHERE `id` = ?");
		$stmt->bind_param("i", $_POST['id']);
		$stmt->execute();

		$stmt->close();
		$db->conn->close();
	}

	public static function getfilterParams()
	{
		$params = [];
		$db = new DB();
		$query = "SELECT DISTINCT `category` FROM `items`";
		$result = $db->conn->query($query);

		while ($row = $result->fetch_assoc()) {
			$params[] = $row['category'];
		}
		$db->conn->close();
		return $params;
	}

	public static function filter()
	{
		$items = [];
		$db = new DB();
		$query = "SELECT * FROM `items` ";
		$first = true;
		if (($_GET['filter'] != "")) {
			$first = false;
			$query .= "WHERE `category` =  \"" . $_GET['filter'] . "\"" . " ";
		}

		if ($_GET['from'] != "") {
			$query .= (($first) ? "WHERE" : "AND") . " `price` >= " . $_GET['from'] . " ";
			$first = false;
		}
		if ($_GET['to'] != "") {
			$query .= (($first) ? "WHERE" : "AND") . " `price` <= " . $_GET['to'] . " ";
			$first = false;
		}

		if (!isset($_GET['sort'])) {
			$query .= "";
		} else {

			switch ($_GET['sort']) {

				case '1':
					$query .= "ORDER BY `price`";
					break;

				case '2':
					$query .= "ORDER BY `price` DESC";
					break;

				case '3':
					$query .= "ORDER BY `name`";
					break;

				case '4':
					$query .= "ORDER BY `name` DESC";
					break;
			}
		}

		// print_r($query);die;
		$result = $db->conn->query($query);

		while ($row = $result->fetch_assoc()) {
			$items[] = new Item($row['id'], $row['name'], $row['category'], $row['price'], $row['about']);
		}
		$db->conn->close();
		return $items;
	}

	public static function search()
	{
		$items = [];
		$db = new DB();
		$query = "SELECT * FROM `items` WHERE `name` LIKE \"%" . $_GET['search'] . "%\"";
		$result = $db->conn->query($query);

		while ($row = $result->fetch_assoc()) {
			$items[] = new Item($row['id'], $row['name'], $row['category'], $row['price'], $row['about']);
		}
		$db->conn->close();
		return $items;
	}

}

// 	public static function filteredItems($category)
// 	{
// 		// print_r($cat);die;
// 		$items = [];
// 		$db = new DB();
// 		//
// 		// CHEKINAM AR CATEGORY NERA ALL JEI NE PADUODAM I SQL QUERY KURIS ISFILTRUOJA PAGAL KATEGORIJA
// 		//
// 		$query = $category === "all" ? "SELECT * FROM `items`" : "SELECT * FROM `items` WHERE `category` =\"" . $category . "\"";
// 		// echo $query;die;
// 		$result = $db->conn->query($query);

// 		while ($row = $result->fetch_assoc()) {
// 			$items[] = new Item($row['id'], $row['name'], $row['category'], $row['price'], $row['about']);
// 		}
// 		$db->conn->close();
// 		return $items;

// 	}

// 	//
// 	// FILTRUOJAM PAGAL PRICE KURIS PASIDUODA ASC ARBA DESC, TAIP PAT CHEKINAM KURIOJ KATEGORIJOJ ESAM, KAD ISFILTRUOTU TINKAMA KATEGORIJA
// 	//
// 	public static function sortedItems($price)
// 	{
// 		// print_r($query);die;
// 		$items = [];
// 		$db = new DB();
// 		if ($_GET['category'] === "all") {
// 			$query = "SELECT * FROM `items` ORDER BY `items`.`price` $price";
// 		} else {

// 			$query = isset($_GET['category']) ? "SELECT * FROM `items` WHERE `category` =\"" . $_GET['category'] . "\"" . "ORDER BY `items`.`price` $price " : "SELECT * FROM `items` ORDER BY `items`.`price` $price";
// 		}
// 		// echo $query;die;
// 		// FILTRUOJAM PAGAL PRICE RANGE

// 		if ($_GET['from'] !== "" && $_GET['to'] == "") {
// 			if ($_GET['category'] === "all") {
// 				$query = "SELECT * FROM `items`" . " WHERE `price` >= " . $_GET['from'] . " ORDER BY `items`.`price` $price";
// 			} else {

// 				$query = isset($_GET['category']) ? "SELECT * FROM `items` WHERE `category` =\"" . $_GET['category'] . "\"" . " AND `price` >= " . $_GET['from'] . " ORDER BY `items`.`price` $price " : "SELECT * FROM `items`" . " AND `price` >= " . $_GET['from'] . "ORDER BY `items`.`price` $price";
// 			}

// 		}

// 		if ($_GET['from'] == "" && $_GET['to'] !== "") {
// 			if ($_GET['category'] === "all") {
// 				$query = "SELECT * FROM `items` " . " WHERE `price` <=" . $_GET['to'] . " ORDER BY `items`.`price` $price";
// 			} else {

// 				$query = isset($_GET['category']) ? "SELECT * FROM `items` WHERE `category` =\"" . $_GET['category'] . "\"" . " AND `price` <= " . $_GET['to'] . " ORDER BY `items`.`price` $price " : "SELECT * FROM `items`" . " AND `price` <= " . $_GET['to'] . "ORDER BY `items`.`price` $price";
// 			}

// 		}

// 		if ($_GET['from'] !== "" && $_GET['to'] !== "") {
// 			if ($_GET['category'] === "all") {
// 				$query = "SELECT * FROM `items` " . " WHERE `price` >=" . $_GET['from'] . " AND `price` <= " . $_GET['to'] . " ORDER BY `items`.`price` $price";
// 			} else {

// 				$query = isset($_GET['category']) ? "SELECT * FROM `items` WHERE `category` =\"" . $_GET['category'] . "\"" . " AND `price` >= " . $_GET['from'] . " AND `price` <= " . $_GET['to'] . " ORDER BY `items`.`price` $price " : "SELECT * FROM `items`" . " AND `price` >= " . $_GET['from'] . "AND `price` <=" . $_GET['to'] . "ORDER BY `items`.`price` $price";
// 			}

// 		}
// 		// print_r($query);die;
// 		$result = $db->conn->query($query);

// 		while ($row = $result->fetch_assoc()) {
// 			$items[] = new Item($row['id'], $row['name'], $row['category'], $row['price'], $row['about']);
// 		}
// 		$db->conn->close();
// 		return $items;

// 	}

// }
