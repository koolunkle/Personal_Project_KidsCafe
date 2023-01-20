<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>The Mirae Kids Cafe</title>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/common.css">
    <link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/css/amusement.css">
</head>

<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/header.php" ?>
    </header>

    <section>
        <!-- set aside -->
        <aside>
            <h3>Amusement</h3>

            <ul>
                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/amusement/amusement_mystery_house.php">
                        The Mystery House
                    </a>
                </li>

                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/amusement/amusement_island.php">
                        The Island
                    </a>
                </li>

                <li>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/project/amusement/amusement_garden.php">
                        The Garden
                    </a>
                </li>
            </ul>
        </aside>

        <!-- set main -->
        <main>
            <!-- set title -->
            <h2>The Island</h2>
            <hr>

            <!-- set banner -->
            <img src="http://<?= $_SERVER['HTTP_HOST']; ?>/project/image/main_banner_2.jpg" alt="main_banner_2">
            <hr>

            <div id="amusement_content_first">
                <ul>
                    <li>
                        <p>설명</p>
                    </li>

                    <li>역동적인 공간 속에서 직접 배우고 체험하는 어트랙션!</li>
                    <li>더 아일랜드에서 사랑하는 우리 아이들에게 다양한 경험을 선사해 주세요</li>
                    <br>

                    <li>아이들이 맛있는 바비큐 파티와 재미있는 게임을 즐기며<br>충분히 휴식할 수 있는 글램핑 체험 활동입니다</li>
                    <br>

                    <li>
                        <p>효과</p>
                    </li>

                    <li>관찰력, 탐구력, 문제해결능력 발달</li>
                </ul>
            </div>
            <hr><br>

            <div id="amusement_content_second">
                <h3>이용 안내</h3>

                <ul>
                    <li>
                        영유아는 보호자의 동반하에 놀이를 마칠 때까지 보호 및 관찰을 받아야만 합니다
                    </li>
                    <br>

                    <li>
                        놀이에 부적합한 끈이 달린 옷 또는 슬리퍼 등을 착용하거나<br>
                        책가방, 장난감 등을 소지한 채 놀이기구를 이용하지 않습니다
                    </li>
                    <br>

                    <li>
                        난간과 밧줄이 있는 놀이기구는 항상 두손으로 잡고 이용합니다
                    </li>
                    <br>

                    <li>
                        놀이시설에 위험한 물건이 있거나 위험한 상태로 되었을 때 또는<br>
                        다친 사람이 발생하였을 때 놀이를 중단하고 즉시 도움을 요청합니다
                    </li>
                    <br>

                    <li>
                        놀이기구를 소중히 이용하며, 낙서하거나 부착물을 훼손하지 않습니다
                    </li>
                    <br>

                    <li>
                        놀이기구는 차례대로 이용하고, 사용 인원을 초과하여 사용하지 않습니다
                    </li>
                </ul>
            </div>
        </main>
    </section>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/project/footer.php" ?>
    </footer>
</body>

</html>