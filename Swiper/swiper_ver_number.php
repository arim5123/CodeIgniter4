<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>swiper</title>
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="/bootstrap/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <style>
        .swiper-pagination-bullet {
            display: inline-block !important;
            width: 55px;
            height: 55px;
            text-align: center;
            line-height: 55px;
            font-size: 35px;
            color: #000;
            opacity: 1;
            background: rgba(0, 0, 0, 0.2);
            margin: 0 20px !important;
        }

        .swiper-pagination-bullet-active {
            color: #fff;
            background: #007aff;
        }
        ::-webkit-scrollbar-track {
            background: none !important;
        }
        ::-webkit-scrollbar-thumb {
            background: none !important;
        }
    </style>
</head>

<body>
<div id="Wrap">
    <div class="com_view" style="height: 2190px;">
        <div class="swiper-container" style="width: 100%; height: 100%">
            <div class="swiper-wrapper" style="width: 100%; height: 2070px;">
                <?php foreach ($post_list as $fm) : ?>
                    <div class="swiper-slide">
                      <img src="/img/company/<?= $company ?>/files/<?= $fm['file_name'] ?>" width="1433px;" height="2070px;"/>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script>
            var mySwiper = new Swiper('.swiper-container', {
                slidesPerView: 1, //슬라이드를 한번에 1개를 보여준다
                spaceBetween: 10, //슬라이드간 padding 값 30px 씩 떨어뜨려줌
                loop: true, //loop 를 true 로 할경우 무한반복 슬라이드 false 로 할경우 슬라이드의 끝에서 더보여지지 않음
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + '">' + (index + 1) + "</span>";
                    },
                },
            });
        </script>
    </div>
</div>
</body>
</html>
