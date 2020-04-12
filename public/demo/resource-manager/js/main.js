var MENU_WIDTH = 300 + 15;
var BASE_WIDTH = 20 + 20;
var resourceList = [];
var currentPath = [];

var vm = new Vue({
    el: '#app',
    data: {
        resourceList: resourceList,
        currentPath: currentPath,
    },
    methods: {
        changeDir: function (resourceIndex, menu) {
            if (currentPath && currentPath.length && currentPath[currentPath.length-1].id == menu.id) {
                return ;
            }
            currentPath.length = resourceIndex;
            currentPath.push({
                id: menu.id,
                name: menu.name,
                resourceIndex: resourceIndex,
            });
            resourceList.length = resourceIndex + 1;
            vm.loadDir(resourceIndex);
        },
        loadDir: function (resourceIndex) {
            $.ajax({
                url:'listdir.php',
                method: 'POST',
                data: {path: currentPath.map(function (value) { return value.name; })},
                success:function(result){
                    if (result && result.length) {
                        resourceList.push(result);
                        var panelWidth = (resourceIndex + 2) * MENU_WIDTH - 15;
                        $("#app").width(panelWidth);
                        $("html").scrollLeft(panelWidth - $("body").width() + BASE_WIDTH);
                        $("body").scrollLeft(panelWidth - $("body").width() + BASE_WIDTH);
                    }
                }
            });
        }
    }
});

vm.loadDir(0);
