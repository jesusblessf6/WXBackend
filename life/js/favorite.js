/**
 * Created by zengfan on 13-11-27.
 */

window.BST = {favorite: {}};

(function ($, EO) {
    var favorite = {};
    var bstStorage = {};
    $.extend(EO, {
        otherPay: favorite,
        bstStorage: bstStorage
    });

    var bstBody = $("body")
        , favoriteDiv = $("#favorite")
        , bstBodyAddr = bstBody.find("ul").find("li").find("a")
        , bstFavoriteArr = []
    //我最常用数量
        , favoriteLimit = 4
        , favoriteUl = favoriteDiv.find("ul")
        , favoriteLink
        ;


    $.extend(favorite, {
        _init: function () {

            var storageData = JSON.parse(bstStorage.getBstStorage("bstFavorite"));
            if (storageData != null) {
                bstFavoriteArr = storageData;
                if (bstFavoriteArr.length > 0) {
                    favorite.showFavorite();
                }
                favoriteLink = favoriteDiv.find('ul').find('li').find('a');
            }

            bstBodyAddr.on("click", favorite.getClickProperty);
            if(favoriteLink != undefined){
                favoriteLink.on("click", favorite.getClickProperty);
            }
        },
        getClickProperty: function () {
            var _this = $(this);
            var innerHTML = _this.attr("innerHTML");
            var dataForStorage = {name: "", imgSrc: "", href: "", count: 1};
            if (innerHTML.indexOf("img") > -1) {
                dataForStorage.name = _this.find("p").attr("innerText");
                dataForStorage.href = _this.attr("href");
                dataForStorage.imgSrc = _this.find("img").attr("src");
            } else {
                dataForStorage.name = _this.attr("innerText");
                dataForStorage.href = _this.attr("href");
                dataForStorage.imgSrc = "http://hao.uc.cn/shbst/V4/images/icons/defaulticon.png";
            }

            var isExist = false;
            for (var x = 0; x < bstFavoriteArr.length; x++) {
                if (bstFavoriteArr[x].name == dataForStorage.name) {
                    bstFavoriteArr[x].count += 1;
                    isExist = true;
                }
            }
            if (false == isExist) {
                if (bstFavoriteArr.length == favoriteLimit) {
                    bstFavoriteArr.pop();
                }
                bstFavoriteArr.push(dataForStorage);
            } else {
                bstFavoriteArr = orderArrayBy(bstFavoriteArr, 'count', 'desc');
            }
//            for (var i = 0; i < bstFavoriteArr.length; i++) {
//                console.log(bstFavoriteArr[i].name + bstFavoriteArr[i].count);
//            }
//            console.log("\n");
            bstStorage.saveBstStorage("bstFavorite", JSON.stringify(bstFavoriteArr));
            favorite.showFavorite();
        },

        showFavorite: function () {
            favoriteUl.html('');
            for (var j = 0; j < bstFavoriteArr.length; j++) {
                favoriteUl.append('<li><a href="'
                    + bstFavoriteArr[j]['href'] + '">'
                    + '<img src="' + bstFavoriteArr[j]['imgSrc'] + '"><p>'
                    + bstFavoriteArr[j]['name'] + '</p></a></li>');
            }
            favoriteDiv.show();
        }
    });

    $.extend(bstStorage, {
        rmBstStorage: function (item) {
            localStorage.removeItem(item);
        },

        getBstStorage: function (item) {
            return localStorage.getItem(item);
        },
        saveBstStorage: function (item, value) {
            localStorage.setItem(item, value);
        }
    });

    $(function () {
        favorite._init();
    });

})(Zepto, BST.favorite);

function compare(a, b) {
    if (parseInt(a) != parseInt(b)) {
        return parseInt(a) - parseInt(b);
    }
    return 0;
}
function orderArrayBy(arr, field, order) {
    var refer = [], result = [], order = order == 'asc' ? 'asc' : 'desc', index;
    for (var i = 0; i < arr.length; i++) {
        refer[i] = arr[i][field] + ':' + i;
    }
    refer.sort(compare);
    if (order == 'desc') refer.reverse();
    for (var j = 0; j < refer.length; j++) {
        index = refer[j].split(':')[1];
        result[j] = arr[index];
    }
    return result;
}