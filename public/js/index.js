$(function(){
	homePage();
	$(".headBottomDetail ul li img").hover(function(){
		var rel=$(this).attr("rel");
		$("div[rel="+rel+"]").css({'display':'block'});
	},function(){
		var rel=$(this).attr("rel");
		$("div[rel="+rel+"]").css({'display':'none'});
	})

})

function showListCart(session){
	var str="session="+session;
	$.ajax({
		url:'listCart.php',
		type:'get',
		data:str,
		cache:false,
		success:function(data){
			$(".showListCart").html(data);
		}
	})

	$(".showListCart").slideToggle(200);

}

function viewItem(id){
	var str = "id="+id;
	window.location="item.php?id="+id;
	/*
	$.ajax({
		url:'item.php',
		type:'get',
		data:str,
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$.unblockUI();
			$("#itemArea").html(data);			
		}	
	});
	*/
}

function homePage(){
$.ajax({
		url:'itemArea.php',
		type:'get',
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$.unblockUI();
			$("#itemArea").html(data);			
		}	
	});
}

function qa(){
$.ajax({
		url:'qa.php',
		type:'get',
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$("#itemArea").html(data);
			$.unblockUI();
		}	
	});
}

function search(){
	var kw=$("#keyword").val();
	var str="keyword="+kw;
	$.ajax({
		url:'search.php',
		type:'get',
		data:str,
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$("#itemArea").html(data);
			$.unblockUI();
		}	
	});
}


function searchFooter(){
	var kw=$("#keywordFooter").val();
	var str="keyword="+kw;
	$.ajax({
		url:'search.php',
		type:'get',
		data:str,
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$("#itemArea").html(data);
			$.unblockUI();
		}	
	});
}

function order(){
$.ajax({
		url:'order.php',
		type:'get',
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$("#itemArea").html(data);
			$.unblockUI();
		}	
	});
}

function viewLarge(picture){
	$(".coverPicture").html("<img src='upload/"+picture+"'>");
}

function catalog(cat){
	var str="cat="+cat;
	$.ajax({
		url:'itemArea.php',
		type:'get',
		data:str,
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$.unblockUI();
			$("#itemArea").html(data);			
		}	
	});
}

function nextPage(cat,startItem,limitItem){
	var str="start="+startItem;
           str+="&limit="+limitItem;
		   str+="&cat="+cat;
	$.ajax({
		url:'itemArea.php',
		type:'get',
		data:str,	
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$.unblockUI();
			$("#itemArea").html(data);			
		}	
	});
}

function addCart(id){
	var str="id="+id;
	$.ajax({
		url:'addCart.php',
		type:'get',
		data:str,
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$.unblockUI();
			$(".cartHead").html("<img src=\"images/cart.png\">&nbsp;&nbsp;"+data);
		}
	})
}

function amountToBath(price,rel){
	var amount=$(".amount[rel="+rel+"]").val();
	var sum=parseInt(price)*amount;
	$(".sum[rel="+rel+"]").val(sum);
	var str="amount="+amount;
		    str+="&id="+rel;	
			str+="&sum="+sum;	
	$.ajax({
		url:'updateAmount.php',
		type:'get',
		data:str,
		cache:false,
		success:function(data){
		
		}
	})
}

function sumPrice(session){
	var str="session="+session;
	$.ajax({
		url:'sumPrice.php',
		type:'get',
		data:str,
		cache:false,
		success:function(data){
			$("#h55").html(data);
		}
	})
}

function dropCart(session,id){
	var str="id="+id;
			str+="&session="+session;

	$.ajax({
		url:'currentCart.php',
		type:'get',
		data:str,
		cache:false,
		success:function(data){
			$(".cartHead").html("<img src=\"images/cart.png\">&nbsp;&nbsp;"+data);
		}
	})

	$.ajax({
		url:'dropCart.php',
		type:'get',
		data:str,
		cache:false,
		success:function(data){
			showListCart(session);
		}
	})
}

function confirmButton(){
	$.ajax({
		url:'formMail.php',
		type:'get',
		cache:false,
		success:function(data){
			$(".showListCart").html(data);
		}
	});	
}

function confirmAddressButton(){
	$("#frmAddress").submit();
}

function addAddress(){
	var str=$("#frmAddress").serialize();
	$.ajax({
		url:'addAddress.php',
		type:'post',
		data:str,
		cache:false,
		beforeSend:function(){
			$.blockUI({
				message: "<h1>Loading...</h1>",
				css: {border: 'none',padding: '5px',opacity:1,color: '#fff',backgroundColor:'' }
			});
		},
		success:function(data){
			$.unblockUI();
			alert("การสั่งซื้อเสร็จสมบูรณ์แล้ว");
			$(".showListCart").css({'display':'none'});
			order();
			$(".cartHead").html("<img src=\"images/cart.png\">&nbsp;&nbsp;0");			
		}
	})
}
