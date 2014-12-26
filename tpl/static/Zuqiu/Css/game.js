
var tempdata = '{"ret":0,"data":{"info":{"id":"348","start_time":"1402299573","end_time":"1404113976","number":"3","rule":"","prize":"","firstrate":"80","joinnum":135,"shootnum":"223","assistsnum":"302","sharenumber":"1","banner":"images/4362cc96bd2b70a9675c10c880de5392_640_410.png","custompic":"../f6fc2a8fac483908bb13d12b9a7263a3_640_738.jpg","customtitle":"\u5feb\u6765\u53c2\u52a0\u767e\u5e74\u4e00\u9047\u7684\u70b9\u7403\u5927\u6218\u5427\uff01","virtual":"26","status":1},"shooterList":[{"username":"\u5218\u552f","tel":"188427***","score":"15","rank":1}],"assistList":[{"username":"\u90d1\u5b8f\u6d9b","tel":"133242***","assistsnum":"52","rank":1}],"newrecord":[{"username":"\u8f66\u9707"}],"user":{"username":"\u4f53\u4f1a\u803f\u803f\u4e8e\u6000","tel":"236524"},"myScore":{"rank":95,"username":"\u4f53\u4f1a\u803f\u803f\u4e8e\u6000","tel":"236524","result":"0"},"myassists":{"rank":34,"username":"\u4f53\u4f1a\u803f\u803f\u4e8e\u6000","tel":"236524","result":"0"},"todaychance":3,"chance":3,"leftChance":3,"myrecordlist":[]}}';
var failure = new Array('./tpl/static/Zuqiu/Css/failure_1.png', './tpl/static/Zuqiu/Css/failure_2.png'
                        , './tpl/static/Zuqiu/Css/failure_3.png', './tpl/static/Zuqiu/Css/failure_4.png'
                        , './tpl/static/Zuqiu/Css/failure_5.png', './tpl/static/Zuqiu/Css/failure_6.png');
var success = new Array('./tpl/static/Zuqiu/Css/success_1.png', './tpl/static/Zuqiu/Css/success_2.png', './tpl/static/Zuqiu/Css/success_2.png');
var longleft = new Array( './tpl/static/Zuqiu/Css/long_left_3.png', './tpl/static/Zuqiu/Css/long_left_4.png'
                        , './tpl/static/Zuqiu/Css/long_left_5.png', './tpl/static/Zuqiu/Css/long_left_6.png'
                        , './tpl/static/Zuqiu/Css/long_left_7.png', './tpl/static/Zuqiu/Css/long_left_8.png');
var longright = new Array('./tpl/static/Zuqiu/Css/long_right_3.png', './tpl/static/Zuqiu/Css/long_right_4.png'
                        , './tpl/static/Zuqiu/Css/long_right_5.png', './tpl/static/Zuqiu/Css/long_right_6.png'
                        , './tpl/static/Zuqiu/Css/long_right_7.png', './tpl/static/Zuqiu/Css/long_right_8.png');
var animateindex = 0;
function playfailure() {
    $('#people').attr('src', failure[animateindex]);
    animateindex++;
    if (animateindex > 6) animateindex = 0;
}
function playsuccess() {
    $('#people').attr('src', success[animateindex]);
    animateindex++;
    if (animateindex > 2) animateindex = 0;
}
var movelongstep = 0;
function playlongleft() {
    $('#people').attr('src', longleft[animateindex]);
    $("#people").css('left', parseFloat($(".doorman").css('left')) + movelongstep);
    animateindex++;
    if (animateindex > 6) animateindex = 0;
}
function playlongright() {    
    $('#people').attr('src', longright[animateindex]);
    $("#people").css('left', parseFloat($(".doorman").css('left')) + movelongstep);
    animateindex++;
    if (animateindex > 6) animateindex = 0;
}


var f = 0;
$(function () {
    var c = $.randnum(0, 12);
    var a = {
        RUN: "http://pkzqbl.bama555.com/data/shootapi/shootRun",
        INDEX: "http://pkzqbl.bama555.com/data/shootapi/index"
    };
    function b() {

        this.init = function () {
            l();
            k()
        };
        function l() {
            // $.ajax({
            // type: "get",
            // dataType: "json",
            // url: a.INDEX,
            // data: {
            // openid: openid
            // }
            // }).done(function(o) {
            var o = $.parseJSON(tempdata);
            if (o.ret == 0) {
                e();
                j(o.data);
                $.RMLOAD();
                if (o.data.info.status == 0 || o.data.info.status == 3) {
                    location.replace("/shoot")
                }
            } else {
                $.yalert(o.msg)
            }
            // })
        }
        function e() {
            var o = document.getElementById("audio1");
            if ($.isIPHONE()) {
                $(".music").removeClass("start").addClass("end")
            }
            $(".music").off("click").on("click",
            function () {
                var p = $(this);
                if (p.hasClass("start")) {
                    p.removeClass("start").addClass("end");
                    o.pause()
                } else {
                    p.removeClass("end").addClass("start");
                    o.play()
                }
            })
        }
        function j(p) {
            if (p.user) {
                $(".myrecordlist-box").show();
                var r = [{
                    name: "荷兰",
                    img: "./tpl/static/Zuqiu/Css/helan.jpg"
                },
                {
                    name: "巴西",
                    img: "./tpl/static/Zuqiu/Css/baxi.jpg"
                },
                {
                    name: "阿根廷",
                    img: "./tpl/static/Zuqiu/Css/arg.png"
                },
                {
                    name: "法国",
                    img: "./tpl/static/Zuqiu/Css/faguo.jpg"
                },
                {
                    name: "意大利",
                    img: "./tpl/static/Zuqiu/Css/yidali.jpg"
                },
                {
                    name: "西班牙",
                    img: "./tpl/static/Zuqiu/Css/xibanya.jpg"
                },
                {
                    name: "日本",
                    img: "./tpl/static/Zuqiu/Css/riben.jpg"
                },
                {
                    name: "韩国",
                    img: "./tpl/static/Zuqiu/Css/hanguo.jpg"
                },
                {
                    name: "美国",
                    img: "./tpl/static/Zuqiu/Css/meiguo.jpg"
                },
                {
                    name: "英格兰",
                    img: "./tpl/static/Zuqiu/Css/eng.png"
                },
                {
                    name: "葡萄牙",
                    img: "./tpl/static/Zuqiu/Css/putaoya.jpg"
                },
                {
                    name: "德国",
                    img: "./tpl/static/Zuqiu/Css/deguo.jpg"
                }];
                //$(".page-title").html(p.user.username + ' <span class="red-font">VS</span> ' + r[c].name + ' <span class="chance"><span class="chances">' + p.leftChance + "/" + p.chance + "</span></span>");
                $(".guoqi-img").attr("src", r[c].img);
                $(".guojia-name").html(r[c].name);
                $('#lblGuojia').html(r[c].name);
                h()
            } else {
                location.replace("/shoot")
            }
        }
        function h() {
            $("#end").off("click").on("click",
            function () {
                $("#end").off("click");
                var o = $.parseJSON('{"ret":0}');
                if (o.ret == 0) {
                    g(parseInt($('#hfIfGoal').val()))
                } else {
                    if (o.ret = 1002) {
                        var p = "<div>" + o.data.msg + "</div>";
                        if (o && o.data && o.data.mp_name) {
                            p += '<div>关注公众号<span class="red-font">' + o.data.mp_name + "</span>获取更多精彩！</div>"
                        }
                        $.yalert({
                            content: p,
                            submit: function () {
                                $.yalert.close();
                                if (o && o.data && o.data.auto_attention) {
                                    location.href = o.data.auto_attention
                                }
                            }
                        })
                    } else {
                        $.yalert({
                            content: o.msg
                        })
                    }
                }
            })
        }
        function n(o) {
            setTimeout(function () {
				var wecha_id = $('#wecha_id').val();
				if(wecha_id==2)
				{
				var p = ["你的抽奖次数已经用完！"];
				}
				else
				{
				var p = ["很抱歉，您没有射进", "恭喜您！射进了一个球，得一分！","你的抽奖次数已经用完！"];
				}
                $.ajax({type: "post",url: "/index.php?g=Apps&m=Zuqiu&a=wap_qiu",data: { wecha_id:wecha_id }, dataType: "json",beforeSend: function () {
						
                    },success: function (data) {
						
                    },
                    timeout: 20000
                });
                $.yalert({
                    content: p[o],
                    submit: function () {
                        $.yalert.close();
                        $(".football").removeAttr("style").css({
                            left: "50%",
                            "margin-left": "-29px",
                            width: "58px",
                            height: "58px",
                            top: "320px"
                        });
                        //                        $(".doorman").removeAttr("style").css({
                        //                            left: "50%",
                        //                            "margin-left": "-16px"
                        //                        });
                        $(".zhizhen-box").attr("style", "-webkit-transform:rotate(0deg);");
                        f = 0;
                        l();
                        location.reload();
                    }
                })
            },
            800)
        }
        function g(o) {
            console.log(f, ((0 - Math.tan(f)) * 140 + 25));
            $(".football").animate({
                top: "-=" + (140) + "px",
                left: "+=" + (Math.tan(f) * 140 + 25) + "px",
                width: "-=50px",
                height: "-=50px"
            }, 1000,
            function () {
                n(o);
            });
            i(o)
        }

        function i(p) {
            if (p == 0) {
                var o = parseInt($(".football").css("left"));
                if (Math.sin(f) > 0) {
                    if (f < 0.48) {
                        $('#people').attr('src', $('#people').attr('src').replace('doorman.png', 'doorman_right.png'));
                        $(".doorman").animate({
                            left: "+=" + (Math.tan(f) * 140) + "px"
                        });
                    } else {
                        movelongstep = (Math.tan(f) * 110) / 5;
                        selftimer = setInterval('playlongright()', 150);
                        setTimeout(function () {
                            window.clearInterval(selftimer);
                            setInterval('playsuccess()', 500);
                        }, 1000);
                    }
                } else if (Math.sin(f) < 0) {
                    if (f > -0.48) {
                        $('#people').attr('src', $('#people').attr('src').replace('doorman.png', 'doorman_left.png'));
                        $(".doorman").animate({
                            left: "+=" + (Math.tan(f) * 140) + "px"
                        })
                    } else {
                        movelongstep = (Math.tan(f) * 110) / 5;
                        selftimer = setInterval('playlongleft()', 150);
                        setTimeout(function () {
                            window.clearInterval(selftimer);
                            setInterval('playsuccess()', 500);
                        }, 1000);
                    }
                }
            } else {
                if (Math.sin(f) > 0) {
                    $('#people').attr('src', $('#people').attr('src').replace('doorman.png', 'doorman_left.png'));
                    $(".doorman").animate({
                        left: "-=50px"
                    })
                } else {
                    $('#people').attr('src', $('#people').attr('src').replace('doorman.png', 'doorman_right.png'));
                    $(".doorman").animate({
                        left: "+=50px"
                    })
                }
            }
        }
        function m(p, w, o, v) {
            var A = Math.abs(p - o);
            var u = Math.abs(w - v);
            var s = Math.sqrt(Math.pow(A, 2) + Math.pow(u, 2));
            var t = A / s;
            var r = Math.asin(t);
            var q = r * (180 / Math.PI);
            return q
        }
        function k() {
            var o = 0,
            p = 0,
            r = 0,
            s = 0,
            q = 0,
            u = 0,
            t = 0;
            $(".bot").on("touchstart",
            function (v) {
                v.preventDefault();
                o = v.originalEvent.changedTouches[0].pageY;
                r = parseInt($(this).css("top"))
            }).on("touchmove",
            function (w) {
                w.preventDefault();
                p = w.originalEvent.changedTouches[0].pageY;
                var v = (p - o) + r;
                if (v >= 130) {
                    v = 130
                }
                if (v <= 0) {
                    v = 0
                }
                $(this).css({
                    top: v + "px"
                })
            }).on("touchend",
            function (v) {
                p = 0
            });
            $(".zhizhen-box").on("touchstart",
            function (v) {
                v.preventDefault();
                $(".tip-qipao").hide();
                s = $(".zhizhen-box").offset().left + 85;
                q = $(".zhizhen-box").offset().top
            }).on("touchmove",
            function (w) {
                w.preventDefault();
                u = w.originalEvent.changedTouches[0].pageX;
                t = w.originalEvent.changedTouches[0].pageY;
                var v = m(s, q, u, t);
                if (u - s > 0) {
                    if (v < 30) {
                        $(this).css({
                            "-webkit-transform": "rotate(" + (v) + "deg)"
                        });
                        f = v * Math.PI / 180
                    } else {
                        $(this).css({
                            "-webkit-transform": "rotate(" + (30) + "deg)"
                        });
                        f = 30 * Math.PI / 180
                    }
                } else {
                    if (v < 30) {
                        $(this).css({
                            "-webkit-transform": "rotate(-" + (v) + "deg)"
                        });
                        f = parseFloat("-" + v * Math.PI / 180)
                    } else {
                        $(this).css({
                            "-webkit-transform": "rotate(-" + (30) + "deg)"
                        });
                        f = parseFloat("-30" * Math.PI / 180)
                    }
                }
            }).on("touchend",
            function (v) {
                s = u;
                q = t;
                $(".tip-qipao").show()
            })
        }
    }
    var d = new b();
    d.init()
});