<?php
class Records
{
	public $location = null;
	public $screenshot = null;
	public $text = null;
	public $curtime = null;
	public function __construct($loc, $scrshot, $txt, $ttime)
	{
		$this->location = $loc;
		$this->screenshot = $scrshot;
		$this->text = $txt;
		$this->curtime = $ttime;
	}	
	public function getLocation()
	{
		return $this->location;
	}
	public function getPhotoBASE64($getFull = true)	
	{
		if($getFull)
		{
			return $this->screenshot;
		}
		else
		{
			preg_match('/^(data:\s*image\/(\w+);base64,)/', $this->screenshot, $result);	
			$imgContent = str_replace($result[0], '', $this->screenshot);
			$imgContent = str_replace(' ' , '+', $imgContent);
			return $imgContent;
		}
	}	
	public function getPhoto()
	{
		return base64_decode($this->getPhotoBASE64(false));
	}	
};
?>