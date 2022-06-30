<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="banner-area banner-3">
    <div class="overlay dark-overlay"></div>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                        <div class="banner-content content-padding">
                            <h5 class="subtitle"><? echo get_post_meta($post->ID, 'subtitle', true); ?></h5>
                            <h1 class="banner-title"><? echo get_post_meta($post->ID, 'banner-title', true); ?></h1>
                            <p>
                                <? echo get_post_meta($post->ID, 'description', true); ?>
                            </p>

                            <a href="#" class="btn btn-white btn-circled">Начать сотрудничество</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->
<section id="intro" class="section-padding">
    <div class="container">
        <? the_content(); ?>
    </div>
</section>
<!--  ABOUT AREA START  -->
<section id="intro" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="section-heading">
                    <p class="lead">
                        Мы оказываем маркетинговые услуги с 2016 года за это время мы выполнили больше сотни проеков,
                        подключайтесь к совместной работе с нами
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block col-sm-12">
                <div class="intro-img">
                    <img src="images/banner/why-choose.png" alt="intro-img" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="intro-box">
                            <span>01.</span>
                            <h4>Проекты</h4>
                            <p>
                                мы ведем каждый проект индивидуально, за вами закрепляется менеджер, который работает только с вами.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="intro-box">
                            <span>02.</span>
                            <h4>Стратегия</h4>
                            <p>
                                не беремся за проект, если он одноразовый, запускаем такие проекты, с которыми будем работать
                                несоклько лет.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="intro-box">
                            <span>03.</span>
                            <h4>Опыт</h4>
                            <p>
                                мы успели поработать в разных нишах: строительство, инвестиции, онлайн-образование, бьюти-сфера и
                                другие.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <div class="intro-box">
                            <span>04.</span>
                            <h4>Технологии</h4>
                            <p>
                                Все проекты делает команда разработчиков, которая постоянно учится новому, мы используем современные
                                инструменты для решения ваших задач.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-cta">
                            <p class="lead">Остались вопросы? <a href="#contact" class="smoth-scroll">Напишите нам</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  ABOUT AREA END  -->

<!--  SERVICE AREA START  -->
<section id="about" class="bg-light">
    <div class="about-bg-img d-none d-lg-block d-md-block"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-12 col-md-8">
                <div class="about-content">
                    <h5 class="subtitle">О нас</h5>
                    <h3>Мы делаем рабочий инструмент <br />для вашего бизнеса</h3>
                    <p>
                        Мы создадим сайт про вашу компанию и вам не придется заказывать услуги у фрилансеров, переживая за сроки
                        проекта и его качество. В нашей команде есть все нужные специалисты, которые сделаю отличный сайт
                    </p>

                    <ul class="about-list">
                        <li><i class="icofont icofont-check-circled"></i> Адаптивный</li>
                        <li><i class="icofont icofont-check-circled"> </i> С анимацией</li>
                        <li><i class="icofont icofont-check-circled"> </i> С чистым кодом</li>
                        <li><i class="icofont icofont-check-circled"> </i> Готовый к использованию</li>
                        <li><i class="icofont icofont-check-circled"> </i> Настроенный под SEO</li>
                        <li><i class="icofont icofont-check-circled"></i> Кроссбраузерный</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  SERVICE AREA END  -->

<?php get_template_part( 'template-parts/content', 'service', [
    'class' => 'bg-feature',
    'title' => 'Диджитал полного цикла'
] ); ?>


<?php get_template_part( 'template-parts/content', 'tarif'); ?>

<?php get_template_part( 'template-parts/content', 'review'); ?>

<!--  PARTNER START  -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-md-3 text-center">
                <img src="images/clients/client01.png" alt="partner" class="img-fluid" />
            </div>
            <div class="col-lg-3 col-sm-6 col-md-3 text-center">
                <img src="images/clients/client06.png" alt="partner" class="img-fluid" />
            </div>
            <div class="col-lg-3 col-sm-6 col-md-3 text-center">
                <img src="images/clients/client04.png" alt="partner" class="img-fluid" />
            </div>
            <div class="col-lg-3 col-sm-6 col-md-3 text-center">
                <img src="images/clients/client05.png" alt="partner" class="img-fluid" />
            </div>
        </div>
    </div>
</section>
<!--  PARTNER END  -->


<!--  BLOG AREA START  -->
<section id="blog" class="section-padding bg-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 m-auto">
                <div class="section-heading">
                    <h4 class="section-title">Журнал</h4>
                    <div class="line"></div>
                    <p>
                        Мы публикуем в блоге интересные кейсы наших клиентов, возможно, <br />
                        вы найдете много полезного для себя и своего бизнеса
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            global $post;

            $query = new WP_Query( [
                'posts_per_page' => 3,
                'post_type'        => 'post',
            ] );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <div class="col-lg-4 col-sm-6 col-md-4">
                        <div class="blog-block">
                            <?php if ( has_post_thumbnail()) {
                                the_post_thumbnail( 'post-thumbnail', array(
                                    'class' => "img-fluid",
                                ));
                            } else {
                                echo '<img src="'.get_template_directory_uri().'/images/blog/blog-1.jpg" alt="" class="img-fluid w-100">';
                            } ?>
                            <div class="blog-text">
                                <h6 class="author-name">
                                    <span><? echo get_the_category()[0]->name; ?></span>
                                    <? the_author(); ?>
                                </h6>
                                <a href="<? echo get_the_permalink(); ?>" class="h5 my-2 d-inline-block"> <? the_title(); ?> </a>
                                <? the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <p>Журнал пуст</p>
                <?
            }

            wp_reset_postdata(); // Сбрасываем $post
            ?>
        </div>
    </div>
</section>
<!--  BLOG AREA END  -->

<?php $stats = get_field('stats'); ?>

<!--  COUNTER AREA START  -->
<section id="counter" class="section-padding">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="counter-stat">
                    <i class="icofont icofont-heart"></i>
                    <span class="counter"><?=$stats['clients'];?></span>
                    <h5>счастливых клиентов</h5>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="counter-stat">
                    <i class="icofont icofont-rocket"></i>
                    <span class="counter"><?=$stats['done-projects'];?></span>
                    <h5>выполненных проектов</h5>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="counter-stat">
                    <i class="icofont icofont-hand-power"></i>
                    <span class="counter"><?=$stats['people'];?></span>
                    <h5>людей в команде</h5>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="counter-stat">
                    <i class="icofont icofont-shield-alt"></i>
                    <span class="counter"><?=$stats['current-projects'];?></span>
                    <h5>Проектов в работе</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  COUNTER AREA END  -->

<?php get_footer(); ?>
