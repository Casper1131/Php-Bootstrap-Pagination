# Php-Bootstrap-Pagination
Generate pagination html for simple page navigation using bootstrap and php\newline
$page = new Pagination($total,$currentpage);\newline
//Get skip value for database\newline
$page->getSkip();\newline
//Get limit\newline
$page->getLimit();\newline
//Get Html Code\newline
$page->getHtml();\newline
