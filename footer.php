<!--  FOOTER AREA START  -->
<section id="footer" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-8 col-md-8">
                <?php if ( ! dynamic_sidebar('sidebar-footer-text') ) {
                    dynamic_sidebar( 'sidebar-footer-text' );
                }
                ?>
            </div>
            <div class="col-lg-2 col-sm-4 col-md-4">
                <div class="footer-widget footer-link">
                    <h4>Информация</h4>
                    <?
                    wp_nav_menu( [
                        'menu'=> 'footer-left-menu',
                        'menu_class'      => '',
                        'menu_id'         => '',
                        'container'            => false,
                        'echo'            => true,
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 1,
                    ] );
                    ?>
                </div>
            </div>

            <div class="col-lg-2 col-sm-6 col-md-6">
                <div class="footer-widget footer-link">
                    <h4>Сылки</h4>
                    <?
                    wp_nav_menu( [
                        'menu'=> 'footer-right-menu',
                        'menu_class'      => '',
                        'menu_id'         => '',
                        'container'            => false,
                        'echo'            => true,
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 1,
                    ] );
                    ?>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <?php if ( ! dynamic_sidebar('sidebar-footer-contacts') ) {
                    dynamic_sidebar( 'sidebar-footer-contacts' );
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer-copy">© <? echo date('Y') . ' ' . get_bloginfo('name'); ?> inc. Все права защищены.</div>
            </div>
        </div>
    </div>
</section>
<!--  FOOTER AREA END  -->

<? wp_footer(); ?>
</body>
</html>