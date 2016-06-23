<?
if(!isset($_GET["page"]))$_GET["page"]=0;
if(!isset($_GET["header"]))$_GET["header"]=0;
if(!isset($_GET["body"]))$_GET["body"]=0;
if(!isset($_GET["footer"]))$_GET["footer"]=0;
$result="";

require_once("page/{$_GET["page"]}.php");
require_once("lib/index.php");
require_once("includes/helpers.php");
require_once("public/index.php");
