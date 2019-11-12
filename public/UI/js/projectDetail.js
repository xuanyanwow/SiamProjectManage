"use strict";
layui.use(["okUtils", "table", "countUp", "okMock", 'okTab'], function () {
    var countUp = layui.countUp;
    var table = layui.table;
    var okUtils = layui.okUtils;
    var okMock = layui.okMock;
    var $ = layui.jquery;
    var okTab = layui.okTab();


    var id   = getUrlParam("id");
    var name = decodeURI(getUrlParam("name"));

    $("#project-title").html("项目详情 - " + name);
});



function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURI(r[2]); return null;
}