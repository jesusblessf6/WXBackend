/*
 *
 * write by fay
 * time:2015-04-25 : 16:17
 *
 * */
;
//初始化LOADING
$('html').attr('style', 'visibility:hidden;');
window.WBPage={};

$(function () {
    if (!$('script').is('.weiba-js')) {
        var src = '<script type="text/javascript" class="weiba-js" src="/assets/public/js/weiba.js" charset="utf-8"></script>';
        $('script[src*="/assets/public/js/weiba.new.js"]').before(src);

    }

    $('body').append('<div class="new-loading"><div class="small-loading"></div></div>');
    $('body').children(':not(.new-loading)').css({'visibility': 'hidden'});
    $('html').attr('style', 'visibility:visible;');

});


$(document).ready(function () {
    //$.getAd();
});

//页面快捷方法
;
(function (window, $) {
    var prefix = {
        'uid': 'MYUID',
        'wxid': 'WXID'
    }

//    window.VALIDATE={
//        MOBILE:''
//    }
    $.RMLOAD = function () {
        if ($('div').is('.new-loading')) {
            $('.new-loading').remove();
        }
        $('body').children().css({'visibility': 'visible'});
    }

//    $.mobileYZ=function(num){
//
//        if(num&&num.){
//            return true;
//        }else{
//            return false;
//        }
//    }
    $.gundong = function (obj, height) {
        setInterval(function () {
            $(obj).find('ul:first').animate({
                marginTop: '-' + height + 'px'
            }, function () {
                $(this).css({marginTop: '0px'}).find('li:first').appendTo(this);

            });
        }, 3000);

    }
    $.getAd = function () {
        if ($('ul').is('.my-ad')) {
            var url = '/data/advert';
            var TYPE = $('.my-ad').attr('ad-type');
            var datas = {type: TYPE};

            $.ajax({
                type: 'get',
                dataType: 'jsonp',
                url: url,
                data: datas
            }).done(function (a) {
                //广告
                if (a && a.ret == 0 && a.data && $.isArray(a.data) && a.data.length > 0) {
                    var ad = '';
                    for (var i in a.data) {
                        var datas = a.data[i];
                        ad += '<li style="background-image: url(' + datas.ad_pic + ')">';
                        ad += '<a ';
                        if (datas.ad_url) {
                            ad += 'href="' + datas.ad_url + '"';
                        }
                        ad += '>';

                        ad += '<div class="ad-title">' + datas.ad_title + '</div>';
                        ad += '</a>'
                        ad += '</li>';
                    }
                    $('.my-ad').html(ad);
                    setTimeout(function () {
                        var w = $('.my-ad').width();
                        $('.my-ad').find('li').height(w / 2);
                    })

                } else {
                    //$.yalert({content:'广告加载失败！'});
                }
            });
        }
    }
	
    //填充姓名和手机
    $.getUserInfo = function () {
        var url = '/data/account/';
        var data = {
            'uid': $.getUID()
        }
        $.getJSON(url, data, function (rs) {
            if (rs['ret'] == 0) {
                var username = rs['data']['name'];
                var usermobile = rs['data']['mobile'];
                $('.weiba-user-name').val(username);
                $('.weiba-user-mobile').val(usermobile);
            }
        })
    }
    /*分享按钮start*/
    function alert_share() {
        var str = '<div class="share-alert-box"></div>';
        $('body').append(str);
        $('.share-alert-box').on('click', function () {
            $('.share-alert-box').remove();
        })
    }

    $(document).ready(function () {
        $('.share-friend,.share-quan').on('click', function () {

            alert_share();
        })
    });


    /*分享按钮start*/
    //浏览器版本
    $.isXIAOMI = function () {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf('xiaomi') > -1) {
            return true;
        } else {
            return false;
        }
    }

    $.isANDROID = function () {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf('android') > -1) {
            return true;
        } else {
            return false;
        }
    }
    $.isIPHONE = function () {
        var ua = navigator.userAgent.toLowerCase();

        if (ua.indexOf('iphone') > -1) {
            return true;
        } else {
            return false;
        }
    }
    //分享数据灌入
    $.hideTOP = function () {
        function onBridgeReady() {

            WeixinJSBridge.call('hideOptionMenu');

        }

        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
            }
        } else {
            document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
        }
    }

    $.setSHARE = function (options) {
        var option = {
            title: '',
            desc: '',
            link: window.location.href,
            icon: ''
        }
        var opt = $.extend(option, options);
        $('body').attr({
            'weiba-title': opt.title,
            'weiba-desc': opt.desc,
            'weiba-link': opt.link,
            'weiba-icon': opt.icon
        });
    }
    //获取URL上参数
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }
    //获取UID
    $.getUID = function () {
        if (!$('script').is('.weiba-account-js')) {
            var src = '<script type="text/javascript" class="weiba-account-js" src="/assets/public/js/weiba.account.js" charset="utf-8"></script>';
            $('script[src*="/assets/public/js/weiba.new.js"]').before(src);

        }


        var uid = window.WBAccount.isLogin();
        if (uid) {
            return uid;
        }
        else {
            return false;
        }
        return !!window.localStorage.getItem(prefix['uid']);
    }
    //获取微信ID
    $.getWXID = function () {
        if (!$('script').is('.weiba-account-js')) {
            var src = '<script type="text/javascript" class="weiba-account-js" src="/assets/public/js/weiba.account.js" charset="utf-8"></script>';
            $('script[src*="/assets/public/js/weiba.new.js"]').before(src);
        }
        var wxid = window.WBAccount.wxid();
        if (wxid) {
            return wxid;
        }
        else {
            return false;
        }
        return !!window.localStorage.getItem(prefix['wxid']);
    }
    //验证是否有UID
    $.checkUID = function (tips) {
        var tip = tips ? tips : '您需要关注或从聊天窗口进入该应用才能操作';
        var uid = $.getUID();
        if (!uid) {
            alert(tip);
            window.location.replace('/account/login?url=' + encodeURIComponent(window.location.href));
            return false;
        }
    }
    $.randnum = function (under, over) {
        under = under ? under : 0;
        return Math.floor(Math.random() * (over - under) + under);
    }
    //百度地图
    $.baiduMAP = function (option) {
        var opts = {
            lat: '',
            lng: '',
            name: '',
            address: ''
        }
        var opt = $.extend(opts, option);
        var mark = 'http://api.map.baidu.com/marker';
        var url = mark;
        url += '?location=' + opt.lat + ',' + opt.lng + '&';
        url += 'title=' + encodeURIComponent(opt.name) + '&';
        url += 'name=' + encodeURIComponent(opt.name) + '&';
        url += 'content=' + encodeURIComponent(opt.address) + '&';
        url += 'output=html&src=weiba|weiweb';
        return url;
    }

    var _addBlank = function (type) {
        var type = type;
        var w = $(window).width(), h = $(window).height();
        var htmls = '<div class="back-black" black-type="' + type + '" style="height:' + h + 'px"></div>';
        this.add = function () {

            $('body').append(htmls);
        }

        this.close = function () {
            $('.back-black[black-type=' + type + ']').remove();
        }
    }

    $.addBlank = function (type) {
        var a = new _addBlank(type);
        a.add();
    }
    $.addBlank.close = function (type) {
        var a = new _addBlank(type);
        a.close();
    }
    //弹窗公用方法
    var _alert_box = {
        type: "alert-box",
        view: function (option, yconfirm) {
            var opts = {
                id: '',
                title: '提示',
                content: '',
                submit_text: '确定',
                cancel_text: '取消',
                submit: function (e) {
                },
                cancel: function (e) {
                }
            }
            var w = $(window).width(), h = $(window).height();

            var opt = $.extend(opts, option);
            var htmls = '';

            htmls += '<div class="alert_w" ';
            if (opt.id) {
                htmls += ' id="' + opt.id + '"';
            }
            htmls += '>';
            htmls += '<div class="alert_w_top">' + opt.title + '</div>';
            htmls += '<div class="alert_w_tip">' + opt.content + '</div>';
            htmls += '<div class="alert_w_btn">';
            if (yconfirm) {
                htmls += '<a class="alert_w_submit" id="alert_w_quxiao">' + opt.cancel_text + '</a>';
                htmls += '<a class="alert_w_submit" id="alert_w_queding">' + opt.submit_text + '</a>';
            } else {
                htmls += '<a class="alert_w_submit" id="alert_w_queding" style="width: 100%;">' + opt.submit_text + '</a>';
            }


            htmls += '</div>';
            htmls += '</div>';
            $('.alert_w').remove();
            $.addBlank.close(_alert_box.type);

            $.addBlank(_alert_box.type);
            $('body').append(htmls);
            var alert_h = $('.alert_w').height();


            $('.alert_w').css({'margin-top': '-' + ((alert_h / 2)-20) + 'px'});

            $('#alert_w_queding').off('click').on('click', function () {

                if (option.submit) {
                    opt.submit($(this));
                } else {
                    $('.alert_w').remove();
                    $.addBlank.close(_alert_box.type);
                }

            })
            if (yconfirm) {
                $('#alert_w_quxiao').off('click').on('click', function () {
                    if (option.cancel) {
                        opt.cancel($(this));
                    } else {
                        $('.alert_w').remove();
                        $.addBlank.close(_alert_box.type);
                    }

                })
            }


        },
        close: function () {
            $('.alert_w').remove();
            $.addBlank.close(_alert_box.type);

        }

    }
    //确认窗
    $.yalert = function (option, submit) {

        if (typeof(option) == 'object') {

            _alert_box.view(option, 0);
        } else {

            var datas = {
                content: option,
                submit: submit
            }
            _alert_box.view(datas, 0);

        }


    }
    $.yalert.close = function () {
        _alert_box.close();
    }
    //有取消的
    $.yconfirm = function (option) {
        _alert_box.view(option, 1);
    }
    $.yconfirm.close = function () {
        _alert_box.close();

    }

    //上滑框
    $.yslide = function (option) {
        var opts = {
            top: '',
            content: '',
            callback: function () {
            },
            close:function(){}

        }

        var opt = $.extend(opts, option);

        var w = $(window).width(), h = $(window).height();
        var dw = $('body').width(), dh = $('body').height();
        var str = '<div class="y-slide-boxs" style="height: ' + h + 'px;top:' + h + 'px;">';
        str += '<div class="y-slide-box">'
        str += '<div class="y-slide-top"><span class="y-slide-back">取消</span>' + opt.top + '</div>';
        str += '<div class="y-slide-content" id="y-slide-content">';
        str += opt.content
        str += '</div>';
        str += '</div>';
        str += '</div>';
        if (!$('div').is('.y-slide-boxs')) {

            $(str).appendTo('body').animate({
                'top': '0'
            }, function () {
                $('body').children(':not(.y-slide-boxs)').hide();
                opt.callback();
            });
        } else {

            $('.y-slide-boxs').remove();

            $(str).appendTo('body').animate({
                'top': '0'

            }, function () {
                $('body').children(':not(.y-slide-boxs)').hide();
                opt.callback();
            })
        }


        $(window).resize(function () {
            if ($('div').is('.y-slide-boxs') && !$('.y-slide-boxs').is(':animated')) {
                $('.y-slide-boxs').css('top', 0);
            }
        })
        $('.y-slide-back').off('click').on('click', function () {

            $.yslide.close();
            opt.close();

        })

    }
    $.yslide.close = function () {
        var w = $(window).width(), h = $(window).height();
        $('body').children().show();
        $('.y-slide-boxs').animate({top: h + 'px'}, function () {
            $('.y-slide-boxs').remove();
        });
    }

    _smallLoading = {
        type: 'small-loading',
        add: function () {

            $('body').append('<div class="small-loading"></div>');
        },
        close: function () {

            $('.small-loading').remove();
        }
    }
    $.sloading = function () {
        _smallLoading.add();
    }
    $.sloading.close = function () {
        _smallLoading.close();
    }
    //字符串TOJSON
    $.STRtoJSON = JSON.parse;
    //JSONTO字符串
    $.JSONtoSTR = JSON.stringify;

    /*
     格式化日期
     "yyyy-MM-dd hh:mm:ss.S"==> 2006-07-02 08:09:04.423
     "yyyy-MM-dd E HH:mm:ss" ==> 2009-03-10 二 20:09:04
     "yyyy-MM-dd EE hh:mm:ss" ==> 2009-03-10 周二 08:09:04
     "yyyy-MM-dd EEE hh:mm:ss" ==> 2009-03-10 星期二 08:09:04
     "yyyy-M-d h:m:s.S" ==> 2006-7-2 8:9:4.18
     */
    $.formatDate = function (date, fmt) {
        var o = {
            'M+': date.getMonth() + 1, //月份
            'd+': date.getDate(), //日
            'h+': date.getHours() % 12 == 0 ? 12 : date.getHours() % 12, //小时
            'H+': date.getHours(), //小时
            'm+': date.getMinutes(), //分
            's+': date.getSeconds(), //秒
            'q+': Math.floor((date.getMonth() + 3) / 3), //季度
            'S': date.getMilliseconds() //毫秒
        };
        var week = {
            '0': '/u65e5',
            '1': '/u4e00',
            '2': '/u4e8c',
            '3': '/u4e09',
            '4': '/u56db',
            '5': '/u4e94',
            '6': '/u516d'
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (date.getFullYear() + '').substr(4 - RegExp.$1.length));
        }
        if (/(E+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? '/u661f/u671f' : '/u5468') : '') + week[date.getDay() + '']);
        }
        for (var k in o) {
            if (new RegExp('(' + k + ')').test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (('00' + o[k]).substr(('' + o[k]).length)));
            }
        }
        return fmt;
    };

})(window, jQuery);
;
//微信监听
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {

    WeixinJSBridge.on('menu:share:appmessage', function (argv) {
        WeixinJSBridge.invoke('sendAppMessage', {
            //'appid': 'kczxs88',
            'img_url': $('body').attr('weiba-icon'),
            'link': $('body').attr('weiba-link') || window.location.href,
            //'link': window.location.href,
            'desc': $('body').attr('weiba-desc') || $('body').attr('weiba-link') || window.location.href,
            'title': $('body').attr('weiba-title')
        }, function (res) {
            if (res.err_msg.indexOf('send_app_msg:confirm') > -1) {
            }

        });
    });

    WeixinJSBridge.on('menu:share:timeline', function (argv) {
        WeixinJSBridge.invoke('shareTimeline', {
            'img_url': $('body').attr('weiba-icon'),
            'link': $('body').attr('weiba-link') || window.location.href,
            //'link': window.location.href,
            'desc': $('body').attr('weiba-desc') || $('body').attr('weiba-link') || window.location.href,
            'title': $('body').attr('weiba-title')

        }, function (res) {
            if (res.err_msg.indexOf('share_timeline:ok') > -1) {

            }
        });

    });
});


