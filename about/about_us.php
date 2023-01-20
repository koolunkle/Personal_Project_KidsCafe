<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/about.css">
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <div id="about_content_first">
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_introduce_1.jpg" alt="main_introduce_1">
            <ul>
                <li>
                    더 미래 키즈 카페
                    <br>
                    The Mirae Kids Cafe
                </li>

                <li>
                    더 미래 키즈 카페는 최고급 놀이시설과 레스토랑을 갖춘 키즈카페입니다
                </li>

                <li>
                    더 미래 키즈 카페는 창의적인 설계를 통해 아이들의 즐거움을 추구하였습니다
                    <br>
                    상상력이 넘치는 공간 속에서 부모는 사랑하는 아이의 행복한 모습을 바라보며
                    <br>
                    당사가 제공하는 최고의 레스토랑을 누리실 수 있습니다
                </li>

                <li>
                    더 미래 키즈 카페는 최고의 서비스를 제공하기 위해 최선을 다하겠습니다
                </li>
            </ul>
        </div>
        <hr>

        <div id="about_content_second">
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_introduce_2.jpg" alt="main_introduce_2">

            <ul>
                <li>
                    더 미래 키즈 카페의 가치관
                    <br>
                    The Mirae Kids Cafe's Values
                </li>

                <li>더 미래 키즈 카페는 행복한 부모에게서 건강한 아이가 나옴을 믿습니다</li>

                <li>
                    더 미래 키즈 카페는 아이들만이 아닌 부모의 행복에도 큰 관심을 가졌습니다
                    <br>
                    사랑하는 아이들에게 즐거운 시간을 제공함과 동시에 부모에게도
                    <br>
                    행복하고 여유로운 순간을 선사하고자 합니다
                </li>

                <li>
                    더 미래 키즈 카페는 부모와 아이 모두가 행복한 공간을 꿈꿉니다
                </li>
            </ul>
        </div>
    </section>

    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>