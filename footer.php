				<footer class="footer" role="contentinfo">
					<div id="inner-footer" class="row">
						<div class="large-12 medium-12 columns">
							<nav role="navigation">
	    						<?php zume_joints_footer_links(); ?>
                            </nav>
                        </div>
                        <div class="large-12 medium-12 columns">
                            <p class="source-org copyright">
                                &copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
                                <?php if ( user_can( get_current_user_id(), 'manage_options' ) || current_user_can( 'coach' ) ) { echo '| <a href="/wp-admin" > Admin Panel</a>'; } ?>
                                <a href="https://www.facebook.com/zumeproject" target="_blank" rel="noopener"><img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/images/facebook-square.svg" style="height: 23px" title="Facebook"></a>
                                <a href="https://twitter.com/zumeproject" target="_blank" rel="noopener"><img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/images/twitter-square.svg" style="height: 23px" title="Twitter"></a>
                            </p>
                        </div>
                    </div> <!-- end #inner-footer -->
                </footer> <!-- end .footer -->
            </div>  <!-- end .main-content -->
        </div> <!-- end .off-canvas-wrapper -->
        <?php wp_footer(); ?>
    </body>
</html> <!-- end page -->
