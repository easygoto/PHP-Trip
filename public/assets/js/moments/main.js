window.onload = function () {
    let vm = new Vue({
        el: "#moments-app",
        data: {
            setting: {},
            newsList: [],
            page: 1,
            loading: false,
            loadDone: false,
            showImage: false,
            curImage: "",
        },
        methods: {
            reviseHeight() {
                Array.from(document.querySelectorAll(".picture-container>.picture-block")).map(function (dom) {
                    dom.style.height = dom.offsetWidth + "px";
                });

                let momentsBg = document.querySelector("header>.moments-bg");
                momentsBg.style.height = momentsBg.offsetWidth * 0.8 + "px";
            },
            getSetting() {
                axios.get(API_DOMAIN + "home/moments-setting").then(function (response) {
                    let result = response.data;
                    if (result.hasOwnProperty("status") && result.status === 0) {
                        vm.$data.setting = result.data;
                    }
                });
            },
            getNewsList() {
                vm.$data.loading = true;
                axios.get(API_DOMAIN + "home/moments-news", {}).then(function (response) {
                    let result = response.data;
                    if (result.hasOwnProperty("status") && result.status === 0) {
                        vm.$data.newsList = vm.$data.newsList.concat(result.data);
                        if (result.data.length < 10) {
                            vm.$data.loadDone = true;
                        }
                        vm.$data.page++;
                        vm.$data.loading = false;
                    }
                });
            },
            viewImage(image) {
                console.log(image);
                vm.$data.curImage = image;
                vm.$data.showImage = true;
            },
            hideImage() {
                vm.$data.curImage = "";
                vm.$data.showImage = false;
            },
            init() {
                this.getSetting();
                this.getNewsList();
            },
        },
        watch: {
            newsList: function () {
                this.$nextTick(function () {
                    vm.reviseHeight();
                });
            },
        },
    });
    vm.init();
};
