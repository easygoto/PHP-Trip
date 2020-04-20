<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="UTF-8" />
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"
      name="viewport"
    />
    <title>微信朋友圈</title>
    <link rel="stylesheet" href="/assets/css/moments/style.css" />
  </head>
  <body>
    <div id="moments-app" v-cloak>
      <header>
        <div class="moments-bg">
          <img :src="setting.bg_image" alt="" />
        </div>
        <div class="avatar">
          <img :src="setting.avatar" alt="" />
        </div>
        <div class="username">
          {{setting.nickname}}
        </div>
        <div class="sign">
          {{setting.custom_sign}}
        </div>
      </header>
      <main>
        <div class="news" v-for="news in newsList">
          <div class="time-line">
            <div class="day">{{news.day}}</div>
            <div class="month">{{news.month}}</div>
          </div>
          <div class="content">
            <div class="context-container">{{news.content}}</div>
            <div class="picture-container">
              <div
                :class="news.images.length > 4 ? 'num-5-9' : (news.images.length > 1 ? 'num-2-4' : 'num-1-1')"
                class="picture-block"
                v-for="image in news.images"
                @click="viewImage(image)"
              >
                <img :src="image" alt="" />
              </div>
            </div>
          </div>
        </div>
      </main>
      <footer>
        <div class="load-more">
          <a v-if="loading" href="javascript:void(0);">加载中...</a>
          <a v-else-if="loadDone" href="javascript:void(0);" class="done"
            >已加载完</a
          >
          <a v-else href="javascript:void(0);" @click="getNewsList()"
            >点击加载更多</a
          >
        </div>
      </footer>
      <div v-show="showImage" class="shade" @click="hideImage()">
        <img :src="curImage" alt="" />
      </div>
    </div>
  </body>
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.js"></script>
  <script>
    const API_DOMAIN = "http://make.trink.com/api/demo/";
  </script>
  <script src="/assets/js/moments/main.js"></script>
</html>
