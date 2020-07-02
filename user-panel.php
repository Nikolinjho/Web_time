<?php
session_start();
if (parse_url($_SERVER["HTTP_REFERER"])["host"] !== $_SERVER["SERVER_NAME"])
    die();
require "./php/deleteAndCheck.php";
?>

<div class="content bg-abs">
    <div class="user-panel">
        <div class="exit-block">
            <div class="exit-block__btn"></div>
        </div>
        <div class="weather-msg">+4 в Москве, возможно осадки</div>
        <div class="user-panel__title">
            <?php
                $time = intval(date("H"));
                if ($time >= 0  && $time < 12) {
                    echo "Доброе утро,";
                } else {
                    if ($time >= 12  && $time < 18) {
                        echo "Добрый день,";
                    } else {
                        echo "Добрый вечер,";
                    }
                }
            ?>
            <span class="username"><?= $_POST["user"]["name"] ?></span>
        </div>
        <div class="user-panel__info">
            <div class="user-panel__info-title">
                Приход
            </div>
            <div class="user-panel__info-block bem-notify">
                <div class="time">09:30</div>
                <div class="info stat-down">на 30 минут позже, чем обычно</div>
            </div>
            <div class="user-panel__notify">
                <div class="user-panel__notify-title">Новые сообщения:</div>
                <div class="notify-block bem-notify">
                    <div class="notify-block__title">
                        Напоминание
                    </div>
                    <div class="notify-block__msg">
                        Сегодня у вас совещание в 14:50.
                        Не забудьте подготовить презентацию!
                    </div>
                </div>
                <div class="notify-block bem-notify">
                    <div class="notify-block__title">
                        Administrator
                    </div>
                    <div class="notify-block__msg">
                        Внимание! Сейчас едут из ФАС.
                        Всем нелегалам срочно на выход!
                    </div>
                </div>

                <div class="preloader">
                    Показать больше
                </div>
            </div>
        </div>
    </div>
    <div class="timer">
        <div class="timer__circle">
            <svg class="progress" width="764" height="764" viewBox="0 0 764 764">
                <circle class="progress__meter" r="378" stroke-width="6" />
                <circle class="progress__value" r="378" stroke-width="6" />
            </svg>
            <div class="timer__date">Суббота, 18 марта</div>
            <?php
                include_once "./php/connection.php";                
                $name = $_SESSION['login'];
                $checkDate = pdo()->prepare("SELECT * FROM ".$name." WHERE date = :date");
                $checkDate->bindParam(':date', date("Y-m-d"));                
                $checkDate->execute();   
                if (!$checkDate->rowCount()) { 
                    $text = "true";
                    $time = pdo()->prepare("SELECT * FROM ".$name." WHERE arrive = :bool");
                    $time->bindParam(':bool', $text);                
                    $time->execute();     
                    if ($time->rowCount()) {
                        $time = $time->fetch(); 
                        $arrivalTime = $time["arrivalTime"];
                        $date = $time["date"];            
                        $seconds = strtotime(date("H:i:s")) - strtotime($arrivalTime);
                        $_SESSION["seconds"] = $seconds;
                            
                
                        ?>
                        <div class="timer__clock timer__time">...</div>
                        <button class="timer__btn bem-leave leave red">
                                Отметить уход
                            </button>
                        <?php
                } else {
                    ?>
                      <div class="timer__clock timer__time">...</div>
                    <button class="timer__btn arrive green" >
                        Отметить приход
                    </button>
                    <button class="timer__btn bem-leave leave red" style="display: none;">
                        Отметить уход
                    </button>
                    <?php
                }
            } else {        ?>

                <div class="timer__clock timer__time">...</div>
            <?php   }       ?>
          



        </div>
    </div>
    <!-- <div class="bg-user"></div> -->
</div>
<?php
include_once("./php/scripts.php");
?>