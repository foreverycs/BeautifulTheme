<?php
/**
 * 简洁而现代的Typecho主题
 *
 * @package Simple Theme
 * @author Claude
 * @version 1.0.0
 * @link https://claude.ai
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('header.php'); ?>

<div class="container">
    <main class="main-content">
        <?php if ($this->have()): ?>
            <?php while($this->next()): ?>
                <article class="post">
                    <header class="post-header">
                        <h2 class="post-title">
                            <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                        </h2>
                        <div class="post-meta">
                            <span class="post-author">
                                <i class="icon-user"></i>
                                <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                            </span>
                            <span class="post-date">
                                <i class="icon-calendar"></i>
                                <time datetime="<?php $this->date('c'); ?>"><?php $this->date('Y-m-d'); ?></time>
                            </span>
                            <span class="post-category">
                                <i class="icon-folder"></i>
                                <?php $this->category(','); ?>
                            </span>
                            <span class="post-comments">
                                <i class="icon-comment"></i>
                                <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></a>
                            </span>
                        </div>
                    </header>

                    <div class="post-content">
                        <?php $this->content('继续阅读...'); ?>
                    </div>

                    <?php if ($this->tags): ?>
                    <footer class="post-footer">
                        <div class="post-tags">
                            <i class="icon-tag"></i>
                            <?php $this->tags(', ', true, 'none'); ?>
                        </div>
                    </footer>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>

            <nav class="pagination">
                <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;', 3, '...'); ?>
            </nav>
        <?php else: ?>
            <div class="no-posts">
                <h2>暂无文章</h2>
                <p>还没有发布任何文章。</p>
            </div>
        <?php endif; ?>
    </main>

    <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>