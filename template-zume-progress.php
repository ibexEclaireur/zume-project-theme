<?php
/*
Template Name: Zúme Progress
*/

get_header();

?>

    <div id="content">
        <div id="inner-content" class="row">

            <main id="main" class="large-12 medium-12 columns" role="main">

                <div class="blue-ribbon">
                    <h3>Zúme Groups Started in the United States</h3>
                </div>
                <div id="group-markers" style="width: 100%; height: 600px;"></div>


                <div class="blue-ribbon">
                    <h3>Are there Zúme Groups in your state?</h3>
                </div>

                <div style="width:100%; height: 600px; background-color:#2cace2;
                            text-align:center; display: flex; flex-direction: column; justify-content: center;">
                    <h2 style="color:white">Coming soon</h2>
                </div>


                <div class="blue-ribbon" style="text-align: center">
                    <img class="center" src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>zume-logo-clear.png"
                         alt="" style="margin-left:35px"/>
                    <h1 style="color:#2cace2; font-weight: bold">is going global</h1>
                </div>
                <div style="text-align: center">
                <a href="https://support.chasm.solutions/zumeproject" target="_blank">
                <img class="center" src="<?php echo esc_attr( get_stylesheet_directory_uri() ) . '/assets/images/'; ?>zume-translation-infographic.png" alt="" />
                </a>
                <h2 style="color:#2cace2; font-weight: bold; text-align: center">YOU can help get Zúme into other languages! <br>
                    Donate to the translation of Zúme <a href="https://support.chasm.solutions/zumeproject" target="_blank" style="color:#8FC741">here</a>.</h2>
                </div>


            </main>
        </div>
    </div>

<?php get_footer(); ?>
