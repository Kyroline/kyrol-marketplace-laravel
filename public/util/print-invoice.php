<?php

$invoice_id = $_GET['id'];
require "invlib/invoicr.php";
include '../../config.php';

$items = [];
$subtotal = 0;
$fee = 0;
$grandtotal = 0;

$selectItem = "SELECT * FROM invoice_item where invoice_id = $invoice_id";
$res = $conn->query($selectItem);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_array()) {
        $item = [];
        array_push($item, $row['item_name']);
        array_push($item, $row['item_variant']);
        array_push($item, $row['item_qty']);
        array_push($item, "Rp" . number_format($row['item_price'], 0, '.', ',') . ".-");
        array_push($item, "Rp" . number_format($row['item_qty'] * $row['item_price'], 0, '.', ',') . ".-");
        $subtotal += $row['item_qty'] * $row['item_price'];
        array_push($items, $item);
    }
}

$selectItem1 = "SELECT * FROM invoice where id = $invoice_id";
$res1 = $conn->query($selectItem1);

if ($res1->num_rows > 0) {
    while ($row1 = $res1->fetch_array()) {
        $fee = $row1['invoice_fee'];
        $invoice = "INV/" . $row1['user_id'] . "/" . date('YmdHis', strtotime($row1['invoice_date'])) . "/" . $row1['id'];
        $dop = date('Y-m-d', strtotime($row1['invoice_date']));
        $name = $row1['invoice_name'];
        $address = $row1['invoice_address'];
        $etc = $row1['invoice_province'] . ", " . $row1['invoice_city'];
        $status = $row1['status'];
    }
}

$grandtotal = $subtotal + $fee;
$invoicr->set("head", [
    ["Invoice #", $invoice],
    ["DOP", $dop]
]);
$invoicr->set("billto", [
    $name,
    $address,
    $etc
]);
$invoicr->set("shipto", [
    $name,
    $address,
    $etc
]);
$ite = [
    ["Rubber Hose", "5m long rubber hose", 3, "$5.50", "$16.50"],
    ["Rubber Duck", "Good bathtub companion", 8, "$4.20", "$33.60"],
    ["Rubber Band", "", 10, "$0.10", "$1.00"],
    ["Rubber Stamp", "", 3, "$12.30", "$36.90"],
    ["Rubber Shoe", "For slipping, not for running", 1, "$20.00", "$20.00"]
];
$invoicr->set("items", $items);
if ($status < 2) {
    $invoicr->set("totals", [
        ["SUB-TOTAL", "Rp" . number_format($subtotal, 0, '.', ',') . ".-"],
        ["TRANSPORT FEE", "Rp" . number_format($fee, 0, '.', ',') . ".-"],
        ["GRAND TOTAL", "Rp" . number_format($grandtotal, 0, '.', ',') . ".-"]
    ]);
} else {
    $invoicr->set("totals", [
        ["SUB-TOTAL", "Rp" . number_format($subtotal, 0, '.', ',') . ".-"],
        ["TRANSPORT FEE", "Rp" . number_format($fee, 0, '.', ',') . ".-"],
        ["GRAND TOTAL", "Rp" . number_format($grandtotal, 0, '.', ',') . ".-"],
        ["STATUS", "PAID"]
    ]);
}
$invoicr->template("apple");
$invoicr->outputPDF();