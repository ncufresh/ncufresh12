<?php

class MultimediaController extends Controller
{
    private $_introductions = array(
        'jor7-ba6B00' => '中大校門正向日出升起，筆墨紙硯迎接了第一道曙光，象徵每一天將繪出不一樣的精彩。縱使錯過了晨曦，夜晚整個市區的七彩霓虹更為這美好一天畫下完美句點。是結束，是開始，黑白的筆墨譜出彩色的畫作，這就是中央!',
        'xTUvMq258oE' => '大講堂對中央大學的學生來說，是一個良師益友。它可說是人文藝術的殿堂。不但是社團成發，大一週會的舉辦地點。也是收藏著校史紀錄的重要場所。由此可見，大講堂跟我們的關係可說是密不可分。黑盒子，是中央大學裡的劇場天堂。常會定期舉辦劇場的表演，更可助益於中央大學的戲曲研究。五花八門的表演豐富了師生們的氣質，更幫助我們提升學問，增廣見聞。雖然黑盒子才剛興建不久，但想必會增添學校更多的色彩。',
        'unwH3YkSx34' => '這棟造型明亮，外形像白色盒子的高大建築物，想要知道它的秘密嗎?裡面可是有意想不到的大祕寶，就一起讓我們去一探究竟吧!',
        'eX5BcpGWyp4' => '中央大學著名的中大湖是今年剛整修完成的十大景點之一，美妙的湖景適合在悠閒的午後與三五好友一起漫步其中。到了夜晚，滿空高掛天上的星星搭配著平靜的湖水，是大學生們在寧靜的夜裡喜歡去的地方。客家學院，座落在中大湖畔的紅磚建築，裡面卻有著現代的高科技設備，是結合了傳統與現代的新大樓。'
    );

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users'     => array('*')
            )
        );
    }

    /**
     * This is a static page
     */
    public function actionIndex()
    {
        $this->setPageTitle(Yii::app()->name . ' - 影音專區');
        $this->render('index');
    }

    public function actionWatch($v)
    {
        $this->renderPartial('watch', array(
            'v'         => $v
        ));
    }
    
    public function actionIntroduction($v)
    {
        if ( isset($this->_introductions[$v]) )
        {
            $this->_data['introduction'] = $this->_introductions[$v];
        }
    }
}