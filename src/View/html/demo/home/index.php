<?php

use Trink\Frame\View\Asset;

?>

<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Title</title>
    <?= Asset::load(Asset::RS['bs4.css']); ?>
    <link rel="stylesheet" type="text/css" href="/assets/css/common/init.css" />
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button
          class="navbar-toggler d-lg-none"
          type="button"
          data-toggle="collapse"
          data-target="#collapsibleNavId"
          aria-controls="collapsibleNavId"
          aria-expanded="false"
          aria-label="Toggle navigation"
        ></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="dropdownId"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                >Dropdown</a
              >
              <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="#">Action 1</a>
                <a class="dropdown-item" href="#">Action 2</a>
              </div>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <label>
              <input
                class="form-control mr-sm-2"
                type="text"
                placeholder="Search"
              />
            </label>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
              Search
            </button>
          </form>
        </div>
      </nav>
    </header>

    <div class="dropdown">
      <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        id="triggerId"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        Dropdown
      </button>
      <div class="dropdown-menu" aria-labelledby="triggerId">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item disabled" href="#">Disabled action</a>
        <h6 class="dropdown-header">Section header</h6>
        <a class="dropdown-item" href="#">Action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">After divider action</a>
      </div>
      <div></div>
    </div>

    <h1>模板文件</h1>

    <main>
      <div>
        <img src="/assets/images/icons/alarm-fill.svg" alt="" />
      </div>
    </main>
    <?= Asset::load(Asset::RS['jq3.js'])?>
    <?= Asset::load(Asset::RS['pop.js'])?>
    <?= Asset::load(Asset::RS['bs4.js'])?>
    <?= Asset::load(Asset::RS['vue.js'])?>
  </body>
</html>
