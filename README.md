# Php-Bootstrap-Pagination
Generate pagination html for simple page navigation using bootstrap and php<br />
$page = new Pagination($total,$currentpage);<br />
//Get skip value for database<br />
$page->getSkip();<br />
//Get limit<br />
$page->getLimit();<br />
//Get Html Code<br />
$page->getHtml();<br />
