<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->archiveTitle([
        'category' => _t('分类 %s 下的文章'),
        'search'   => _t('包含关键字 %s 的文章'),
        'tag'      => _t('标签 %s 下的文章'),
        'author'   => _t('%s 发布的文章')
    ], '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 网站图标 -->
    <?php if ($this->options->favicon): ?>
    <link rel="icon" type="image/x-icon" href="<?php $this->options->favicon(); ?>">
    <?php else: ?>
    <link rel="icon" type="image/x-icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>">
    <?php endif; ?>

    <!-- CSS 样式 -->
    <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('style.css'); ?>">

    <!-- 主题颜色 -->
    <style>
    :root {
        --theme-color: <?php echo $this->options->themeColor ?: '#007cba'; ?>;
        --theme-color-light: <?php echo $this->options->themeColor ?: '#007cba'; ?>20;
        --theme-color-dark: <?php
            $color = $this->options->themeColor ?: '#007cba';
            // 简单的颜色加深处理
            $hex = str_replace('#', '', $color);
            $r = max(0, hexdec(substr($hex, 0, 2)) - 30);
            $g = max(0, hexdec(substr($hex, 2, 2)) - 30);
            $b = max(0, hexdec(substr($hex, 4, 2)) - 30);
            echo sprintf('#%02x%02x%02x', $r, $g, $b);
        ?>;
    }
    </style>

    <!-- 自定义CSS -->
    <?php if ($this->options->customCSS): ?>
    <style>
    <?php echo $this->options->customCSS; ?>
    </style>
    <?php endif; ?>

    <!-- 响应式设计 -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- SEO 相关 -->
    <meta name="description" content="<?php if ($this->is('single')) {
        $this->excerpt(200, '...');
    } else {
        $this->options->description();
    } ?>">

    <!-- 开放图协议 -->
    <meta property="og:title" content="<?php $this->archiveTitle('', '', ' - '); ?><?php $this->options->title(); ?>">
    <meta property="og:description" content="<?php if ($this->is('single')) {
        $this->excerpt(200, '...');
    } else {
        $this->options->description();
    } ?>">
    <meta property="og:type" content="<?php if ($this->is('single')) echo 'article'; else echo 'website'; ?>">
    <meta property="og:url" content="<?php $this->permalink(); ?>">

    <?php $this->header(); ?>

    <!-- 统计代码 -->
    <?php if ($this->options->analyticsCode): ?>
    <?php echo $this->options->analyticsCode; ?>
    <?php endif; ?>
</head>
<body class="layout-<?php echo $this->options->layout ?: 'right-sidebar'; ?> post-list-<?php echo $this->options->postListStyle ?: 'default'; ?>">
    <header class="site-header">
        <div class="header-content">
            <div class="site-branding">
                    <?php if ($this->options->logoUrl): ?>
                    <h1 class="site-title">
                        <a href="<?php $this->options->siteUrl(); ?>" rel="home">
                            <img src="<?php echo $this->options->logoUrl; ?>" alt="<?php $this->options->title() ?>" class="site-logo">
                        </a>
                    </h1>
                    <?php else: ?>
                    <h1 class="site-title">
                        <a href="<?php $this->options->siteUrl(); ?>" rel="home">
                            <?php $this->options->title() ?>
                        </a>
                    </h1>
                    <?php endif; ?>
                    <?php if ($this->options->description()): ?>
                    <p class="site-description"><?php $this->options->description() ?></p>
                    <?php endif; ?>
                </div>

                <nav class="main-navigation">
                    <ul class="nav-menu">
                        <li class="<?php if($this->is('index')): ?>current-menu-item<?php endif; ?>">
                            <a href="<?php $this->options->siteUrl(); ?>">首页</a>
                        </li>
                        <?php $this->widget('Widget_Contents_Page_List')->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
                    </ul>
                </nav>

                <div class="header-search">
                    <form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                        <input type="search" name="s" class="search-field" placeholder="搜索..." value="<?php $this->archiveTitle('', '', ''); ?>" />
                        <button type="submit" class="search-submit">
                            <span class="screen-reader-text">搜索</span>
                            <i class="icon-search"></i>
                        </button>
                    </form>
                </div>

                <button class="mobile-menu-toggle" aria-controls="mobile-navigation" aria-expanded="false">
                    <span class="screen-reader-text">主菜单</span>
                    <span class="menu-toggle-icon"></span>
                </button>
            </div>
    </header>

    <div class="site-content"><?php if ($this->options->showBreadcrumb && !$this->is('index')): ?>
        <div class="breadcrumb">
            <div class="container">
                <span class="breadcrumb-home">
                    <a href="<?php $this->options->siteUrl(); ?>">首页</a>
                </span>
                <?php if ($this->is('category')): ?>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current">分类：<?php $this->archiveTitle('', '', ''); ?></span>
                <?php elseif ($this->is('tag')): ?>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current">标签：<?php $this->archiveTitle('', '', ''); ?></span>
                <?php elseif ($this->is('author')): ?>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current">作者：<?php $this->archiveTitle('', '', ''); ?></span>
                <?php elseif ($this->is('search')): ?>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current">搜索：<?php $this->archiveTitle('', '', ''); ?></span>
                <?php elseif ($this->is('single')): ?>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-category"><?php $this->category(' / '); ?></span>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current"><?php $this->title(); ?></span>
                <?php elseif ($this->is('page')): ?>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-current"><?php $this->title(); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>