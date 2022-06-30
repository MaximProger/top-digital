<?php
/*
Template Name: Мой шаблон цены
Template Post Type: page
*/

get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
                <div class="banner-content content-padding">
                    <h1 class="text-white">Цены на услуги</h1>
                    <p>Подберите подходящий тариф</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MAIN HEADER AREA END -->

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

<?php get_footer(); ?>
