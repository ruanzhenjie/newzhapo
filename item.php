<?php
    include_once 'include/DBControler.php';
	
	// interface InterfaceElement {
		// public function display();
	// }
	
	include_once 'include/InterfaceElement.php';
	
	
	
	
	/**
	 * 
	 */
	class ClassItem implements  InterfaceElement {
		var $pic=null;
		var $name=null;
		var $des=null;
		var $price=null;
		var $id=null;
		
		function __construct($a,$b,$e,$d=null,$c="image/pic0.jpg") {
			$this->name=$a;
			$this->des=$b;
			$this->id=$e;
			$this->pic=$c;
			// if($d===null){
				// $this->price="面议";
			// }
			// else{
				// $this->price=$d;
			// }
			$this->price=$d;
		}
		
		public function display()
		{
			
			if($this->price===null){
				echo <<<EOF
			<div class="boder_item" onclick="open_item('$this->id')">
				<div class="img_item">
					
					
					<div class="img_border">
						<img src="$this->pic"/>
					</div>
				</div>
				<div class="txt_item">
					<div class="innertxt_item">
						<div class="nametxt_item"style="height: 70%">
							<div class="des">
								$this->name
							</div>
							<span class="name">名称：</span>
						</div>
						<div class="destxt_item" style="height: 30%">
							<div class="des">
								$this->des
							</div>
							<span class="name">信息：</span>
						</div>
						
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
EOF;
			}
			else{
				echo <<<EOF
			<div class="boder_item" onclick="open_item('$this->id')">
				<div class="img_item">
					
					
					<div class="img_border">
						<img src="$this->pic"/>
					</div>
				</div>
				<div class="txt_item">
					<div class="innertxt_item">
						<div class="nametxt_item">
							<div class="des">
								$this->name
							</div>
							<span class="name">名称：</span>
						</div>
						<div class="destxt_item">
							<div class="des">
								$this->des
							</div>
							<span class="name">信息：</span>
						</div>
						<div class="pricetxt_item" >
							<div class="des">
								$this->price
							</div>
							<span class="name">价格：</span>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
EOF;
			}
			
			
		}
	}
	
	
?>		