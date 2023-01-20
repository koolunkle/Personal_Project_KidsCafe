<!-- set image or slide show -->
<div class="slideshow">
    <div class="slideshow_slides">
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_banner_1.jpg" alt="main_banner_1">
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_banner_2.jpg" alt="main_banner_2">
        <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_banner_3.jpg" alt="main_banner_3">
    </div>

    <div class="slideshow_nav">
        <a href="#" class="previous">
            <i class="fa-solid fa-circle-chevron-left"></i>
        </a>

        <a href="#" class="next">
            <i class="fa-solid fa-circle-chevron-right"></i>
        </a>
    </div>

    <div class="slideshow_indicator">
        <a href="#" class="active"><i class="fa-solid fa-circle"></i></a>
        <a href="#"><i class="fa-solid fa-circle"></i></a>
        <a href="#"><i class="fa-solid fa-circle"></i></a>
    </div>
</div>

<!-- set introduce  -->
<h4 id="introduce_title">Welcome to<br>The Mirae Kids Cafe</h4>

<div id="introduce_content">
    <ul>
        <li>
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_introduce_1.jpg" alt="main_introduce_1">
            <p class="introduce_content_title">About Us</p>
            더 미래 키즈 카페는 최고급 놀이시설과<br>레스토랑을 갖춘 키즈카페입니다
        </li>

        <li>
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_introduce_2.jpg" alt="main_introduce_2">
            <p class="introduce_content_title">Amusement</p>
            더 미래 키즈 카페는 아이들이 흥미를 가질 수 있도록<br>놀이시설을 창의적으로 배치하였습니다
        </li>

        <li>
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_introduce_3.jpg" alt="main_introduce_3">
            <p class="introduce_content_title">Restaurant</p>
            더 미래 키즈 카페는 맛과 재료의 질은 보장하면서<br>합리적인 가격을 갖춘 레스토랑이 준비되어 있습니다
        </li>
    </ul>
</div>

<!-- set best review -->
<h4 id="best_review_title">Best Review</h4>

<div id="best_review_content">
    <ul>
        <?php
        $sql_select = "select * from image_post where hit >= 5 order by num desc limit 3";
        $result = mysqli_query($connect, $sql_select);

        if (!$result)
            echo "table not created or post does not exist";
        else {
            while ($row = mysqli_fetch_array($result)) {
                $regist_day = substr($row['regist_day'], 0, 10);
                ?>
        <li>
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/data/<?= $row['file_copied'] ?>">

            <p id=" best_review_content_subject">
                <?= $row['subject'] ?>
            </p>

            <p class="best_review_content_list">
                <?= $row['name'] ?>
            </p>

            <p class="best_review_content_list">
                <?= $regist_day ?>
            </p>
        </li>
        <?php }
        }
        mysqli_close($connect);
        ?>
    </ul>
</div>

<div id="total">
    <div id="info_using_content">
        <h4 class="total_title">Information Using</h4>

        <ul>
            <li>
                월요일 ~ 목요일 - 10:00 ~ 20:00
            </li>

            <li>
                금요일 ~ 일요일(공휴일) - 10:00 ~ 21:00
            </li>

            <li>
                * 연중 무휴로 운영합니다
            </li>

            <li>
                * 운영 시간은 키즈 카페 사정에 따라 변동될 수 있습니다
            </li>

            <li>
                * 원활한 운영을 위해 입장을 제한할 수 있습니다
            </li>
        </ul>
    </div>

    <div id="admission_fee_content">
        <h4 class="total_title">Admission Fee</h4>

        <ul>
            <li>
                성인 (만 19세 이상) - 5,000원
            </li>

            <li>
                어린이 (24개월 이상) - 20,000원
            </li>

            <li>
                유아 (13개월 이상 ~ 24개월 미만) - 10,000원
            </li>

            <li>
                영아 (12개월 이하) - 5,000원
            </li>

            <li>
                * 3시간 초과 이용 시 5,000원의 추가 요금이 발생합니다
            </li>
        </ul>
    </div>

    <div id="location_content">
        <h4 class="total_title">Location</h4>

        <ul>
            <li>
                지번 - 서울특별시 성동구 행당동 286-5 한동타워
            </li>

            <li>
                도로명 주소 - 서울특별시 성동구 왕십리로 315(행당동)
            </li>

            <li>
                지하철 - 왕십리역 11번 출구 하차 후 도보 1분
            </li>

            <li>
                버스 - 왕십리역(04135) 463, 2016, 4211
            </li>

            <li>
                * 키즈 카페 입장 또는 결제 시 주차 차량 번호 등록이 필요합니다
            </li>
        </ul>
    </div>
</div>