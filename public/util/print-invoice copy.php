<?php
// (A) LOAD INVOICR
$invoice_id = $_GET['id'];
require "invlib/invoicr.php";
include '../../config.php';

// (B) SET INVOICE DATA
// (B1) COMPANY INFORMATION
/* RECOMMENDED TO JUST PERMANENTLY CODE INTO INVLIB/INVOICR.PHP > (C1)
$invoicr->set("company", [
	"http://localhost/code-boxx-logo.png",
	"D:/http/code-boxx-logo.png",
	"Code Boxx",
	"Street Address, City, State, Zip",
	"Phone: xxx-xxx-xxx | Fax: xxx-xxx-xxx",
	"https://code-boxx.com",
	"doge@code-boxx.com"
]); */

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

// (B2) INVOICE HEADER
$invoicr->set("head", [
    ["Invoice #", $invoice],
    ["DOP", $dop]
]);

// (B3) BILL TO
$invoicr->set("billto", [
    $name,
    $address,
    $etc
]);

// (B4) SHIP TO
$invoicr->set("shipto", [
    $name,
    $address,
    $etc
]);

// (B5) ITEMS - ADD ONE-BY-ONE
$ite = [
    ["Rubber Hose", "5m long rubber hose", 3, "$5.50", "$16.50"],
    ["Rubber Duck", "Good bathtub companion", 8, "$4.20", "$33.60"],
    ["Rubber Band", "", 10, "$0.10", "$1.00"],
    ["Rubber Stamp", "", 3, "$12.30", "$36.90"],
    ["Rubber Shoe", "For slipping, not for running", 1, "$20.00", "$20.00"]
];
// foreach ($items as $i) { $invoicr->add("items", $i); }

// (B6) ITEMS - OR SET ALL AT ONCE
$invoicr->set("items", $items);

// (B7) TOTALS
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


// // (B8) NOTES, IF ANY
// $invoicr->set("notes", [
// 	"Cheques should be made payable to Code Boxx",
// 	"Get a 10% off with the next purchase with discount code DOGE1234!"
// ]);

// (C) OUTPUT
// (C1) CHOOSE A TEMPLATE
$invoicr->template("apple");
// $invoicr->template("banana");
// $invoicr->template("blueberry");
// $invoicr->template("lime");
// $invoicr->template("simple");
// $invoicr->template("strawberry");

// (C2) OUTPUT IN HTML
// DEFAULT : DISPLAY IN BROWSER
// 1 : DISPLAY IN BROWSER
// 2 : FORCE DOWNLOAD
// 3 : SAVE ON SERVER
// $invoicr->outputHTML();
// $invoicr->outputHTML(1);
// $invoicr->outputHTML(2, "invoice.html");
// $invoicr->outputHTML(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.html");

// (C3) OUTPUT IN PDF
// DEFAULT : DISPLAY IN BROWSER
// 1 : DISPLAY IN BROWSER
// 2 : FORCE DOWNLOAD
// 3 : SAVE ON SERVER
$invoicr->outputPDF();
// $invoicr->outputPDF(1);
// $invoicr->outputPDF(2, "invoice.pdf");
// $invoicr->outputPDF(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.pdf");

// (C4) OUTPUT IN DOCX
// DEFAULT : FORCE DOWNLOAD
// 1 : FORCE DOWNLOAD
// 2 : SAVE ON SERVER
// $invoicr->outputDOCX();
// $invoicr->outputDOCX(1, "invoice.docx");
// $invoicr->outputDOCX(2, __DIR__ . DIRECTORY_SEPARATOR . "invoice.docx");

// (D) USE RESET() IF YOU WANT TO CREATE ANOTHER ONE AFFTER THIS
// $invoicr->reset();