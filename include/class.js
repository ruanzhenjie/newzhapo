/**
 * @author Administrator
 */

function errmsg(message, url, line) {
	alert("错误：" + message + "url:" + url + "\nline" + line + "\n");
	return true;
}

window.onerror = errmsg;

function CreateHttpRQ() {
	if ("Microsoft Internet Explorer" == navigator.appName) {
		try {
			return new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			return null;
		}
	} else {
		return new XMLHttpRequest();
	}
}

function OnStateChange() {
	if (rq.readyState == 4) {
		if (rq.status == 200) {
			// document.getElementById("change").innerHTML=rq.responseText+"nihao1";
			document.getElementById("content").innerHTML = rq.responseText;
		} else {
			document.getElementById("content").innerHTML = "asd";
		}
		//document.getElementById("mdiv").innerHTML=rq.toString();
	}
}





function ClassElement() {
	this.display = function() {
		return "ClassElement";
	};

}




function inheritPrototype(parent, child) {
	var f = function() {
	};
	f.prototype = parent.prototype;

	var tem = new f();
	tem.constructor = ClassLeader;
	ClassLeader.prototype = tem;
}



function ClassLeader() {
	ClassElement.call(this);
	this.display = function(node) {
	};
	this.PageArray=function(){};//存page
	this.changelist=new Array();//存element
	this.chosedcolor="#FF9999";
	this.unchosedcolor="#99CCCC";
	this.mmainleadelement=null;//两列导航栏对象
	this.mviceleadelement=null;//
	this.mitemclass="";//菜单项CSS类名
	this.lastmainitemid=null;
	
	this.changeChose=function(id){
		var temele;
		var tempage;
		while(this.changelist.length){
			temele=this.changelist.pop();
			temele.style.backgroundColor=this.unchosedcolor;
		}
		
		tempage=this.PageArray[id];
		tempage.element.style.backgroundColor=this.chosedcolor;
		this.changelist.push(tempage.element);
		
		if(tempage.parentNode!=null){
			tempage=tempage.parentNode;
			tempage.element.style.backgroundColor=this.chosedcolor;
			this.changelist.push(tempage.element);
		}
		
	};
	
	
	this.havechosed=function(id){
		var len=this.changelist.length;
		for(var i=0;i<len;i++){
			if(this.changelist[i]==this.PageArray[id].element){
				return true;
			}
			
		}
		return false;
	};
	
	
	
	this.showMainLead=function(){
		if(this.mmainleadelement.style.display=="block")
			this.closelead();
		else{
			this.mmainleadelement.style.display="block";
		}
	};
	
	this.showViceLead=function(id){
		if(this.PageArray[id].child.length)
		{
			// this.changelist[this.changelist.length-1]!=this.PageArray[id].element;
			// if (this.lastmainitemid != id) {
			if (!this.havechosed(id)) {
				this.changeChose(id);
				var len = this.mviceleadelement.childNodes.length;
				for (var i = (len - 1); i >= 0; i--) {
					this.mviceleadelement.removeChild(this.mviceleadelement.childNodes[i]);
				}

				for (var i = 0; i < this.PageArray[id].child.length; i++) {
					this.mviceleadelement.appendChild(this.PageArray[id].child[i].element);
				}
				
			}
				if(ClassLeader.Instance().mviceleadelement.style.display=="none" || ClassLeader.Instance().mviceleadelement.style.display=="")
				{
					ClassLeader.Instance().mviceleadelement.style.display="block";
				}
				else{
					ClassLeader.Instance().mviceleadelement.style.display="none";
				}
			
			// alert(ClassLeader.Instance().mviceleadelement.style.display);	
// 
			// this.mviceleadelement.style.display="block";
		}
	};
	
	this.closelead=function(){
		ClassLeader.Instance().mmainleadelement.style.display="none";
		ClassLeader.Instance().mviceleadelement.style.display="none";
	};
	
	
	this.jump=function(id){
		if(!this.havechosed(id))
			this.changeChose(id);
		
		rq = CreateHttpRQ();
				rq.open("GET", "maincontroler.php?action=itemlist&id="+this.PageArray[id].pageId, true);
				// rq.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				rq.onreadystatechange = OnStateChange;
				rq.send(null);
		
		
		ClassLeader.Instance().closelead();
	};
	
	
	this.initialiael=function(pageidlist,parentidlist,namelist,mainleadelement,viceleadelement,itemclass){
		this.mmainleadelement=mainleadelement;
		this.mviceleadelement=viceleadelement;
		this.mitemclass=itemclass;
		
		
		var temlist=new Array();
		
		var len=pageidlist.length;
		
		for(i=0;i<len;i++){
			if(parentidlist[i]<0){
				this.PageArray[pageidlist[i]]=new ClassPage(pageidlist[i],namelist[i],null);
			}
			else{
				if(parentidlist[i] in this.PageArray){
					var tem=new ClassPage(pageidlist[i],namelist[i],this.PageArray[parentidlist[i]]);
					this.PageArray[pageidlist[i]]=tem;
					this.PageArray[parentidlist[i]].child.push(tem);
				}
				else{
					temlist.push(i);
				}
			}
		}
		
		while(temlist.length!=0){
			var i=temlist.shift();
			var tem=new ClassPage(pageidlist[i],namelist[i],this.PageArray[parentidlist[i]]);
			this.PageArray[pageidlist[i]]=tem;
			this.PageArray[parentidlist[i]].child.push(tem);
		}
		
		if(this.mmainleadelement!=null)
		{
		for(var p in this.PageArray){
			var tempage=this.PageArray[p];
			if(tempage.child.length){
				var tem=document.createElement("div");
				tem.className=this.mitemclass;
				tem.innerHTML=tempage.pageName;
				
				var eleadd=document.createElement("span");
				eleadd.style.position="absolute";
				eleadd.style.left="0em";
				eleadd.innerHTML="&lt;";
				tem.appendChild(eleadd);
				
				tempage.element=tem;
			}
			else{
				var tem=document.createElement("div");
				tem.className=this.mitemclass;
				tem.innerHTML=tempage.pageName;
				tempage.element=tem;
			}
			
			if (tempage.parentNode===null) {
				this.mmainleadelement.appendChild(tempage.element);
			}
			
			if(tempage.child.length===0){
				// tempage.element.onclick=ClassLeader.Instance().jump;
				tempage.element.onclick=Function("ClassLeader.Instance().jump("+tempage.pageId+")");
			}
			else{
				tempage.element.onclick=Function("ClassLeader.Instance().showViceLead('"+tempage.pageId+"')");
				
				// tempage.element.onclick=ClassLeader.Instance().showViceLead;
			}
		}
		}
		
	};
	
}

inheritPrototype(ClassElement, ClassLeader);

ClassLeader.mleader=null;
ClassLeader.Instance=function(){
	if(null===ClassLeader.mleader){
		ClassLeader.mleader=new ClassLeader();
		return ClassLeader.mleader;
	}else{
		return ClassLeader.mleader;
	}
};





function ClassPage(a, b, c) {
	this.pageId = a;//存int
	this.pageName = b;//存string
	this.parentNode = c;//存ClassPage
	// this.pageOrder = d;
	this.element=null;//存element
	this.child = new Array();//存element
}




function AMOnStateChange() {
	if (AMrq.readyState == 4) {
		if (AMrq.status == 200) {
			// document.getElementById("change").innerHTML=rq.responseText+"nihao1";
			//alert("hello");
			var mAM=ClassAddMore.Instance();
			document.getElementById(mAM.content).innerHTML += AMrq.responseText;
			//empty();
			if(AMrq.responseText.length<10){//为什么空的东西会有一个回车？这点以后好好研究一下。
				mAM.setStatue(-1);
				mAM.endfun();
			}else{
				mAM.setStatue(1);
			}
			document.getElementById(mAM.show).style.display="none";
			mAM.incre();
			// alert(AMrq.responseText.length);
		} else {
			document.getElementById(mAM.content).innerHTML = "asd";
		}
		//document.getElementById("mdiv").innerHTML=rq.toString();
	}
}


function ClassAddMore () {
  this.first=0;
  this.length=10;
  this.target="commentcontroler.php";
  this.action="action=addmore";
  this.itemid=0;
  this.namefirst="first";
  this.namelength="length";
  this.nameitem="itemid";
  
  this.statue=1;
  this.content="content";
  this.show="show";
  this.endfun=function(){};
  
  this.clickListen=function(){
	
  	if(this.statue>0){
		AMrq = CreateHttpRQ();
		var murl = this.target + "?" + this.action + "&" + this.nameitem + "=" + this.itemid + "&" + this.namefirst + "=" + this.first + "&" + this.namelength + "=" + this.length;
		AMrq.open("GET", murl, true);
		// rq.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		AMrq.onreadystatechange = AMOnStateChange;
		AMrq.send(null);
		this.statue = 0;
		document.getElementById(this.show).style.display = "block";
	} 

  };
  
  this.scrollListen=function(){
  	//alert("1");
  	if(this.statue>0){
			  	//alert("2");
  		var a=document.body.scrollTop+document.documentElement.clientHeight;
				var Top = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
				var cHeight= document.documentElement.clientHeight;
				var sHeight=document.documentElement.scrollHeight;
			  	//alert("3 a "+Top+" b "+cHeight+" c "+document.body.clientHeight+" d "+sHeight+" e "+document.body.scrollHeight+" f "+document.documentElement.scrollTop+" g "+document.body.scrollTop+" h "+document.documentElement.pageYOffset+" i "+window.screen.height);
				
			  if(sHeight<=Top+cHeight){
			  	//alert("4");
			  	AMrq = CreateHttpRQ();
			  	var murl=this.target+"?"+this.action+"&"+this.namefirst+"="+this.first+"&"+this.namelength+"="+this.length;
				AMrq.open("GET", murl, true);
				// rq.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				AMrq.onreadystatechange = AMOnStateChange;
				AMrq.send(null);
				this.statue=0;
				document.getElementById(this.show).style.display="block";
				//alert("hi");
			  }
  	}
  };
  
  this.setStatue=function(sta){
  	this.statue=sta;
  };
  this.incre=function(){
  	this.first+=this.length;
  };
  
  this.setaction=function(maction){
  	this.action=maction;
  };
  
  this.setitemid=function(id){
  	this.itemid=id;
  };
  
  this.setendfun=function(mfun){
  	this.endfun=mfun;
  };
  
  //document.documentElement.onscroll=function(){ClassAddMore.Instance().scrollListen();};
}

ClassAddMore.mAddMore=null;
ClassAddMore.Instance=function(){
	if(ClassAddMore.mAddMore===null){
		ClassAddMore.mAddMore=new ClassAddMore();
		return ClassAddMore.mAddMore;
	}else{
		return ClassAddMore.mAddMore;
	}
};

