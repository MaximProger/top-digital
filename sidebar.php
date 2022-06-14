<aside class="col-lg-4">
    <div class="row">

        <div class="col-lg-12">
            <div class="sidebar-widget search">
                <?php get_search_form(); ?>
            </div>
        </div>

        <?php if ( ! dynamic_sidebar('sidebar-blog') ) {
            dynamic_sidebar( 'sidebar-blog' );
        }
        ?>
    </div>
</aside>