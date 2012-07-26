<style>
div.game_system
{
    background:url('../statics/game/gamesystem.png');
    width: 750px;
    height: 450px;
    display: inline-block;
}
div.user_body
{
    position:relative;
    margin: 43px 0 0 22px;
    overflow: hidden;
    width:250px;
    height:400px;
    float: left;
}
div.user_body img
{
    position: absolute;
    top: 0;
    left: 0;
    width:250px;
    height:400px;
}
div.function_body
{
    /* outline: 1px solid black; */
    width: 407px;
    height: 373px;
    margin: 54px 0 0 29px;
    float: left;
}
ul.game-button
{
    height: 31px;
    padding: 0;
    margin: 0;
    display: block;
}
ul.game-button li
{
    width: 80px;
    height: 31px;
    display: block;
    /* outline: 1px solid red; */
    float: left;
    margin-right: 1px;
    font-family:微軟正黑體;
    font-size: 24px;
    text-align:center;
}
div.game-display
{
    width: 378px;
    height: 312px;
    /* outline: 1px solid blue; */
    margin: 15px 0 0 15px;
    overflow-y:hidden;  
}


</style>

<?php $watch_id = Yii::app()->user->getId() //正在觀看頁面的id ?>

<div class="game_system">
    <div class="user_body">
    <?php 
        //////////////////// 暫時圖片變數名稱
        $skin = 'boyC1.png';
        $eyes = 'e9.png';
        $hair = 'hairN5.png';
        $shoes = 'shoeN5.png';
        $cloths = 'clothseN4.png';
        $pants = 'pantsN3.png';
    ?>
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/skin/<?php echo $skin;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/eyes/<?php echo $eyes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/hair/<?php echo $hair;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/shoes/<?php echo $shoes;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/pants/<?php echo $pants;?>" >
    <img src="<?php echo Yii::app()->baseUrl; ?>/statics/game/cloths/<?php echo $cloths;?>" >
    </div>
    <div class="function_body">
        <ul class="game-button">
<?php if($watch_id!=$user_id) 
{
    echo '<li><a style="color:#787878">任務</a></li>';
    echo '<li><a style="color:#38077a"><b>成就</b></a></li>';
    echo '<li><a style="color:#38077a"><b>道具</b></a></li>';
    echo '<li><a style="color:#787878">商城</a></li>';
    echo '<li><a style="color:#38077a"><b>惡搞</b></a></li>';
} 
else
{
    echo '<li><a style="color:#38077a"><b>任務</b></a></li>';
    echo '<li><a style="color:#38077a"><b>成就</b></a></li>';
    echo '<li><a style="color:#38077a"><b>道具</b></a></li>';
    echo '<li><a style="color:#38077a"><b>商城</b></a></li>';
    echo '<li><a style="color:#38077a"><b>惡搞</b></a></li>';
}?>
        </ul>
        <div class="game-display">

            <h1>目前使用者ID => <?php echo $watch_id?> </h1>
            <h1>觀看使用者ID => <?php echo $user_id;?></h1>
            <h1>acasc</h1>
                        <h1>a</h1>
                                    <h1>acasc</h1>
                                                <h1>t</h1>
                                                            <h1>t</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>
                                                            <h1>acasc</h1>

        </div>
    </div>
</div>

