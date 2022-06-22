<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="seo & digital marketing" />
    <meta
        name="keywords"
        content="marketing,digital marketing,creative, agency, startup,promodise,onepage, clean, modern,seo,business, company"
    />
    <? wp_head(); ?>
</head>

<body data-spy="scroll" data-target=".fixed-top">
<nav class="navbar navbar-expand-lg fixed-top trans-navigation">
    <div class="container">
        <? if( $logo = get_custom_logo() ){
            echo $logo;
        }
        ?>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#mainNav"
            aria-controls="mainNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon">
            <i class="fa fa-bars"></i>
          </span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
            <? wp_nav_menu( array(
                'theme_location'  => 'header',
                'container' => false,
                'menu' => 'header-menu',
                'menu_class' => 'navbar-nav',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'li_class'  => 'nav-item',
                'link_class'   => 'nav-link',
                'depth' => 2,
            ) );
            ?>
        </div>
    </div>
</nav>
<!--MAIN HEADER AREA END -->