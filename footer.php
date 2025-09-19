    </div><!-- .site-content -->

    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <div class="site-info">
                        <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></p>
                        <p>
                            由 <a href="http://typecho.org" target="_blank" rel="nofollow">Typecho</a> 强力驱动 |
                            主题设计：<a href="https://claude.ai" target="_blank">Simple Theme</a>
                        </p>
                    </div>

                    <div class="footer-links">
                        <div class="footer-rss">
                            <a href="<?php $this->options->feedUrl(); ?>" title="订阅本站" target="_blank">
                                <i class="icon-feed"></i> RSS订阅
                            </a>
                        </div>
                    </div>
                </div>

                <div class="footer-meta">
                    <div class="runtime">
                        <script>
                        function siteRuntime(){
                            window.setTimeout("siteRuntime()", 1000);
                            var startTime = new Date('2024/01/01');
                            var currentTime = new Date();
                            var timeDiff = currentTime.getTime() - startTime.getTime();
                            var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                            document.getElementById("runtime").innerHTML = "网站已运行 " + days + " 天 " + hours + " 小时 " + minutes + " 分钟 " + seconds + " 秒";
                        }
                        siteRuntime();
                        </script>
                        <span id="runtime"></span>
                    </div>

                    <div class="footer-meta-info">
                        <p>简洁主题 · 技术驱动</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 返回顶部按钮 -->
        <div class="back-to-top" id="backToTop">
            <i class="icon-up"></i>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
    // 移动端菜单切换
    document.addEventListener('DOMContentLoaded', function() {
        var menuToggle = document.querySelector('.mobile-menu-toggle');
        var navigation = document.querySelector('.main-navigation');

        if (menuToggle && navigation) {
            menuToggle.addEventListener('click', function() {
                navigation.classList.toggle('active');
                var expanded = this.getAttribute('aria-expanded') === 'true' || false;
                this.setAttribute('aria-expanded', !expanded);
            });
        }

        // 返回顶部
        var backToTop = document.getElementById('backToTop');
        if (backToTop) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            });

            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // 搜索框焦点处理
        var searchField = document.querySelector('.search-field');
        if (searchField) {
            searchField.addEventListener('focus', function() {
                this.parentNode.classList.add('search-active');
            });

            searchField.addEventListener('blur', function() {
                this.parentNode.classList.remove('search-active');
            });
        }

        // 代码高亮（如果需要）
        if (typeof Prism !== 'undefined') {
            Prism.highlightAll();
        }
    });

    // 图片懒加载
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    </script>

    <?php $this->footer(); ?>
</body>
</html>