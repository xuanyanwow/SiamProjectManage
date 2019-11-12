"use strict";
layui.use(["okUtils", "table", "countUp", "okMock"], function () {
    var countUp = layui.countUp;
    var table = layui.table;
    var okUtils = layui.okUtils;
    var okMock = layui.okMock;
    var $ = layui.jquery;


    function renderList() {
        okUtils.ajax("/api/project/get_list", "get", null, true).done(function (response) {
            $("#list-bd").empty();
            $.each(response.data.list, function (index, item) {
                let html = `
                    <div class="layui-col-xs6 layui-col-md3">
                        <div class="layui-card">
                            <div class="ok-card-body project-one" data-id="${item.id}">
                                <div class="stat-heading">
                                    ${item.name}
                                    <span style="display:inline-block;float:right;" class="project-delete" data-id="${item.id}">删除</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $("#list-bd").append(html);
            });
        }).fail(function (error) {
            console.log(error);
        });
    }

    $("#list-bd").on("click", ".project-one", function(){
        alert($(this).data('id'));
    })

    $("#list-bd").on("click", ".project-delete", function(){
        alert("删除" + $(this).data('id'));
        event.stopPropagation();
        return false; // 终止冒泡
    })


    renderList();
});


