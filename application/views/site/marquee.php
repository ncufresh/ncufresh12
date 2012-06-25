<h1>跑馬燈管理</h1>

<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>當前顯示</th>
            <th>修改</th>
            <th>移除</th>
            <th>新增日期</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5">
                <form id="marquee-form" method="POST">
                    <input id="marquee-form-message" name="marquee[message]" type="text" />
                    <input name="token" value="<?php echo Yii::app()->security->getToekn(); ?>" type="hidden" />
                    <input value="新增" type="submit" />
                </form>
            </td>
        </tr>
    </tfoot>
    <tbody>
<?php foreach ( $marquees as $index => $marquee ) : ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $marquee->message; ?></td>
            <td><a href="<?php echo $this->createUrl('site/marquee', array('id' => $marquee->id)); ?>" title="修改">修</a></td>
            <td><a href="<?php echo $this->createUrl('site/marquee', array('id' => $marquee->id)); ?>" title="移除">移</a></td>
            <td><?php echo $marquee->updated; ?></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>