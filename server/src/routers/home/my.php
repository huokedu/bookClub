<?php

use CP\common\Account;
use CP\book\BookShare;
use CP\book\BookBorrow;
use CP\common\AccountSessionKey;

$app->post('/home/my/detail', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {

    $model = new Account();
    $res = $model->getDetail($request->getParams());

    return $response->withJson($res);
});

// 我的图书
$app->post('/home/my/share', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {

    $account = new AccountSessionKey();
    $openid = $account->getOpenIdByKey($request->getParam('key'));
    $groupId = $account->getCurrentGroupIdByKey($request->getParam('key'));

    $model = new BookShare();
    $res = $model->getMyBookShare($groupId, $openid);

    return $response->withJson($res);
});

// 我的借阅
$app->post('/home/my/borrow', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {

    $account = new AccountSessionKey();
    $openid = $account->getOpenIdByKey($request->getParam('key'));
    $groupId = $account->getCurrentGroupIdByKey($request->getParam('key'));

    $model = new BookBorrow();
    $res = $model->getMyBookBorrow($groupId, $openid);

    return $response->withJson($res);
});
