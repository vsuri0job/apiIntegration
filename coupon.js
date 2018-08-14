var sliderLimit=8;
var couponLimit=6;
var user_id= 1;
loadStyle=function(){
	jQuery("#widget-wrap {width:272px;position:relative;text-align:center;}");
	jQuery("#widget-wrap div.field {position:absolute;top:50%;left:0;right:0;padding:12px 0 0 11px;margin:0 auto;width:120px;text-align:center;}");
	jQuery("#widget-wrap input {text-align:center;background:#ecedd9;border:none;box-shadow:0px 1px 2px #000 inset;padding:0 5px;margin:0 auto;height:30px;width:100%;}");
}
$(function(){ 
	$.ajax({
	  type:'GET',   
	  url: 'http://reviewchamp.net/login/web-widget/'+companySlug+'/json',
	  dataType: "json",
	  beforeSend: function (request)
	  { 
		request.setRequestHeader("Accept", '*/*');
	  },
	  success: function (data) {
			//alert(data)
			var couponLimit=data;
			jQuery("#coupon").append('<a href="http://reviewchamp.net/login/web-widget/'+companySlug+'" target="_blank"><div id="widget-wrap" style="width:272px;position:relative;text-align:center;"><img src="http://reivewchamp.net/login/widget-img.png" alt="widget" /><div class="id" style="position:absolute;top:50%;left:0;right:0;padding:12px 0 0 11px;margin:0 auto;width:120px;text-align:center;"><input style="text-align:center;background:#ecedd9;border:none;box-shadow:0px 1px 2px #000 inset;padding:0 5px;margin:0 auto;height:30px;width:100%;" type="text" value="'+couponLimit+'"  readonly="readonly" /></div></div></a>');	
					jQuery(".showCoupon").on('click',function(){
						jQuery(this).html($(this).couponLimit);
			});
			loadStyle();
			loadCSS = function(href) {
					 var cssLink = jQuery("<link rel='stylesheet' type='text/css' href='"+href+"'>");
					 jQuery("head").append(cssLink); 
				};		
	  }
	});
});
