<?php

/*!
 * ifsoft.co.uk v1.0
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk
 * raccoonsquare@gmail.com
 *
 * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
 */

include_once($_SERVER['DOCUMENT_ROOT']."/core/init.inc.php");
include_once($_SERVER['DOCUMENT_ROOT']."/config/api.inc.php");

if (!empty($_POST)) {

    $clientId = isset($_POST['clientId']) ? $_POST['clientId'] : 0;

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : 0;
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $clientId = helper::clearInt($clientId);

    $accountId = helper::clearInt($accountId);

    $accessToken = helper::clearText($accessToken);
    $accessToken = helper::escapeText($accessToken);

    $result = array("error" => true);

    if ($clientId != CLIENT_ID) {

        api::printError(ERROR_UNKNOWN, "Error client Id.");
    }

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $account = new account($dbo, $accountId);
    $account->setLastActive();
    $account->logout($accountId, $accessToken);

    $result = array("error" => false,
                    "error_code" => ERROR_SUCCESS);


    echo json_encode($result);
    exit;
}
