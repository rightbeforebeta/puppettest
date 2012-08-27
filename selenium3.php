<?php

require_once 'PHPWebDriver/WebDriver.php';

$wd_host = 'http://vistik_github:c3087ede-75c1-48ee-b6d1-758c4067d102@ondemand.saucelabs.com:80/wd/hub';
//$wd_host = 'http://localhost';
$web_driver = new PHPWebDriver_WebDriver($wd_host);


$session = $web_driver->session('firefox');

$session->open('http://saucelabs.com/test/guinea-pig');



if ($session->title() == "I am a page title - Sauce Labs") {
    echo "Title is 'I am a page title - Sauce Labs': OK.\n";
}


$session->element("id", "i am a link")->click();

if ($session->title() == "I am another page title - Sauce Labs") {
    echo "Followed link: OK.\n";
}

$session->back();

if ($session->title() == "I am a page title - Sauce Labs") {
    echo "Back to main page: OK.\n";
}

$session->element("id", "i_am_a_textbox")->sendKeys("Something for a textbox");

if (!($session->element("id", "unchecked_checkbox")->selected())) {
    $session->element("id", "unchecked_checkbox")->click();
}
if ($session->element("id", "unchecked_checkbox")->selected()) {
    echo "Selection: OK.\n";
}

if ($session->element("id", "checked_checkbox")->selected()) {
    $session->element("id", "checked_checkbox")->click();
}
if (!($session->element("id", "checked_checkbox")->selected())) {
    echo "Unselecting: OK.\n";
}

$session->element("id", "your_comments")->click();

$session->element("id", "comments")->sendKeys("A comment for the comments");
$session->element("id", "submit")->submit();

if ($session->element("id", "your_comments")->text() == "Your comments: A comment for the comments") {
    echo "Comments: OK.\n";
}

$session->close();
?>
