<!--  TESTIMONIAL AREA START  -->
<section id="testimonial" class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="mb-5">
                    <h3 class="mb-2">Клиенты, которые доверяют нам</h3>
                    <p>
                        Ниже представлены отзывы от клиентов, с которыми<br />
                        мы работаем уже несколько лет подряд
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 m-auto col-sm-12 col-md-12">
                <div class="carousel slide" id="test-carousel2">
                    <div class="carousel-inner">
                        <ol class="carousel-indicators">
                            <li data-target="#test-carousel2" data-slide-to="0" class="active"></li>
                            <li data-target="#test-carousel2" data-slide-to="1"></li>
                            <li data-target="#test-carousel2" data-slide-to="2"></li>
                        </ol>

                        <?php
                        global $post;
                        $count = 0;
                        $query = new WP_Query( [
                            'post_type'        => 'reviews',
                        ] );
                        ?>

                        <ol class="carousel-indicators">
                            <?
                            for ($i = 0; $i < count($query->posts); $i++) {
                                $class = $i === 0 ? 'active' : '';
                                echo '<li data-target="#test-carousel2" data-slide-to="'.$i.'" class="'.$class.'"></li>';
                            }
                            ?>
                        </ol>

                        <?if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $count++;
                                ?>
                                <div class="carousel-item <? echo $count === 1 ? 'active' : '';?>">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="testimonial-content style-2">
                                                <div class="author-info">
                                                    <div class="author-img">
                                                        <img src="<? the_post_thumbnail_url(); ?>" alt="<? the_title(); ?>" class="img-fluid" />
                                                    </div>
                                                </div>

                                                <p>
                                                    <i class="icofont icofont-quote-left"></i><?php echo strip_tags( get_the_excerpt() ); ?><i class="icofont icofont-quote-right"></i>
                                                </p>
                                                <div class="author-text">
                                                    <h5><? the_title(); ?></h5>
                                                    <p><? echo get_post_meta($post->ID, 'role', true); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <p>Отзывов нет</p>
                            <?
                        }

                        wp_reset_postdata(); // Сбрасываем $post
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  TESTIMONIAL AREA END  -->