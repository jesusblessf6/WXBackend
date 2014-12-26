/* jquery-fn-panel v1.0
 * Based on jQuery JavaScript Library v1.3
 * http://jquery.com/
 *
 * The author of the following code: Michael Xu
 * Blog://miqi2214.cnblogs.com
 * Date: 2009-4-14
*/ 

var j = jQuery.noConflict();
j.fn.changePanel = function(resetOn){
	var _resetOn = resetOn;
	var options = null;
	var defaults ={wMin:200, wMax:400, hMin:50, hMax:100};
	var iNum,gNum; //随机算法生成的宽度、高度值
	
	var _wMin = a("#wMin");
	var _wMax = a("#wMax");
	var _hMin = a("#hMin");
	var _hMax = a("#hMax");
	
	options = {wMin:_wMin, wMax:_wMax, hMin:_hMin, hMax:_hMax};
	//alert("当前输入值："+options.wMin+" , "+options.wMax+" , "+options.hMin+" , "+options.hMax);

	var _o = j.extend({},defaults,options);
	//alert("合并默认值："+_o.wMin+" , "+_o.wMax+" , "+_o.hMin+" , "+_o.hMax);

	var _boxWidth = j("#exhibition").width();
	var _elem = j("#exhibition").children(".exhibiton");

	_elem.each(function(i){
		iNum = selectFrom(_o.wMin,_o.wMax);
		gNum = selectFrom(_o.hMin,_o.hMax);
		j(_elem[i]).animate({width:iNum},1000).find(".exBody").animate({height:gNum},1500);
	});
};

function a(elemId){
	var _value = j(elemId).val();
	if(!_value){
		return;
	}else{
		if(test1(_value)){
			return _value;
		}else{
			return;
		}
	}
};

//正则匹配输入有效值为正整数
function test1(obj){
	var reg = new RegExp("^[0-9]*$");//匹配0开头的N位数字
	return reg.test(obj);
}

//随机函数
function selectFrom(iFirstValue, iLastValue){
	var iChoices = iLastValue - iFirstValue + 1;
	var numValue = Math.floor(Math.random()*iChoices+parseInt(iFirstValue));
	return numValue;
}

j.fn.focusHandler = function(){
	var _textElem = j(this).find(":text");
	var txtList = new Array("默认最小值：200","默认最大值：400","默认最小值：50","默认最大值：100");
	_textElem.each(function(i){
		j(_textElem[i]).val(txtList[i]);
		var _value = j(this).val();
		j(this).focus(function(){
			if(this.value == _value)
				j(this).css("color","#333").val('');
		}).blur(function(){
			if(this.value == ""){
				j(this).css("color","#666").val(_value);
			}
		});
	});
};

j(document).ready(function(){
	j("#resetBt0").bind("click", j.fn.changePanel);
	j("#t").focusHandler();
});