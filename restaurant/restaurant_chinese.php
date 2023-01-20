<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/restaurant.css">
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- set aside -->
        <aside>
            <h3>Restaurant</h3>

            <ul>
                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/restaurant/restaurant_korean.php">
                        Korean
                    </a>
                </li>

                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/restaurant/restaurant_chinese.php">
                        Chinese
                    </a>
                </li>

                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/restaurant/restaurant_japanese.php">
                        Japanese
                    </a>
                </li>
            </ul>
        </aside>

        <!-- set main -->
        <main>
            <!-- set title -->
            <h2>Chinese</h2>
            <hr>

            <!-- set banner -->
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/restaurant_chinese.jpg"
                alt="restaurant_chinese">
            <hr>

            <div id="amusement_content_first">
                <ul>
                    <li>
                        <p>설명</p>
                    </li>

                    <li>더 미래 키즈 카페는 맛있고 건강한 식사를 추구합니다</li>

                    <li>제철 및 친환경 인증 식재료를 활용하고 장인의 손끝으로 완성한
                        <br>
                        다채롭고 개성 있는 중식의 향연을 느껴보세요
                    </li>
                </ul>
            </div>
            <hr><br>

            <div id="amusement_content_second">
                <ul>
                    <li>
                        <p>위치</p>
                    </li>

                    <li>더 미래 키즈 카페 4층</li>
                    <br>

                    <li>
                        <p>예약 및 문의</p>
                    </li>

                    <li>02-2299-9920</li>
                    <br>

                    <li>
                        <p>좌석 수</p>
                    </li>

                    <li>150석</li>

                    <li>* 예약 손님 우선 입장 후 상황에 따라 워크인으로 입장합니다</li>
                    <br>

                    <li>
                        <p>주차 안내</p>
                    </li>

                    <li>레스토랑 이용 시 3시간당 3,000원</li>
                    <li>* 주차장 만차 시 인근 외부 주차장 이용 가능합니다</li>
                </ul>
            </div>
        </main>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>