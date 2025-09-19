<?php
/**
 * 页面模板
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('header.php'); ?>

<div class="container">
    <main class="main-content single-page">
        <?php while($this->next()): ?>
            <article class="post post-single">
                <header class="post-header">
                    <h1 class="post-title"><?php $this->title() ?></h1>

                    <div class="post-meta">
                        <span class="post-date">
                            <i class="icon-calendar"></i>
                            <time datetime="<?php $this->date('c'); ?>">
                                <?php $this->date(); ?>
                            </time>
                        </span>

                        <?php if($this->user->hasLogin()): ?>
                        <span class="post-edit">
                            <i class="icon-edit"></i>
                            <a href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a>
                        </span>
                        <?php endif; ?>
                    </div>
                </header>

                <div class="post-content">
                    <?php $this->content(); ?>
                </div>
            </article>

            <!-- 评论区域 -->
            <?php if ($this->allow('comment')): ?>
                <?php $this->need('comments.php'); ?>
            <?php endif; ?>

        <?php endwhile; ?>
    </main>

    <?php $this->need('sidebar.php'); ?>
</div>

<?php $this->need('footer.php'); ?>