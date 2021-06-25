<?php
include_once __DIR__ . '/includes/Memo.php';


if (isset($_GET['id'])) {
    \Datafather\Memo::updateMemo($_POST, $_GET['id']);
}