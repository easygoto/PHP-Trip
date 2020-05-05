$(function () {
    let graph = $("rect");
    let panel = $("svg");

    let svgSettingList = [
        {
            name: "画布宽度",
            proto: "width",
            ctrlType: "range",
            txtType: "number",
            value: 1500,
        },
        {
            name: "画布高度",
            proto: "height",
            ctrlType: "range",
            txtType: "number",
            value: 700,
        },
    ];
    svgSettingList.map(function (setting, index) {
        $("div.panel-body.svg-setting").addStyleControl(panel, setting);
    });

    let graphSettingList = [
        {
            name: "宽度",
            proto: "width",
            ctrlType: "range",
            txtType: "number",
            value: 100,
        },
        {
            name: "高度",
            proto: "height",
            ctrlType: "range",
            txtType: "number",
            value: 100,
        },
        {
            name: "弧度x",
            proto: "rx",
            ctrlType: "range",
            txtType: "number",
            value: 10,
        },
        {
            name: "弧度y",
            proto: "ry",
            ctrlType: "range",
            txtType: "number",
            value: 10,
        },
        {
            name: "位移x",
            proto: "x",
            ctrlType: "range",
            txtType: "number",
            value: 100,
        },
        {
            name: "位移y",
            proto: "y",
            ctrlType: "range",
            txtType: "number",
            value: 100,
        },
        {
            name: "边框大小",
            proto: "stroke-width",
            ctrlType: "range",
            txtType: "number",
            value: 3,
        },
        {
            name: "边框色",
            proto: "stroke",
            ctrlType: "color",
            txtType: "text",
            value: "#407434",
        },
        {
            name: "背景色",
            proto: "fill",
            ctrlType: "color",
            txtType: "text",
            value: "#ffd700",
        },
    ];
    graphSettingList.map(function (setting, index) {
        $("div.panel-body.graph-setting").addStyleControl(graph, setting);
    });

    graph.initMove(panel);
});
