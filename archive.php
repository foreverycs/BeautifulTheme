<?php
/**
 * 存档页面模板（分类、标签、搜索结果等）
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('header.php'); ?>

<div class="container">
    <main class="main-content">
        <header class="archive-header">
            <?php if ($this->is('category')): ?>
                <h1 class="archive-title">分类：<?php $this->archiveTitle('', '', ''); ?></h1>
                <?php if ($this->getDescription()): ?>
                    <div class="archive-description"><?php echo $this->getDescription(); ?></div>
                <?php endif; ?>
            <?php elseif ($this->is('tag')): ?>
                <h1 class="archive-title">标签：<?php $this->archiveTitle('', '', ''); ?></h1>
            <?php elseif ($this->is('author')): ?>
                <h1 class="archive-title">作者：<?php $this->archiveTitle('', '', ''); ?></h1>
            <?php elseif ($this->is('search')): ?>
                <h1 class="archive-title">搜索：<?php $this->archiveTitle('', '', ''); ?></h1>
                <p class="search-result-count">共找到 <?php echo $this->getTotal(); ?> 篇相关文章</p>
            <?php elseif ($this->is('date')): ?>
                <h1 class="archive-title">归档：<?php $this->archiveTitle('', '', ''); ?></h1>
            <?php else: ?>
                <h1 class="archive-title">文章归档</h1>
            <?php endif; ?>
        </header>

        <?php if ($this->have()): ?>
            <div class="archive-posts">
                <?php while($this->next()): ?>
                    <article class="post archive-post">
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

                        <div class="post-excerpt">
                            <?php $this->excerpt(200, '...'); ?>
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
            </div>

            <nav class="pagination">
                <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;', 3, '...'); ?>
            </nav>
        <?php else: ?>
            <div class="no-posts">
                <?php if ($this->is('search')): ?>
                    <h2>没有找到相关内容</h2>
                    <p>请尝试其他关键词搜索。</p>
                <?php else: ?>
                    <h2>暂无文章</h2>
                    <p>该分类下还没有文章。</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>