<?php
include __DIR__ .'/includes/Memo.php';
if(isset($_GET['id'])){
    \Datafather\Memo::deleteMemo($_GET['id']);
}else{
    \Datafather\Memo::deleteMemo();
}