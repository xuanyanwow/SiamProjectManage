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

    $("#project-title").html("API统计 - " + name);

    let backUrl = `projectDetail.html?id=${id}&name=${name}`;

    $("#backBtn").click(function(){
        window.location.href = backUrl;
        return false;
    })
});
