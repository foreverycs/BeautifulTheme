<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<aside class="sidebar">
    <?php
    $sidebarWidgets = $this->options->sidebarWidgets;
    if (!$sidebarWidgets) {
        $sidebarWidgets = array('recent-posts', 'recent-comments', 'categories', 'tags', 'archives');
    }
    ?>

    <?php if (in_array('recent-posts', $sidebarWidgets)): ?>
    <!-- 最新文章 -->
    <div class="widget widget-recent-posts">
        <h3 class="widget-title">最新文章</h3>
        <ul class="recent-posts-list">
            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=6')->to($recent); ?>
            <?php while($recent->next()): ?>
                <li>
                    <a href="<?php $recent->permalink() ?>" title="<?php $recent->title() ?>"><?php $recent->title() ?></a>
                    <span class="post-date"><?php $recent->date('m-d') ?></span>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (in_array('recent-comments', $sidebarWidgets)): ?>
    <!-- 最新评论 -->
    <div class="widget widget-recent-comments">
        <h3 class="widget-title">最新评论</h3>
        <ul class="recent-comments-list">
            <?php $this->widget('Widget_Comments_Recent', 'pageSize=5')->to($comments); ?>
            <?php if($comments->have()): ?>
                <?php while($comments->next()): ?>
                    <li class="recent-comment-item">
                        <div class="comment-author">
                            <strong><?php $comments->author(false); ?></strong>
                        </div>
                        <div class="comment-content">
                            <a href="<?php $comments->permalink(); ?>" title="查看完整评论">
                                <?php $comments->excerpt(35, '...'); ?>
                            </a>
                        </div>
                        <div class="comment-date">
                            <?php $comments->date('m-d H:i'); ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li>暂无评论</li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (in_array('categories', $sidebarWidgets)): ?>
    <!-- 文章分类 -->
    <div class="widget widget-categories">
        <h3 class="widget-title">文章分类</h3>
        <ul class="categories-list">
            <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}" title="查看 {name} 下的所有文章">{name}</a> <span class="category-count">({count})</span></li>'); ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (in_array('tags', $sidebarWidgets)): ?>
    <!-- 标签云 -->
    <div class="widget widget-tags">
        <h3 class="widget-title">标签云</h3>
        <div class="tags-cloud">
            <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=count&ignoreZeroCount=1&desc=1&limit=20')->parse('<a href="{permalink}" class="tag-link" title="查看标签 {name} 下的所有文章">{name}</a>'); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (in_array('archives', $sidebarWidgets)): ?>
    <!-- 归档 -->
    <div class="widget widget-archives">
        <h3 class="widget-title">文章归档</h3>
        <ul class="archives-list">
            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y-m')->to($archives); ?>
            <?php while($archives->next()): ?>
                <li>
                    <a href="<?php $archives->permalink() ?>" title="查看 <?php $archives->date('Y年m月') ?> 的所有文章">
                        <?php $archives->date('Y年m月') ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (in_array('links', $sidebarWidgets)): ?>
    <!-- 友情链接 -->
    <div class="widget widget-links">
        <h3 class="widget-title">友情链接</h3>
        <ul class="links-list">
            <?php $this->widget('Widget_Contents_Page_List')->parse('<li><a href="{permalink}" title="{title}" target="_blank">{title}</a></li>'); ?>
            <li><a href="https://typecho.org/" title="Typecho 官方网站" target="_blank">Typecho</a></li>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (in_array('statistics', $sidebarWidgets)): ?>
    <!-- 站点统计 -->
    <div class="widget widget-statistics">
        <h3 class="widget-title">站点统计</h3>
        <ul class="statistics-list">
            <?php
            $stat = Typecho_Widget::widget('Widget_Stat');
            ?>
            <li><i class="icon-doc"></i> 文章总数：<?php echo $stat->publishedPostsNum; ?> 篇</li>
            <li><i class="icon-comment"></i> 评论总数：<?php echo $stat->publishedCommentsNum; ?> 条</li>
            <li><i class="icon-tag"></i> 标签总数：若干个</li>
            <li><i class="icon-folder"></i> 分类总数：若干个</li>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (in_array('meta', $sidebarWidgets)): ?>
    <!-- 其他链接 -->
    <div class="widget widget-meta">
        <h3 class="widget-title">功能链接</h3>
        <ul class="meta-list">
            <?php if($this->user->hasLogin()): ?>
                <li><a href="<?php $this->options->adminUrl(); ?>" title="进入后台管理"><i class="icon-settings"></i> 网站管理</a></li>
                <li><a href="<?php $this->options->logoutUrl(); ?>" title="退出登录"><i class="icon-logout"></i> 退出 (<?php $this->user->screenName(); ?>)</a></li>
            <?php else: ?>
                <li><a href="<?php $this->options->adminUrl('login.php'); ?>" title="登录网站"><i class="icon-login"></i> 登录</a></li>
            <?php endif; ?>
            <li><a href="<?php $this->options->feedUrl(); ?>" title="订阅本站" target="_blank"><i class="icon-feed"></i> 文章 RSS</a></li>
            <li><a href="<?php $this->options->commentsFeedUrl(); ?>" title="订阅评论" target="_blank"><i class="icon-feed"></i> 评论 RSS</a></li>
        </ul>
    </div>
    <?php endif; ?>
</aside>