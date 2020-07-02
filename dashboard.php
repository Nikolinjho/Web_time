<?php
if (parse_url($_SERVER["HTTP_REFERER"])["host"] !== $_SERVER["SERVER_NAME"])
    die();
?>


<div class="content bg-abs">
    <div class="admin-panel">
        <div class="exit-block">
            <div class="exit-block__btn"></div>
        </div>
        <div class="admin-panel__title">
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
            <span class="adminname"> <?= $_POST["user"]["name"] ?></span>
        </div>
        <div class="admin-panel__menu">
            <div class="admin-panel__menu-item active-item">
                Статистика
            </div>
            <div class="admin-panel__menu-item">
                Почта
            </div>
            <div class="admin-panel__menu-item">
                Настройки
            </div>
        </div>
        <div class="admin-panel__message">
            <div class="admin-panel__message-title">
                <div class="admin-panel__message-input  bem-notify">

                    <textarea type="text" placeholder="Введите текст для сообщения"></textarea>
                    <a class="send">Отправить всем</a>
                </div>
            </div>
        </div>
    </div>
    <div class="features">

        <div class="features__title">Статистика</div>
        <div class="statistics margin">
            <div class="statistics__header">
                <div class="statistics__header-item active-item" data-tab="1">Сегодня</div>
                <div class="statistics__header-item" data-tab="2">Вчера</div>
            </div>
            <?php 
            
            include_once "./php/connection.php";

           
            $user = pdo()->prepare("SELECT * FROM user_table Where User_login != :lgn");                // get user logins
            $user->bindParam(':lgn', $_POST["user"]["name"], PDO::PARAM_STR);
            $user->execute();

            if ($user->rowCount()) {
                $user = $user->fetchAll();
            
            }

            ?>
            <div class="statistics__grid statistics__grid-block" data-tab="1">
               
                <?php 
         
            foreach ($user as $variable) {                                                              // get data from user login's table
                // $time = pdo()->prepare("SELECT * FROM ".$variable["User_login"]."");
                $time = pdo()->prepare("SELECT * FROM ".$variable["User_login"]." Where date = :today");
                $time->bindParam(':today', date("Y-m-d"));
                $time->execute();
                if ($time->rowCount()){
                    $time = $time->fetchAll();

                    ?>
                <div class="flex-wrapper">
                    <div class="statistics__item ">
                        <div class="statistics__item-block ">
                            <div class="statistics__item-title"><?=$variable['User_name']." ". $variable['User_surname'];?></div>
                            <div class="toggle-btn"></div>
                        </div>

                        <div class="hided">
                            <div class="statistics__item-event">
                                <div class="statistics__item-event__title arrive">Приход</div>
                                <div class="statistics__item-event__info">
                                    <div class="time"><?=$time[0]['arrivalTime'];?></div>
                                    <div class="stat">на 30 минут позже,
                                        чем обычно</div>
                                </div>
                            </div>
                            <div class="statistics__item-event">
                                <div class="statistics__item-event__title exit">Уход </div>
                                <div class="statistics__item-event__info">
                                    <div class="time"><?=$time[0]['leavingTime'];?></div>
                                    <div class="stat">на 30 минут позже,
                                        чем обычно</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    <?php
                }
            }
        
            
            ?>
           
    

            </div>


            <div class="statistics__grid" data-tab="2">
                
                <?php 
         
            foreach ($user as $variable) {           
                                                             // get data from user login's table
                // $time = pdo()->prepare("SELECT * FROM ".$variable["User_login"]."");
                $yesTime = pdo()->prepare("SELECT * FROM ".$variable["User_login"]." Where date = :yestoday");
                $yesTime->bindParam(':yestoday', date("Y-m-d",strtotime("-1 days")));
                $yesTime->execute();
                if ($yesTime->rowCount()){
                    $yesTime = $yesTime->fetchAll();
                    ?>
                    <div class="flex-wrapper">
                    <div class="statistics__item ">
                        <div class="statistics__item-block ">
                            <div class="statistics__item-title"><?=$variable['User_name']." ". $variable['User_surname'];?></div>
                            <div class="toggle-btn"></div>
                        </div>

                        <div class="hided">
                            <div class="statistics__item-event">
                                <div class="statistics__item-event__title arrive">Приход</div>
                                <div class="statistics__item-event__info">
                                    <div class="time"><?=$yesTime[0]['arrivalTime'];?></div>
                                    <div class="stat">на 30 минут позже,
                                        чем обычно</div>
                                </div>
                            </div>
                            <div class="statistics__item-event">
                                <div class="statistics__item-event__title exit">Уход </div>
                                <div class="statistics__item-event__info">
                                    <div class="time"><?=$yesTime[0]['leavingTime'];?></div>
                                    <div class="stat">на 30 минут позже,
                                        чем обычно</div>
                                </div>
                            </div>

                        </div>
                    </div>
        </div>
                    <?php
                }
            }
        
            
            ?>
            </div>
        </div>
    </div>

</div>
<?php
include_once("./php/scripts.php");
?>