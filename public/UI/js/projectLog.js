"use strict";
layui.use(["okUtils", "table", "countUp", "okMock", 'okTab', 'table', 'siamConfig', 'okLayer', 'form'], function () {
    var countUp = layui.countUp;
    var table = layui.table;
    var okUtils = layui.okUtils;
    var okMock = layui.okMock;
    var $ = layui.jquery;
    var okTab = layui.okTab();
    var table = layui.table;
    var siamConfig = layui.siamConfig;
    var okLayer = layui.okLayer;
    var form = layui.form;


    var id = getUrlParam("id");
    var name = decodeURI(getUrlParam("name"));

    $("#project-title").html("日志查询 - " + name);

    let backUrl = `projectDetail.html?id=${id}&name=${name}`;

    $("#backBtn").click(function () {
        window.location.href = backUrl;
        return false;
    });

    form.on("submit(logs)", function(data){
        if (data.field.log_sn.length === 0){
            layer.msg("请填写标识");return false;
        }
        okUtils.ajax("/api/logs/query", "post", {
            project_id: id,
            log_sn: data.field.log_sn
        }, true).done(function (res) {
            // 渲染响应结果
            if (res.data.length<=0){
                layer.alert("查询不到该单号结果");
            }else{
                $.each(res.data, function (idenx, item) {
                    console.log(item);
                })
            }
        }).fail(function (error) {
            console.log(error);
        });
        return false;
    });



});
