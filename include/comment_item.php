<?php
	include_once 'DBControler.php';
	
	// interface InterfaceElement {
		// public function display();
	// }
	
	include_once 'InterfaceElement.php';
	/**
	 * 
	 */
	class ClassAnswerItem implements  InterfaceElement {
		var $content="";
		var $todisplay="";
		function __construct($a) {
			if($a!=""){
				$this->content=$a;
				$this->todisplay=<<<EOF
				<div style="background-color: #CCCCFF;border: 0.1em solid #CCFFFF;margin: 0.5em">
			回评:<br/>
			<p style="text-indent: 2em;color: #FF9999;">
				$a
			</p>
		</div>
EOF;
			}
		}
		
		public function display(){
			return $this->todisplay;
		}
		
		public function totr()
		{
			return $this->content;
		}
	}
	


    /**
     * 
     */
    class ClassCommentItem implements  InterfaceElement {
    	var $commentID=null;
		var $content=null;
		var $itemID=null;
		var $answerID=null;
		var $answerItem=null;
		
        
        function __construct($a,$b,$c,$d) {
            $this->commentID=$a;
			$this->content=$b;
			$this->itemID=$c;
			$this->answerID=$d;
			
			
			if($this->answerID!=""){
				$msql=DBControler::initialize();
				$str='SELECT * FROM `answer` WHERE AnswerID='.$this->answerID.' ;';
				$res=$msql->queryWithDB("zhapodb1_1",$str);
				if($res){
					while ($row=mysql_fetch_array($res)) {
						$this->answerItem=new ClassAnswerItem($row["Content"]);
					}
				}
				else{
					$this->answerItem=new ClassAnswerItem("");
				}
			}
			else{
				$this->answerItem=new ClassAnswerItem("");
			}
        }
		
		public function totr()
		{
			if($this->answerID==""){
				$answerop='<a href="answeredit.php?action=addanswer&id='.$this->commentID.'">addanswer</a>';
			}
			else{
				$answerop='<a href="answeredit.php?action=editanswer&id='.$this->answerID.'">editanswer</a>';
			}
			
			echo <<<EOF
			<tr>
			<td>
				$this->commentID
			</td>
			<td>
				$this->itemID
			</td>
			<td>
				$this->content
			</td>
			<td>
				{$this->answerItem->totr()}
			</td>
			<td>
				$answerop
			</td>
			<td>
				<a href="commentcontroler.php?action=deletecomment&id=$this->commentID">delete</a>
			</td>
			</tr>
EOF;
		}
		
		
		public function display(){
			
			
			echo <<<EOF
			<div style="background-color: #CCCCFF;border: 0.1em solid #CCFFFF;margin: 0.5em">
			评论  $this->commentID:<br/>
			<p style="text-indent: 2em;">
				$this->content
			</p>
			{$this->answerItem->display()}
		</div>
EOF;
		}
    }
	
	
	/**
	 * 
	 */
	class ClassComentControler implements  InterfaceElement {
		var $list=array();
		var $first=null;
		var $length=null;
		function __construct($itemid,$first,$length) {
			$this->first=$first;
			$this->length=$length;
			$msql=DBControler::initialize();
			if($first>=0){
				$str='SELECT * FROM `comment` WHERE ItemID='.$itemid.' ORDER BY CommentID DESC LIMIT '.$first.','.$length.' ;';
			}
			else{
				$str='SELECT * FROM `comment` WHERE ItemID='.$itemid.' ORDER BY CommentID DESC ;';
			}
			// echo $str;
			$res=$msql->queryWithDB("zhapodb1_1",$str);
			if($res){
				while ($row=mysql_fetch_array($res)) {
					// var_dump($row);
					$this->list[]=new ClassCommentItem($row["CommentID"],$row["Content"],$row["ItemID"],$row["AnswerID"]);
				}
			}
		}
		
		
		public function totr()
		{
			if(count($this->list)){
				foreach ($this->list as $key => $value) {
					$value->totr();
				}
				if($this->length==count($this->list)){
					return true;
				}
				else{
					return false;
				}
			}
			else{
				// echo <<<EOF
				// <div>
				// 没有了
				// </div>
// EOF;
				return false;
			}
		}
		
		public function display(){
			if(count($this->list)){
				foreach ($this->list as $key => $value) {
					$value->display();
				}
				if($this->length==count($this->list)){
					return true;
				}
				else{
					return false;
				}
			}
			else{
				// echo <<<EOF
				// <div>
				// 没有了
				// </div>
// EOF;
				return false;
			}
		}
	}
	

    
?>


