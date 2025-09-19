<?php
/**
 * 文章页面模板
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php $this->need('header.php'); ?>

<div class="container">
    <main class="main-content single-post">
        <?php while($this->next()): ?>
            <article class="post post-single">
                <header class="post-header">
                    <h1 class="post-title"><?php $this->title() ?></h1>

                    <div class="post-meta">
                        <?php $showPostMeta = $this->options->showPostMeta ?: array('author', 'date', 'category', 'comments'); ?>

                        <?php if (in_array('author', $showPostMeta)): ?>
                        <span class="post-author">
                            <i class="icon-user"></i>
                            <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a>
                        </span>
                        <?php endif; ?>

                        <?php if (in_array('date', $showPostMeta)): ?>
                        <span class="post-date">
                            <i class="icon-calendar"></i>
                            <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished">
                                <?php $this->date(); ?>
                            </time>
                        </span>
                        <?php endif; ?>

                        <?php if (in_array('category', $showPostMeta)): ?>
                        <span class="post-category">
                            <i class="icon-folder"></i>
                            <?php $this->category(','); ?>
                        </span>
                        <?php endif; ?>

                        <span class="post-views">
                            <i class="icon-eye"></i>
                            阅读次数
                        </span>

                        <?php if($this->user->hasLogin()): ?>
                        <span class="post-edit">
                            <i class="icon-edit"></i>
                            <a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a>
                        </span>
                        <?php endif; ?>
                    </div>
                </header>

                <div class="post-content" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>

                <footer class="post-footer">
                    <?php if ($this->tags && in_array('tags', $showPostMeta)): ?>
                    <div class="post-tags">
                        <i class="icon-tag"></i>
                        <span class="tags-label">标签：</span>
                        <?php $this->tags(', ', true, 'none'); ?>
                    </div>
                    <?php endif; ?>

                    <div class="post-share">
                        <span class="share-label">分享到：</span>
                        <div class="share-buttons">
                            <a href="https://service.weibo.com/share/share.php?url=<?php $this->permalink(); ?>&title=<?php $this->title(); ?>"
                               target="_blank" class="share-weibo" title="分享到微博">
                                <i class="icon-weibo"></i>微博
                            </a>
                            <a href="https://qr.api.cli.im/qr?data=<?php $this->permalink(); ?>&level=H&transparent=false&bgcolor=%23ffffff&forecolor=%23000000&blockpixel=12&marginblock=1&logourl=&size=280&kid=cliim&key="
                               target="_blank" class="share-qr" title="生成二维码">
                                <i class="icon-qrcode"></i>二维码
                            </a>
                            <a href="javascript:void(0)" onclick="copyToClipboard('<?php $this->permalink(); ?>')"
                               class="share-copy" title="复制链接">
                                <i class="icon-link"></i>复制链接
                            </a>
                        </div>
                    </div>
                </footer>

                <!-- 文章导航 -->
                <nav class="post-navigation">
                    <div class="nav-previous">
                        <?php $this->thePrev('<i class="icon-left"></i> %s', '没有更早的文章了'); ?>
                    </div>
                    <div class="nav-next">
                        <?php $this->theNext('%s <i class="icon-right"></i>', '没有更新的文章了'); ?>
                    </div>
                </nav>
            </article>

            <!-- 相关文章 -->
            <?php if ($this->options->showRelatedPosts): ?>
            <section class="related-posts">
                <h3 class="related-title">相关文章</h3>
                <div class="related-posts-list">
                    <?php
                    $related = $this->widget('Widget_Contents_Post_Recent', 'pageSize=5');
                    if ($related->have()):
                    ?>
                        <?php while ($related->next()): ?>
                            <?php if ($related->cid != $this->cid): ?>
                            <article class="related-post-item">
                                <h4 class="related-post-title">
                                    <a href="<?php $related->permalink(); ?>" title="<?php $related->title(); ?>">
                                        <?php $related->title(); ?>
                                    </a>
                                </h4>
                                <div class="related-post-meta">
                                    <span class="related-post-date"><?php $related->date('m-d'); ?></span>
                                    <span class="related-post-category"><?php $related->category(); ?></span>
                                </div>
                            </article>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>暂无相关文章</p>
                    <?php endif; ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- 评论区域 -->
            <?php if ($this->allow('comment')): ?>
                <?php $this->need('comments.php'); ?>
            <?php else: ?>
                <div class="comments-disabled">
                    <p>该文章已关闭评论</p>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
    </main>

    <?php $this->need('sidebar.php'); ?>
</div>

<script>
// 复制链接功能
function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            alert('链接已复制到剪贴板');
        });
    } else {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('链接已复制到剪贴板');
    }
}

// 文章目录生成
document.addEventListener('DOMContentLoaded', function() {
    var content = document.querySelector('.post-content');
    var headings = content.querySelectorAll('h1, h2, h3, h4, h5, h6');

    if (headings.length > 2) {
        var toc = document.createElement('div');
        toc.className = 'post-toc';
        toc.innerHTML = '<h4>文章目录</h4><ul class="toc-list"></ul>';

        var tocList = toc.querySelector('.toc-list');

        headings.forEach(function(heading, index) {
            var anchor = 'heading-' + index;
            heading.id = anchor;

            var li = document.createElement('li');
            li.className = 'toc-item toc-level-' + heading.tagName.toLowerCase();
            li.innerHTML = '<a href="#' + anchor + '">' + heading.textContent + '</a>';

            tocList.appendChild(li);
        });

        content.insertBefore(toc, content.firstChild);
    }
});
</script>

<?php $this->need('footer.php'); ?>