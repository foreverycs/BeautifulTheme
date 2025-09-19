<?php
/**
 * Simple Theme 主题配置文件
 *
 * @package Simple Theme
 * @author Claude
 * @version 1.0.0
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 主题配置函数
 */
function themeConfig($form) {

    // 基础设置
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点Logo'), _t('在这里填入一个图片URL地址，留空则显示文字标题'));
    $form->addInput($logoUrl);

    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('网站图标(Favicon)'), _t('在这里填入一个图标URL地址，一般为.ico格式，留空则使用默认图标'));
    $form->addInput($favicon);

    $siteStart = new Typecho_Widget_Helper_Form_Element_Text('siteStart', NULL, date('Y/m/d'), _t('网站建立日期'), _t('格式：YYYY/MM/DD，用于计算网站运行时间'));
    $form->addInput($siteStart);

    $icp = new Typecho_Widget_Helper_Form_Element_Text('icp', NULL, NULL, _t('ICP备案号'), _t('请填写你的ICP备案号，留空则不显示'));
    $form->addInput($icp);

    // 外观设置
    $themeColor = new Typecho_Widget_Helper_Form_Element_Select('themeColor', array(
        '#007cba' => _t('默认蓝色'),
        '#28a745' => _t('绿色'),
        '#dc3545' => _t('红色'),
        '#fd7e14' => _t('橙色'),
        '#6f42c1' => _t('紫色'),
        '#20c997' => _t('青色'),
        '#e83e8c' => _t('粉色'),
        '#6c757d' => _t('灰色')
    ), '#007cba', _t('主题颜色'), _t('选择网站的主题色调'));
    $form->addInput($themeColor);

    $layout = new Typecho_Widget_Helper_Form_Element_Radio('layout', array(
        'right-sidebar' => _t('右侧边栏（默认）'),
        'left-sidebar' => _t('左侧边栏'),
        'no-sidebar' => _t('无侧边栏')
    ), 'right-sidebar', _t('页面布局'), _t('选择网站的页面布局方式'));
    $form->addInput($layout);

    $postListStyle = new Typecho_Widget_Helper_Form_Element_Radio('postListStyle', array(
        'default' => _t('默认样式'),
        'card' => _t('卡片样式'),
        'minimal' => _t('极简样式')
    ), 'default', _t('文章列表样式'), _t('选择首页文章列表的显示样式'));
    $form->addInput($postListStyle);

    // 功能开关
    $showBreadcrumb = new Typecho_Widget_Helper_Form_Element_Radio('showBreadcrumb', array(
        '1' => _t('开启'),
        '0' => _t('关闭')
    ), '1', _t('面包屑导航'), _t('是否显示面包屑导航'));
    $form->addInput($showBreadcrumb);

    $showRelatedPosts = new Typecho_Widget_Helper_Form_Element_Radio('showRelatedPosts', array(
        '1' => _t('开启'),
        '0' => _t('关闭')
    ), '1', _t('相关文章'), _t('是否在文章页显示相关文章'));
    $form->addInput($showRelatedPosts);

    $showPostMeta = new Typecho_Widget_Helper_Form_Element_Checkbox('showPostMeta', array(
        'author' => _t('作者'),
        'date' => _t('发布日期'),
        'category' => _t('分类'),
        'tags' => _t('标签'),
        'comments' => _t('评论数')
    ), array('author', 'date', 'category', 'comments'), _t('文章元信息'), _t('选择要显示的文章元信息'));
    $form->addInput($showPostMeta);

    $showSiteRuntime = new Typecho_Widget_Helper_Form_Element_Radio('showSiteRuntime', array(
        '1' => _t('开启'),
        '0' => _t('关闭')
    ), '1', _t('网站运行时间'), _t('是否在页脚显示网站运行时间'));
    $form->addInput($showSiteRuntime);

    $showBackToTop = new Typecho_Widget_Helper_Form_Element_Radio('showBackToTop', array(
        '1' => _t('开启'),
        '0' => _t('关闭')
    ), '1', _t('返回顶部按钮'), _t('是否显示返回顶部按钮'));
    $form->addInput($showBackToTop);

    // 侧边栏设置
    $sidebarWidgets = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarWidgets', array(
        'recent-posts' => _t('最新文章'),
        'recent-comments' => _t('最新评论'),
        'categories' => _t('文章分类'),
        'tags' => _t('标签云'),
        'archives' => _t('文章归档'),
        'statistics' => _t('站点统计'),
        'links' => _t('友情链接'),
        'meta' => _t('功能链接')
    ), array('recent-posts', 'recent-comments', 'categories', 'tags', 'archives'), _t('侧边栏组件'), _t('选择要显示的侧边栏组件'));
    $form->addInput($sidebarWidgets);

    // 社交链接
    $socialWeibo = new Typecho_Widget_Helper_Form_Element_Text('socialWeibo', NULL, NULL, _t('微博链接'), _t('填写完整的微博链接地址'));
    $form->addInput($socialWeibo);

    $socialGithub = new Typecho_Widget_Helper_Form_Element_Text('socialGithub', NULL, NULL, _t('GitHub链接'), _t('填写完整的GitHub链接地址'));
    $form->addInput($socialGithub);

    $socialEmail = new Typecho_Widget_Helper_Form_Element_Text('socialEmail', NULL, NULL, _t('邮箱地址'), _t('填写联系邮箱地址'));
    $form->addInput($socialEmail);

    // 自定义代码
    $customCSS = new Typecho_Widget_Helper_Form_Element_Textarea('customCSS', NULL, NULL, _t('自定义CSS'), _t('在这里可以填写自定义的CSS代码，将会插入到head标签内'));
    $form->addInput($customCSS);

    $customJS = new Typecho_Widget_Helper_Form_Element_Textarea('customJS', NULL, NULL, _t('自定义JavaScript'), _t('在这里可以填写自定义的JavaScript代码，将会插入到body结束标签前'));
    $form->addInput($customJS);

    $analyticsCode = new Typecho_Widget_Helper_Form_Element_Textarea('analyticsCode', NULL, NULL, _t('统计代码'), _t('在这里填写Google Analytics、百度统计等统计代码'));
    $form->addInput($analyticsCode);
}

/**
 * 获取主题配置
 */
function getThemeOption($name, $default = '') {
    $options = Helper::options();
    return $options->plugin('SimpleTheme')->$name ?: $default;
}

/**
 * 输出主题颜色CSS变量
 */
function outputThemeColors($widget) {
    $themeColor = $widget->options->themeColor ?: '#007cba';
    echo "<style>:root { --theme-color: {$themeColor}; }</style>\n";
}

/**
 * 输出自定义CSS
 */
function outputCustomCSS($widget) {
    if ($widget->options->customCSS) {
        echo "<style>\n" . $widget->options->customCSS . "\n</style>\n";
    }
}

/**
 * 输出自定义JavaScript
 */
function outputCustomJS($widget) {
    if ($widget->options->customJS) {
        echo "<script>\n" . $widget->options->customJS . "\n</script>\n";
    }
}

/**
 * 输出统计代码
 */
function outputAnalyticsCode($widget) {
    if ($widget->options->analyticsCode) {
        echo $widget->options->analyticsCode . "\n";
    }
}

/**
 * 文章摘要过滤器
 */
function themeExcerpt($widget, $length = 200) {
    $content = $widget->content;
    $content = strip_tags($content);
    $content = preg_replace('/\s+/', ' ', $content);
    if (mb_strlen($content) > $length) {
        $content = mb_substr($content, 0, $length) . '...';
    }
    return $content;
}

/**
 * 时间格式化函数
 */
function timeAgo($timestamp) {
    $time = time() - $timestamp;
    if ($time < 60) {
        return '刚刚';
    } elseif ($time < 3600) {
        return floor($time / 60) . ' 分钟前';
    } elseif ($time < 86400) {
        return floor($time / 3600) . ' 小时前';
    } elseif ($time < 2592000) {
        return floor($time / 86400) . ' 天前';
    } else {
        return date('Y-m-d', $timestamp);
    }
}

/**
 * 获取文章阅读时间估算
 */
function getReadingTime($content) {
    $wordCount = mb_strlen(strip_tags($content), 'UTF-8');
    $readingTime = ceil($wordCount / 300); // 假设每分钟阅读300字
    return $readingTime;
}

/**
 * 获取Gravatar头像
 */
function getGravatar($email, $size = 40, $default = 'mp') {
    $hash = md5(strtolower(trim($email)));
    return "https://www.gravatar.com/avatar/{$hash}?s={$size}&d={$default}";
}