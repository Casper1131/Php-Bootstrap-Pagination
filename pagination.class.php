<?php

/*
 * Augmented UI @ 2017
 */

class Pagination {

    private $total;
    private $page;
    private $limit = 30;
    private $pages;
    private $adjacents;
    private $target;

    public function __construct(
    $total, $page
    ) {
        $this->pages = ceil($total / $this->limit);
        $this->total = $total;
        if ($page <= 0) {
            $this->page = 1;
        } else if($page > $this->pages) {
            $this->page = $this->pages;
        }
        else{
            $this->page = $page;
        }
        $this->adjacents = 3;
    }

    /*
      Determine How far I should skip
     *      */

    public function getSkip() {

        if ($this->page == 1) {
            return 0;
        } else if ($this->page > $this->pages) {
            return ($this->pages - 1) * $this->limit;
        } else {
            return ($this->page - 1) * $this->limit;
        }
    }
    /*
     Get Limit
     *      */
    public function getLimit(){
        return $this->limit;
    }
    /*
      Generate Html
     *      */

    public function getHtml() {
        $prev = $this->page - 1; //previous page is current page - 1
        $next = $this->page + 1; //next page is current page + 1
        $lastpage = ceil($this->total / $this->limit); //lastpage.
        $lpm1 = $lastpage - 1; //last page minus 1
        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<div class='pagination-countainer'> <ul class='pagination'>";
            if ($this->page > 1) {
                $pagination .= "<li><a href=\"$this->target?page=$prev\">«</a></li>";
            }

            if ($lastpage < 7 + ($this->adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $this->page){
                        $pagination .= "<li><a href='#' class='active'>$counter</a></li>";
                        }
                    else{
                        $pagination .= "<li><a href=\"$this->target?page=$counter\">$counter</a></li>";
                        }
                }
            }
            elseif ($lastpage > 5 + ($this->adjacents * 2)) { //enough pages to hide some
                //close to beginning; only hide later pages
                if ($this->page < 1 + ($this->adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($this->adjacents * 2); $counter++) {
                    if ($counter == $this->page){
                            $pagination .= "<li class='active'><a href=\"$this->target?page=$counter\">$counter</a></li>";
                        }
                        else{
                            $pagination .= "<li><a href=\"$this->target?page=$counter\">$counter</a></li>";
                            }
                    }
                    if($lpm1!=$this->page){
                        $pagination .= "<li><a href=\"$this->target?page=$lpm1\">$lpm1</a></li>";
                    }
                    $pagination .= "<li><a href=\"$this->target?page=$lastpage\">$lastpage</a></li>";
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)) {
                    $pagination .= "<li><a href=\"$this->target?page=1\">1</a></li>";
                    $pagination .= "<li><a href=\"$this->target?page=2\">2</a></li>";
                    for ($counter = $this->page - $this->adjacents; $counter <= $this->page + $this->adjacents; $counter++) {
                        if ($counter == $this->page){
                            $pagination .= "<li class='active'><a href=\"$this->target?page=$counter\">$counter</a></li>";
                            
                        }
                        else{
                            $pagination .= "<li><a href=\"$this->target?page=$counter\">$counter</a></li>";
                            }
                    }
                    if($lpm1!=$this->page){
                        $pagination .= "<li><a href=\"$this->target?page=$lpm1\">$lpm1</a></li>";
                    }
                    $pagination .= "<li><a href=\"$this->target?page=$lastpage\">$lastpage</a></li>";
                }
                //close to end; only hide early pages
                else {
                    $pagination .= "<li><a href=\"$this->target?page=1\">1</a></li>";
                    $pagination .= "<li><a href=\"$this->target?page=2\">2</a></li>";
                    for ($counter = $lastpage - (2 + ($this->adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $this->page)
                            $pagination .= "<li class='active'><a href=\"$this->target?page=$counter\">$counter</a></li>";
                        else
                            $pagination .= "<li><a href=\"$this->target?page=$counter\">$counter</a></li>";
                    }
                }
            }

            //next button
            if ($this->page < $this->pages){
                    $pagination .= "<li><a href=\"$this->target?page=$next\">&nbsp; &#10095;</a></li>";
                    $pagination .= "<li><a href=\"$this->target?page=$lastpage\">»</a></li>";
                }
            else{
                    $pagination .= "";
                }
            $pagination .= "</ul></div>\n";
        }
        return $pagination;
    }

}
