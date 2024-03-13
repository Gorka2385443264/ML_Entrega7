<?php

$env = parse_ini_file(__DIR__ . '/../../.env');
$APP_DIR = $env["APP_DIR"];
define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] . $APP_DIR); //Aplikazioaren karpeta edozein lekutatik atzitzeko.

require_once(APP_DIR . '/src/php/connect.php');

if (count($_POST) > 0) {
    switch ($_POST["action"]) {
        case "checkInput": {
                echo checkInput($_POST);
                break;
            }
        case "saveAnswer": {
                echo saveAnswer($_POST);
                break;
            }
    }
}

function checkInput($inputValue)
{

    $valoration = $inputValue["valoration"];
    $emailValue = $inputValue["emailValue"];
    $courseId = $inputValue["course"];

    //Begiratu aer baloratu duen (ez badu baloratu mezua erakutsi behar du)
    //Begiratu ea email formatoa zuzena den (ez bada abixatu ez dela zuzena)
    if (!correctValoration($valoration) && !correctEmail($emailValue)) {
        return json_encode(["code" => "401", "errors" => "both"]);
    } else if (!correctValoration($valoration)) {
        return json_encode(["code" => "401", "errors" => "valoration"]);
    } else if (!correctEmail($emailValue)) {
        return json_encode(["code" => "401", "errors" => "email"]);
    }

    //Konprobatu ea dagoeneko erantzun duen erantzun badu mezu bat erakutsi behar dio
    if (checkIfAlreadyHasAnswered($courseId, $emailValue)) {
        return json_encode(["code" => "402", "errors" => ""]);
    }

    //Ongi badago formularioa erakutsiko du
    return json_encode(["code" => "200", "errors" => ""]);
}

function saveAnswer($inputValue)
{
    try {
        $valoration = $inputValue["valoration"];
        $answeredOption = $inputValue["answeredOption"];
        $emailValue = $inputValue["emailValue"];
        $courseId = $inputValue["courseId"];

        $userId = getUserIdByEmail($emailValue);

        if (!correctValoration($valoration)) {
            if (saveAnswerInDb($courseId, $userId, 0, 0, 0, 0)) {
                return json_encode(["code" => "200", "message" => ""]);
            } else {
                return json_encode(["code" => "500", "message" => ""]);
            }
        }

        //Konprobatu aer hori ya dagoeneko erantzun duen. Horrela bada ez dugu sartuko zerrendan eta listo.

        if (is_null($userId)) {
            $hasAnsweredPreviously = false;
            $userId = insertUserInDb($emailValue);
        } else {
            $hasAnsweredPreviously = checkIfAlreadyHasAnsweredCourse($courseId, $userId);
        }

        if ($hasAnsweredPreviously) {
            //Moduren batean ona sartzen bada ez dugu gordeko erantzuna
            if (saveAnswerInDb($courseId, $userId, 0, 0, 0, 0)) {
                return json_encode(["code" => "200", "message" => ""]);
            } else {
                return json_encode(["code" => "500", "message" => ""]);
            }
        }

        //Erantzuna begiratu eta konprobatu ea zuzena den
        $answerIsCorrect = checkIfAnswerIsCorrect($answeredOption, $courseId);

        //Emaila konprobatu ea zerrendan dagoen
        $valid = checkIfEmailIsInList($emailValue);

        //Emaila konprobatu ea irakasleena den
        $teacher = checkIfItsTeachersEmail($emailValue);

        if (saveAnswerInDb($courseId, $userId, $valoration, $answerIsCorrect, $valid, $teacher)) {
            return json_encode(["code" => "200", "message" => ""]);
        } else {
            return json_encode(["code" => "500", "message" => ""]);
        }

    } catch (Exception $e) {
        return json_encode(["code" => "500", "message" => ""]);
    }
}

function checkIfEmailIsInList($email)
{

    //.txt -> array
    $file = APP_DIR . "/BBDD/EmailZerrenda.txt";

    $fileContent = file_get_contents($file);
    //Unix en \n bakarrik erabiltzen da \r konprobatu
    $emailsArray = explode("\r\n", $fileContent);

    $uname = getUsernameFromEmail($email);

    //mail en array
    if (in_array($uname, $emailsArray)) {
        return true;
    } else {
        return false;
    }
}
function checkIfItsTeachersEmail($email)
{

    $regexp = "/([a-zA-Z]{3}_[a-zA-Z]{3}_[a-zA-Z]{3})@(goierrieskola\.org|goierrieskola\.eus)$/";

    if (preg_match($regexp, $email)) {
        return false;
    } else {
        return true;
    }
}

function correctValoration($valoration)
{
    return $valoration != "" && ($valoration == 1 || $valoration == 2 || $valoration == 3 || $valoration == 4 || $valoration == 5);
}
function correctEmail($email)
{
    $regexp = "/([a-zA-Z]{3}_[a-zA-Z]{3}_[a-zA-Z]{3}|[a-z]{8,})@(goierrieskola\.org|goierrieskola\.eus)$/";

    if (preg_match($regexp, $email)) {
        return true;
    } else {
        return false;
    }
}

function checkIfAlreadyHasAnswered($courseId, $email)
{

    //Begiratu behar du lehenengo erabiltzaileak taulan badagoen
    $userId = getUserIdByEmail($email);

    if (is_null($userId)) {
        return false;
    }

    //ondoren id horrekin ea balorazioak taulan badagoen

    return checkIfAlreadyHasAnsweredCourse($courseId, $userId);
}
