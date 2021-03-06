				<footer class="footer" role="contentinfo">
					<div id="inner-footer" class="row" style="width:300px; float:left">
						<div class="large-12 medium-12 columns">
						    <nav role="navigation">
	    						<?php zume_joints_footer_links(); ?>
                            </nav>
                        </div>
                        <div class="small-12 medium-8 columns">
                            <?php if ( user_can( get_current_user_id(), 'manage_options' ) || current_user_can( 'coach' ) ) { echo '| <a href="/wp-admin" > Admin Panel</a>'; } ?>
                            <p class="source-org copyright">
                                &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
                            </p>
                        </div>
                        <div class="small-12 medium-4 columns" style="float: left">
						    <span style="float: left">
                                <a href="https://www.facebook.com/zumeproject" target="_blank" rel="noopener"><img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/images/facebook-square.svg" style="height: 23px" title="Facebook"></a>
                                <a href="https://twitter.com/zumeproject" target="_blank" rel="noopener"><img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/images/twitter-square.svg" style="height: 23px" title="Twitter"></a>
                            </span>
                        </div>
                    </div> <!-- end #inner-footer -->
                </footer> <!-- end .footer -->
            </div>  <!-- end .main-content -->
        </div> <!-- end .off-canvas-wrapper -->
        <?php wp_footer(); ?>
    </body>
</html> <!-- end page -->
