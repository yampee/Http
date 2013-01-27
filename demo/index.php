<?php

require '../autoloader.php';

$request = Yampee_Http_Request::createFromGlobals();

throw new Yampee_Http_Exception_AccessDenied();
throw new Yampee_Http_Exception_NotFound();
throw new Yampee_Http_Exception_MethodNotAllowed(array('get', 'post'));
throw new Yampee_Http_Exception_General(500);

$response = new Yampee_Http_Response('content', 200, array());
$response->send();