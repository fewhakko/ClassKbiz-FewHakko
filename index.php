<?php
    header('content-type: text/plain');
    require 'ClassKbiz.php';
    $kbank = new kbizbyfeweiei(array(
        'username' => '',
        'password' => '',
        'accountFrom' => '',
        'ibId' => '',
        'token' => ''
    ));

    //Step1
    // $dataRsso = $kbank->login();
    // $result = $kbank->validateSession($dataRsso); 
    // เอา Token กับ เอา ibId
    // print_r($result);

    // Step2
    // $res = $kbank->refreshSession();
    // $res = $kbank->getTransactionHistory("15/12/2020");
    // $res = $kbank->getAccountSummaryList();
    // print_r($res);

?>