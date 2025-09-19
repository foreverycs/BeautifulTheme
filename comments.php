<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<section class="comments-section" id="comments">
    <?php $this->comments()->to($comments); ?>

    <!-- 评论标题 -->
    <div class="comments-header">
        <h3 class="comments-title">
            <?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?>
        </h3>
    </div>

    <!-- 评论列表 -->
    <?php if ($comments->have()): ?>
    <ol class="comments-list">
        <?php while($comments->next()): ?>
            <li id="comment-<?php $comments->theId(); ?>" class="comment-item">
                <div class="comment-body">
                    <!-- 评论者头像 -->
                    <div class="comment-avatar">
                        <?php $avatar = $comments->gravatar('40', ''); ?>
                        <img src="<?php echo $avatar; ?>" alt="<?php $comments->author(); ?>" class="avatar">
                    </div>

                    <!-- 评论内容区域 -->
                    <div class="comment-content-wrap">
                        <!-- 评论者信息 -->
                        <div class="comment-meta">
                            <cite class="comment-author">
                                <?php if ($comments->url): ?>
                                    <a href="<?php $comments->url(); ?>" target="_blank" rel="external nofollow">
                                        <?php $comments->author(); ?>
                                    </a>
                                <?php else: ?>
                                    <?php $comments->author(); ?>
                                <?php endif; ?>
                            </cite>

                            <span class="comment-date">
                                <i class="icon-time"></i>
                                <time datetime="<?php $comments->date('c'); ?>">
                                    <?php $comments->date('Y-m-d H:i'); ?>
                                </time>
                            </span>

                            <span class="comment-floor">
                                #<?php $comments->sequence(); ?>
                            </span>

                            <!-- 评论操作 -->
                            <span class="comment-actions">
                                <a href="<?php $comments->permalink(); ?>" class="comment-permalink" title="评论链接">
                                    <i class="icon-link"></i>
                                </a>
                                <?php $comments->reply('回复'); ?>
                            </span>
                        </div>

                        <!-- 评论内容 -->
                        <div class="comment-content">
                            <?php $comments->content(); ?>
                        </div>

                        <!-- 子评论 -->
                        <?php if ($comments->children): ?>
                        <div class="comment-children">
                            <?php $comments->threadedComments(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ol>

    <!-- 评论分页 -->
    <?php $comments->pageNav('&laquo; 上一页', '下一页 &raquo;'); ?>
    <?php endif; ?>

    <!-- 评论表单 -->
    <?php if($this->allow('comment')): ?>
    <div class="comment-form-wrapper" id="comment-form">
        <h4 class="comment-form-title">发表评论</h4>

        <form method="post" action="<?php $this->commentUrl() ?>" class="comment-form" role="form">
            <!-- 已登录用户显示 -->
            <?php if($this->user->hasLogin()): ?>
                <div class="logged-in-as">
                    <p>
                        <i class="icon-user"></i>
                        登录身份：<a href="<?php $this->options->adminUrl(); ?>"><?php $this->user->screenName(); ?></a>
                        <a href="<?php $this->options->logoutUrl(); ?>" title="退出登录">退出 &raquo;</a>
                    </p>
                </div>

            <!-- 未登录用户输入表单 -->
            <?php else: ?>
                <div class="comment-form-fields">
                    <div class="form-group">
                        <label for="author">
                            <i class="icon-user"></i>
                            姓名 <span class="required">*</span>
                        </label>
                        <input type="text" name="author" id="author" class="form-control"
                               value="<?php $this->remember('author'); ?>" required />
                    </div>

                    <div class="form-group">
                        <label for="mail">
                            <i class="icon-mail"></i>
                            邮箱 <span class="required">*</span>
                        </label>
                        <input type="email" name="mail" id="mail" class="form-control"
                               value="<?php $this->remember('mail'); ?>" required />
                        <small class="form-help">邮箱不会被公开，用于接收回复通知</small>
                    </div>

                    <div class="form-group">
                        <label for="url">
                            <i class="icon-link"></i>
                            网站
                        </label>
                        <input type="url" name="url" id="url" class="form-control"
                               value="<?php $this->remember('url'); ?>" />
                    </div>
                </div>
            <?php endif; ?>

            <!-- 评论内容输入 -->
            <div class="form-group comment-textarea-group">
                <label for="textarea">
                    <i class="icon-edit"></i>
                    评论内容 <span class="required">*</span>
                </label>
                <textarea rows="6" cols="50" name="text" id="textarea" class="form-control"
                          placeholder="在这里输入你的评论..." required><?php $this->remember('text'); ?></textarea>

                <!-- 表情工具栏 -->
                <div class="comment-toolbar">
                    <div class="emoji-toolbar">
                        <button type="button" class="emoji-btn" data-emoji="😊">😊</button>
                        <button type="button" class="emoji-btn" data-emoji="😂">😂</button>
                        <button type="button" class="emoji-btn" data-emoji="😎">😎</button>
                        <button type="button" class="emoji-btn" data-emoji="😭">😭</button>
                        <button type="button" class="emoji-btn" data-emoji="😍">😍</button>
                        <button type="button" class="emoji-btn" data-emoji="🤔">🤔</button>
                        <button type="button" class="emoji-btn" data-emoji="👍">👍</button>
                        <button type="button" class="emoji-btn" data-emoji="👎">👎</button>
                    </div>

                    <div class="comment-tips">
                        <small>支持 Markdown 语法，<code>Ctrl+Enter</code> 快速提交</small>
                    </div>
                </div>
            </div>

            <!-- 提交按钮 -->
            <div class="form-group form-submit">
                <button type="submit" class="submit-btn">
                    <i class="icon-send"></i>
                    发表评论
                </button>

                <!-- 评论须知 -->
                <div class="comment-policy">
                    <small>
                        <i class="icon-info"></i>
                        请文明评论，理性讨论。评论将在审核后显示。
                    </small>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript 功能 -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 表情插入功能
        var emojiButtons = document.querySelectorAll('.emoji-btn');
        var textarea = document.getElementById('textarea');

        emojiButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var emoji = this.getAttribute('data-emoji');
                var cursorPos = textarea.selectionStart;
                var textBefore = textarea.value.substring(0, cursorPos);
                var textAfter = textarea.value.substring(cursorPos);

                textarea.value = textBefore + emoji + textAfter;
                textarea.focus();
                textarea.setSelectionRange(cursorPos + emoji.length, cursorPos + emoji.length);
            });
        });

        // Ctrl+Enter 快速提交
        textarea.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.keyCode === 13) {
                e.preventDefault();
                this.closest('form').submit();
            }
        });

        // 评论回复功能
        var replyLinks = document.querySelectorAll('.comment-reply-link');
        replyLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var commentId = this.getAttribute('data-cid');
                var commentForm = document.getElementById('comment-form');
                var targetComment = document.getElementById('comment-' + commentId);

                if (targetComment) {
                    targetComment.appendChild(commentForm);
                    textarea.placeholder = '回复 ' + targetComment.querySelector('.comment-author').textContent + '：';
                    textarea.focus();
                }
            });
        });

        // 取消回复
        function cancelReply() {
            var originalPosition = document.querySelector('.comment-form-wrapper');
            var commentForm = document.getElementById('comment-form');
            if (originalPosition && commentForm) {
                originalPosition.appendChild(commentForm);
                textarea.placeholder = '在这里输入你的评论...';
            }
        }

        // 评论计数更新
        function updateCommentCount() {
            var comments = document.querySelectorAll('.comment-item');
            var count = comments.length;
            var title = document.querySelector('.comments-title');
            if (title) {
                title.textContent = count === 0 ? '暂无评论' : count + ' 条评论';
            }
        }
    });
    </script>

    <?php else: ?>
    <div class="comments-closed">
        <p><i class="icon-lock"></i> 评论已关闭</p>
    </div>
    <?php endif; ?>
</section>