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
    outline: 1px solid blue;
    margin: 15px 0 0 15px;
    overflow-y:hidden;  
}


</style>
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
    <img src="../statics/game/skin/<?php echo $skin;?>" >
    <img src="../statics/game/eyes/<?php echo $eyes;?>" >
    <img src="../statics/game/hair/<?php echo $hair;?>" >
    <img src="../statics/game/shoes/<?php echo $shoes;?>" >
    <img src="../statics/game/cloths/<?php echo $cloths;?>" >
    <img src="../statics/game/pants/<?php echo $pants;?>" >
    </div>
    <div class="function_body">
        <ul class="game-button">
            <li url="123.html">任務</p></li>
            <li>成就</li>
            <li>道具</li>
            <li>商城</li>
            <li>惡搞</li>
        </ul>
        <div class="game-display">
            <h1>目前使用者ID => <?php echo Yii::app()->user->getId()?> </h1>
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

