<?php $level = 1; ?>
<ul id="sitemap">
<?php foreach ( $pages as $page ) : ?>
<?php if ( $page['level'] < $level ) : ?>
<?php $level--; ?>
</ul>
</li>
<?php endif; ?>
<?php if ( $page['level'] > $level ) : ?>
<?php $level++; ?>
<li>
<ul>
<?php endif; ?>
    <li>
        <a href="<?php echo $page['location']; ?>" title="<?php echo $page['name']; ?>"><?php echo $page['name']; ?></a>
    </li>
<?php endforeach; ?>
</ul>