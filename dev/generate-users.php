<?php

use BdUser\Service\UserService;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;
use Zend\EventManager\EventInterface;
use BdUser\Entity\User;
use BdUser\Entity\UserPhoneNumber;
use BdAuthentication\Service\PasswordChangeService;
use BdAuthentication\Service\AuthService;

chdir(dirname(__DIR__));
require 'init_autoloader.php';
$app = Zend\Mvc\Application::init(require 'config/application.config.php');

$userService = $app->getServiceManager()->get('UserService');
/* @var $userService UserService */

$passwordChangeService = $app->getServiceManager()->get('PasswordChangeService');
/* @var $passwordChangeService PasswordChangeService */

$authenticationService = $app->getServiceManager()->get('AuthService');
/* @var $authenticationService AuthService */

$console = $app->getServiceManager()->get('Console');
/* @var $console ConsoleAdapter */


$users = array();
$dateTime = new DateTime();
$formattedDateTime = $dateTime->format('Y-m-d H:i:s');

$password = $passwordChangeService->createPassword('12345678');

$user = array(
    'creationDate' => $formattedDateTime,
    'username' => 'martins.pudelis',
    'status' => User::STATUS_ACTIVE,
    'userDetails' => array(
        'creationDate' => $formattedDateTime,
        'city' => 'Riga',
        'email' => 'martins.pudelis@wallcity.lv',
        'firstName' => 'Martins',
        'middleName' => '',
        'lastName' => 'Pudelis',
        'country' => 'lv',
        'street' => 'Brivibas',
        'streetNumber' => '12c',
        'zip' => 'LV1050',
        'userPhoneNumber' => array(
            'phoneType' => UserPhoneNumber::TYPE_MOBILE,
            'number' => '+371222222',
            'creationDate' => $formattedDateTime,
        )
    ),
    'authenticationData' => array(
        'password' => $password,
        'passwordUntilValidDate' => $formattedDateTime,
    )
);

array_push($users, $user);

$user = array(
    'creationDate' => $formattedDateTime,
    'username' => 'janis.beka',
    'status' => User::STATUS_ACTIVE,
    'userDetails' => array(
        'creationDate' => $formattedDateTime,
        'city' => 'Riga',
        'email' => 'martins.pudelis@wallcity.lv',
        'firstName' => 'Janis',
        'middleName' => '',
        'lastName' => 'Beka',
        'country' => 'lv',
        'street' => 'Deglava',
        'streetNumber' => '234',
        'zip' => 'LV1000',
        'userPhoneNumber' => array(
            'phoneType' => UserPhoneNumber::TYPE_MOBILE,
            'number' => '+3712234345',
            'creationDate' => $formattedDateTime,
        )
    ),
    'authenticationData' => array(
        'password' => $password,
        'passwordUntilValidDate' => $formattedDateTime,
    )
);

array_push($users, $user);

$user = array(
    'creationDate' => $formattedDateTime,
    'username' => 'dainis.gatis',
    'status' => User::STATUS_ACTIVE,
    'userDetails' => array(
        'creationDate' => $formattedDateTime,
        'city' => 'Riga',
        'email' => 'martins.pudelis@wallcity.lv',
        'firstName' => 'Dainis',
        'middleName' => '',
        'lastName' => 'Gatis',
        'country' => 'lv',
        'street' => 'Upes',
        'streetNumber' => '111',
        'zip' => 'LV1050',
        'userPhoneNumber' => array(
            'phoneType' => UserPhoneNumber::TYPE_MOBILE,
            'number' => '+371345222222',
            'creationDate' => $formattedDateTime,
        )
    ),
    'authenticationData' => array(
        'password' => $password,
        'passwordUntilValidDate' => $formattedDateTime,
    )
);

array_push($users, $user);

$user = array(
    'creationDate' => $formattedDateTime,
    'username' => 'martins.paberzs',
    'status' => User::STATUS_ACTIVE,
    'userDetails' => array(
        'creationDate' => $formattedDateTime,
        'city' => 'Riga',
        'email' => 'martins.paberzs@wallcity.lv',
        'firstName' => 'Martins',
        'middleName' => '',
        'lastName' => 'Paberzs',
        'country' => 'lv',
        'street' => 'Nīcgales',
        'streetNumber' => '23',
        'zip' => 'LV1051',
        'userPhoneNumber' => array(
            'phoneType' => UserPhoneNumber::TYPE_MOBILE,
            'number' => '+37122222234',
            'creationDate' => $formattedDateTime,
        )
    ),
    'authenticationData' => array(
        'password' => $password,
        'passwordUntilValidDate' => $formattedDateTime,
    )
);

array_push($users, $user);

$user = array(
    'creationDate' => $formattedDateTime,
    'username' => 'martinssz',
    'status' => User::STATUS_ACTIVE,
    'userDetails' => array(
        'creationDate' => $formattedDateTime,
        'city' => 'Riga',
        'email' => 'martins.pudelis@wallcity.lv',
        'firstName' => 'Martins',
        'middleName' => '',
        'lastName' => 'Klava',
        'country' => 'lv',
        'street' => 'Ugandas iela',
        'streetNumber' => '12c',
        'zip' => 'LV1050',
        'userPhoneNumber' => array(
            'phoneType' => UserPhoneNumber::TYPE_MOBILE,
            'number' => '+371222222',
            'creationDate' => $formattedDateTime,
        )
    ),
    'authenticationData' => array(
        'password' => $password,
        'passwordUntilValidDate' => $formattedDateTime,
    )
);

array_push($users, $user);


$console->write('Starting users generation'. "\n\n\n\n\n");

foreach ($users as $u) {
    $findUser = $userService->findUsersBy(array('username' => $u['username']));
    if (!$findUser) {
        $user = setUserData($u);
        $userDetail = setUserDetailsData($u['userDetails']);
        $userPhoneNumber = setUserPhoneNumberData($u['userDetails']['userPhoneNumber']);
        $authenticationData = setAuthenticationData($u['authenticationData']);

        $userService->storeUserDetail($userDetail);

        $userPhoneNumber->setUserDetail($userDetail);
        $userService->storeUserPhoneNumber($userPhoneNumber);

        $authenticationService->storeAuthenticationData($authenticationData);

        $user->setUserDetail($userDetail);
        $user->setAuthenticationData($authenticationData);

        $userService->storeUser($user);

        $console->write('Adding user:' . $u['username'] . "\n");
    }
}

$console->write('Finishing users generation'. "\n\n\n\n\n");

/**
 * @param array $data
 * @return User
 */
function setUserData(array $data)
{
    global $userService;
    /* @var $userService UserService */

    $user = $userService->getNewUser();
    foreach ($data as $key => $value) {
        if (!is_array($value)) {
            $functionName = sprintf('set%s', ucfirst($key));

            if (method_exists($user, $functionName)) {
                $user->{$functionName}($value);
            }
        }
    }

    return $user;
}

/**
 * @param array $data
 * @return \BdUser\Entity\UserDetail
 */
function setUserDetailsData(array $data)
{
    global $userService;
    /* @var $userService UserService */

    $userDetail = $userService->getNewUserDetail();
    foreach ($data as $key => $value) {
        if (!is_array($value)) {
            $functionName = sprintf('set%s', ucfirst($key));

            if (method_exists($userDetail, $functionName)) {
                $userDetail->{$functionName}($value);
            }
        }
    }

    return $userDetail;
}

function setUserPhoneNumberData(array $data)
{
    global $userService;
    /* @var $userService UserService */

    $userPhoneNumber = $userService->getNewUserPhoneNumber();
    foreach ($data as $key => $value) {
        if (!is_array($value)) {
            $functionName = sprintf('set%s', ucfirst($key));

            if (method_exists($userPhoneNumber, $functionName)) {
                $userPhoneNumber->{$functionName}($value);
            }
        }
    }

    return $userPhoneNumber;
}

function setAuthenticationData(array $data)
{
    global $authenticationService;

    $authData = $authenticationService->getNewAuthenticationData();
    foreach ($data as $key => $value) {
        if (!is_array($value)) {
            $functionName = sprintf('set%s', ucfirst($key));

            if (method_exists($authData, $functionName)) {
                $authData->{$functionName}($value);
            }
        }
    }

    return $authData;
}

