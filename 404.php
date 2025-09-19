<?php
/**
 * 404错误页面模板
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->response->setStatus(404);
?>

<?php $this->need('header.php'); ?>

<div class="container">
    <main class="main-content">
        <div class="error-404">
            <div class="error-content">
                <div class="error-icon">
                    <span class="error-number">404</span>
                </div>

                <div class="error-message">
                    <h1>页面未找到</h1>
                    <p>抱歉，您访问的页面不存在或已被删除。</p>
                </div>

                <div class="error-actions">
                    <a href="<?php $this->options->siteUrl(); ?>" class="btn-primary">
                        <i class="icon-home"></i>
                        返回首页
                    </a>
                    <button onclick="history.back()" class="btn-secondary">
                        <i class="icon-left"></i>
                        返回上页
                    </button>
                </div>

                <div class="search-suggest">
                    <h3>或者尝试搜索：</h3>
                    <form method="post" action="<?php $this->options->siteUrl(); ?>" class="search-form">
                        <input type="search" name="s" placeholder="输入关键词搜索..." class="search-input" />
                        <button type="submit" class="search-btn">
                            <i class="icon-search"></i>
                            搜索
                        </button>
                    </form>
                </div>

                <div class="helpful-links">
                    <h3>推荐内容：</h3>
                    <ul class="links-list">
                        <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=5')->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <?php $this->need('sidebar.php'); ?>
</div>

<style>
.error-404 {
    padding: 60px 30px;
    text-align: center;
}

.error-icon {
    margin-bottom: 30px;
}

.error-number {
    font-size: 8rem;
    font-weight: bold;
    color: #ddd;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.error-message h1 {
    font-size: 2rem;
    margin-bottom: 15px;
    color: #333;
}

.error-message p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 30px;
}

.error-actions {
    margin-bottom: 40px;
}

.btn-primary,
.btn-secondary {
    display: inline-block;
    padding: 12px 24px;
    margin: 0 10px;
    border-radius: 4px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s;
}

.btn-primary {
    background: #007cba;
    color: white;
}

.btn-primary:hover {
    background: #005a8a;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #545b62;
}

.search-suggest {
    margin-bottom: 40px;
}

.search-suggest h3 {
    margin-bottom: 20px;
    color: #333;
}

.search-form {
    display: flex;
    justify-content: center;
    gap: 10px;
    max-width: 400px;
    margin: 0 auto;
}

.search-input {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.search-btn {
    padding: 10px 20px;
    background: #007cba;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.helpful-links {
    text-align: left;
    max-width: 400px;
    margin: 0 auto;
}

.helpful-links h3 {
    margin-bottom: 15px;
    color: #333;
    text-align: center;
}

.links-list {
    list-style: none;
    padding: 0;
}

.links-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.links-list a {
    color: #333;
    text-decoration: none;
}

.links-list a:hover {
    color: #007cba;
}

@media (max-width: 480px) {
    .error-number {
        font-size: 6rem;
    }

    .error-message h1 {
        font-size: 1.5rem;
    }

    .search-form {
        flex-direction: column;
    }

    .btn-primary,
    .btn-secondary {
        margin: 5px 0;
    }
}
</style>

<?php $this->need('footer.php'); ?>