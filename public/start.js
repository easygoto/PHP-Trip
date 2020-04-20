const http = require("http");
const fs = require("fs");

let documentRoot = "./";

http
  .createServer(function (req, res) {
    let url = new URL("http://" + req.headers.host + req.url).pathname;
    let file = documentRoot + url;
    console.log(url);

    fs.readFile(file, function (err, data) {
      if (err) {
        res.writeHead(404, {
          "content-type": 'text/html;charset="utf-8"',
        });
        res.write("<h1>404错误</h1><p>你要找的页面不存在</p>");
        res.end();
      } else {
        res.write(data);
        res.end();
      }
    });
  })
  .listen(8808);

console.log("server start on http://127.0.0.1:8808");
