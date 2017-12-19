<?php
/*
Template Name: Full Width Home
*/
?>
<?php get_header(); ?>

<div id="content">

    <div id="inner-content">

        <div id="main" role="main" >

            <div style="background: linear-gradient(#2CA2E2, #21336A)">
                <!-- Video -->
                <div class="row" style="padding-top:30px">
                    <div class="large-12  columns center">

                        <div class="max-width-1024-wrapper">
                            <div class="laptop" style="">
                                <div class="laptop__screen">
                                    <div class="laptop__video-wrapper">
                                        <iframe
                                            class="laptop__iframe"
                                            width="640"
                                            height="360"
                                            frameborder="0"
                                            allowfullscreen
                                            src="https://www.youtube-nocookie.com/embed/EOdSAdJ6AhI?rel=0&amp;showinfo=0"

                                        ></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end columns-->
                </div>


                <!-- Challenge -->
                <div class="row" style="max-width:100%; margin:0; background:white; padding:17px">
                    <div class="small-12 columns center">
                        <h3 style="margin-bottom:0px">
                            <strong>Want to start the training?</strong>
                        </h3>
                        <h3 style="margin-bottom:0px">
                            <strong>Get started below</strong>
                        </h3>
                    </div>
                </div>

                <!-- triangle -->
                <div class="center" style="width: 0;   height: 0;   border-left: 30px solid transparent; border-right: 30px solid transparent; border-top: 30px solid white; margin-top:0px;"></div>
                <!-- Steps -->
                <div class="row vertical-padding">
                    <div class="large-6 medium-8 small-10  center">
                        <h3><strong style="color: white">It's as easy as 1-2-3</strong></h3>
                    </div>
                </div>

                <div class="row vertical-padding">
                    <div class="row">
                        <div class="medium-4 columns center">
                            <h4 class="center" style="color:white; white-space:nowrap" >
                                <span style="font-size:2.4rem">&#10102</span>
                                <span style="font-family:'europa-regular'; font-size:1.2rem; vertical-align:25%; display:inline-block"> Sign up </span>
                            </h4>
                            <img class="center"
                                 src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>sign-up.svg"
                                 alt="" width="100" height="100"/>

                        </div>
                        <div class="medium-4 columns center">
                            <h4 class="center" style="color:white" >
                                <span style="font-size:2.4rem">&#10103</span>
                                <span style="font-family:'europa-regular'; font-size:1.2rem; vertical-align:25%; display:inline-block"> Invite some friends </span>
                            </h4>
                            <img class="center"
                                 src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>invite-friends.svg"
                                 alt="" width="100" height="100"/>

                        </div>
                        <div class="medium-4 columns center">
                            <h4 class="center" style="color:white" >
                                <span style="font-size:2.4rem">&#10104</span>
                                <span style="font-family:'europa-regular'; font-size:1.2rem; vertical-align:25%; display:inline-block"> Host a training </span>
                            </h4>
                            <img class="center"
                                 src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>host-training.svg"
                                 alt="" width="100" height="100"/>

                        </div>
                    </div>
                </div>

                <div class="row vertical-padding">
                    <div class="small-12 columns center">
                        <a href="/http://en/register"
                           alt="Register"
                           class="button large center"
                           style="background:white; color:#323a68; font-family:'europa-regular'; padding:0.5em 2em">
                            Get Started
                        </a>
                    </div>
                </div>

            </div>

            <!-- Slider -->

            <br/>
            <h3 class="center"><strong>What others are saying</strong></h3>
            <br/>

            <div class="row vertical-padding">

                <div class="small-12 columns">
                    <div class="row" data-equalizer style="color:#21336A">
                        <div class="large-4 medium-6 small-12 columns centered">
                            <div style="padding: 30px 20px">
                                <img src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>1body.png" class="center front-page-social-image">
                                <h4 class="text-center">
                                    <p style="color:#21336A">
                                        "Zúme will help us accelerate our training into more countries and languages."
                                    </p>
                                </h4>
                            </div>
                        </div>
                        <div class="large-4 medium-6 small-12 columns centered" data-equalizer-watch>
                            <div style="padding: 30px 20px">
                                <img src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>noplaceleft.png" class="center front-page-social-image">
                                <h4 class="text-center">
                                    <p style="color:#21336A">
                                        "Zúme is a helpful way to filter for faithful people that can spread quickly and conserve training bandwidth."
                                    </p>
                                </h4>
                            </div>
                        </div>
                        <div class="large-4 medium-6 small-12 columns centered" data-equalizer-watch>
                            <div style="padding: 30px 20px">
                                <img src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>2414.png" class="center front-page-social-image">
                                <h4 class="text-center">
                                    <p style="color:#21336A">
                                        "Zúme is a wonderful on-ramp for our coalition."
                                    </p>
                                </h4>
                            </div>
                        </div>
                        <div class="large-4 medium-6 small-12 columns centered" data-equalizer-watch>
                            <div style="padding: 30px 20px">
                                <div style="height: 100px" class="center">
                                    <img src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>biglife.png" class="center" style="height:80px">
                                </div>
                                <h4 class="text-center">
                                    <p style="color:#21336A">
                                        "Zúme brilliantly encapsulates the principles in our introductory training."
                                    </p>
                                </h4>
                            </div>
                        </div>
                        <div class="large-4 medium-6 small-12 columns centered">
                            <div style="padding: 30px 20px">
                                <div style="height: 100px" class="center">
                                    <img src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>teamexpansion.png" class="center">
                                </div>
                                <h4 class="text-center">
                                    <p style="color:#21336A">
                                        "The principles and life practices packed into the Zume disciple-multiplication training course have enormous potential to impact not only the USA but also, as the course is translated into 34 other languages, the world as well."
                                    </p>
                                </h4>
                            </div>
                        </div>
                        <div class="large-4 medium-6 small-12 columns centered" data-equalizer-watch>
                            <div style="padding: 30px 20px">
                                <div style="height: 100px" class="center">
                                    <img src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>finishingthetask-logo.png" class="center">
                                </div>
                                <h4 class="text-center">
                                    <p style="color:#21336A">
                                        "Zúme is a valuable tool for many of our member organizations to use in engaging new people groups."
                                    </p>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Find out more link -->
                </div>
                <div class="small-12 columns">
                    <div class="small-8 medium-6 small-centered columns center vertical-padding">
                        <a href="/http://en/about" class="button center" style="background-color: #21336a; color: white; padding:1em 2em">
                            Find out more about Zúme
                        </a>
                    </div>
                </div>

            </div> <!-- end #main -->

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>
