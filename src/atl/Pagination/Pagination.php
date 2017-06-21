<?php 

namespace Atl\Pagination;

class Pagination 
{	
	/**
	 * The number of start page.
	 * 
	 * @var int
	 */
	protected $pageStart;

	/**
	 * The number of result query.
	 * 
	 * @var int
	 */
	protected $ofset;

	/**
	 * The number of total row.
	 * 
	 * @var int
	 */
	protected $totalRow;

	/**
	 * The base link pagination.
	 * 
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * The number of limit display pagination button.
	 * 
	 * @var int
	 */
	protected $limitPage;

	/**
	 * The current page html custom before.
	 * 
	 * @var string
	 */
	protected $tagOpen;

	/**
	 * The current page html custom after.
	 * 
	 * @var string
	 */
	protected $tagClose;

	/**
	 * The custom html button next link.
	 * 
	 * @var string
	 */
	protected $nextLink;

	/**
	 * The custom html button prev link.
	 * 
	 * @var string
	 */
	protected $prevLink;

	/**
	 * The custom class style.
	 * 
	 * @var string
	 */
	protected $classest;

	public function __construct( $config = array() ){
		$argsConfig = parametersExtra(
			array(
				'pageStart' => 1,
				'ofset' 	=> 10,
				'totalRow' 	=> '',
				'baseUrl' 	=> '#',
				'limitPage' => 5,
				'tagOpen' 	=> '<a class=\'btn btn-info\'>',
				'tagClose' 	=> '</a>',
				'nextLink' 	=> '&raquo;',
				'prevLink' 	=> '&laquo;',
				'classest' 	=> 'pagination pull-right',
			), $config);
		
		foreach ($argsConfig  as $key => $value) {
			$this->$key = $value;
		}
	}

	/**
	 * Get number of start query page.
	 * @param  int $page Page number
	 * @return int
	 */
	public function getStartResult( $page = null ){
		if ( $page ) {
            $startResults = ( $page - 1 ) * $this->ofset;
        } else {
            $startResults = 0;
        }
        return $startResults;
	}
	
	/**
	 * General link pagination
	 * 
	 * @param  array $config Data config for pagination.
	 * @return string
	 */
	public function link()
	{
		if(isset($this->pageStart) && filter_var($this->pageStart,FILTER_VALIDATE_INT, array('min' => 1)))
		{
			$page = $this->pageStart;
		}else{
			$page = 1;
		}
		
		if($this->totalRow > $this->ofset)
		{
			$total_page = ceil($this->totalRow/$this->ofset); /* Get total page display  */
		}else{
			$total_page = 1;
		}

		if(isset($this->limitPage))
		{
			$page_left_and_right = floor($this->limitPage/2); /* Get number of page left and right */

			$range = array('start' => 1,'end' => $total_page);
			$event = ($this->limitPage % 2 == 0); /*Lấy phần dư khi limit page */
			$range_end = $total_page - $page_left_and_right;

			
			if($total_page > $this->limitPage)
			{
				if($page <= $page_left_and_right)
				{
					$range['end'] = $this->limitPage;
				}elseif($page >= $range_end){
					$range['start'] = $total_page - $this->limitPage + 1;
				}else{
					$range['start'] = $page - $page_left_and_right;
					$range['end']   = $page + $page_left_and_right;
				}
			}
		}
		
		$output = "<ul class='" . $this->classest . "'>";
		if($total_page > 1)
		{
			if($page > 1)
			{
	  	    	$output .= "<li><a href='". $this->baseUrl ."".($page-1)."'>". $this->prevLink ."</a></li>";
	  	     }
			for ($i = $range['start']; $i <= $range['end']; $i++) 
			{ 
				if($page == $i){
	 		 		 $output .=  "<li class=\"active\">".  $this->tagOpen . ($i) . $this->tagClose ."</li>";
	 		 	}else{
	 		 			$output .= "<li><a href='". $this->baseUrl ."".$i."'>".$i."</a>";
	 		 		}
				
			}
			if($page < $total_page)
			{
	            $output .= "<li><a href='". $this->baseUrl . "" . ($page+1) . "'>" . $this->nextLink ."</a></li>";
	        }  
		}
		$output .= "</ul>";

		return $output;
	}
}