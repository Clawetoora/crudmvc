<?php
include "./controllers/ItemController.php";
$edit = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST['save'])) {
		ItemController::store();
		header("Location: ./index.php");
		die;
		print_r($_POST);
	}
	if (isset($_POST['edit'])) {

		$item = ItemController::show();
		$edit = true;
	}

	if (isset($_POST['update'])) {

		ItemController::update();
		header("Location: ./index.php");
		die;
	}

	if (isset($_POST['destroy'])) {
		ItemController::destroy();
		header("Location: ./index.php");
		die;
	}

}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['filter']) || isset($_GET['from']) || isset($_GET['to']) || isset($_GET['sort'])) {
		$items = ItemController::filter();
	}

	if (isset($_GET['search'])) {
		$items = ItemController::search();

	}
	if (count($_GET) == 0) {
		$items = ItemController::index();
	}
}

$params = ItemController::getfilterParams();
//
// IS KART UZEJUS I PUSLAPI IMETA I KATAGORIJA ALL, IR CHEKINAM TAM, KAD PADAVUS KITA KATEGORIJA JOS NEPERMUSTU ALL
//
// if (!isset($_GET['category'])) {
// 	$_GET['category'] = "all";
// }

// //
// // TIKRINAM AR NUSETINTA PRICE, JEI NE, KAD GRAZINTU VISUS ITEM
// //
// if (!isset($_GET['price'])) {
// 	$items = ItemController::index();
// }
// // print_r($_GET);

// //
// // FILTRUOJAM PAGAL KATEGORIJA
// //
// if (isset($_GET['category'])) {
// 	$items = ItemController::showFiltered();
// 	// header('Location: ./index.php');
// 	// die;
// }
// //
// // FILTRUOJAM PAGAL PRICE
// //
// if (isset($_GET['price'])) {

// 	// print_r($items) {
// 	$items = ItemController::showSorted();
// }
