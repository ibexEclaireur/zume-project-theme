<?php


//@todo set default to prvita
function bp_remove_group_step_settings($array) {

	$array = array(
		'group-details'  => array(
			'name'       => _x( 'Details', 'Group screen nav', 'buddypress' ),
			'position'   => 0
		)
	);

	return $array;
}
add_filter ('groups_create_group_steps', 'bp_remove_group_step_settings', 10, 1);

/**
 * The bp_is_active( 'groups' ) check is recommended, to prevent problems
 * during upgrade or when the Groups component is disabled
 */
if ( bp_is_active( 'groups' ) ) :

	class Invite_By_Email extends BP_Group_Extension {
		/**
		 * Your __construct() method will contain configuration options for
		 * your extension, and will pass them to parent::init()
		 */
		function __construct() {
			$args = array(
				'slug' => 'group_invite_by_email',
				'name' => 'Group Invite By Email',
        'screens' => array(
	        'create' => array(
		        'position' => 100,
	        ),
          'edit' => array(
            'enabled' => false,
          ),
          'admin' => array(
            'enabled' => false,
          )
        ),
        'show_tab' => 'noone'
			);
			parent::init( $args );
		}




    function create_screen_save($group_id = NULL){

		  update_option("testgroup", $group_id);
	    if ( ! invite_anyone_process_invitations( stripslashes_deep( $_POST ) ) ) {
		    bp_core_add_message( __( 'Sorry, there was a problem sending your invitations. Please try again.', 'invite-anyone' ), 'error' );
	    }
    }



    function create_screen($group_id = NULL){
      global $bp;

	    $iaoptions = invite_anyone_options();

	    // Hack - catch already=accepted
	    if ( ! empty( $_GET['already'] ) && 'accepted' === $_GET['already'] && bp_is_my_profile() ) {
		    _e( 'It looks like you&#8217;ve already accepted your invitation to join the site.', 'invite-anyone' );
		    return;
	    }

	    // If the user has maxed out his invites, no need to go on
	    if ( !empty( $iaoptions['email_limit_invites_toggle'] ) && $iaoptions['email_limit_invites_toggle'] == 'yes' && !current_user_can( 'delete_others_pages' ) ) {
		    $sent_invites       = invite_anyone_get_invitations_by_inviter_id( bp_displayed_user_id() );
		    $sent_invites_count  = $sent_invites->post_count;
		    if ( $sent_invites_count >= $iaoptions['limit_invites_per_user'] ) : ?>

              <h4><?php _e( 'Invite New Members', 'invite-anyone' ); ?></h4>

              <p id="welcome-message"><?php _e( 'You have sent the maximum allowed number of invitations.', 'invite-anyone' ); ?></em></p>

			    <?php return;
		    endif;
	    }

	    if ( !$max_invites = $iaoptions['max_invites'] )
		    $max_invites = 5;

	    $from_group = false;
	    if ( !empty( $bp->action_variables ) ) {
		    if ( 'group-invites' == $bp->action_variables[0] )
			    $from_group = $bp->action_variables[1];
	    }

	    $returned_data = !empty( $bp->invite_anyone->returned_data ) ? $bp->invite_anyone->returned_data : false;

	    /* If the user is coming from the widget, $returned_emails is populated with those email addresses */
	    if ( isset( $_POST['invite_anyone_widget'] ) ) {
		    check_admin_referer( 'invite-anyone-widget_' . $bp->loggedin_user->id );

		    if ( !empty( $_POST['invite_anyone_email_addresses'] ) ) {
			    $returned_data['error_emails'] = invite_anyone_parse_addresses( $_POST['invite_anyone_email_addresses'] );
		    }

		    /* If the widget appeared on a group page, the group ID should come along with it too */
		    if ( isset( $_POST['invite_anyone_widget_group'] ) )
			    $returned_data['groups'] = $_POST['invite_anyone_widget_group'];

	    }

	    // $returned_groups is padded so that array_search (below) returns true for first group */

	    $counter = 0;
	    $returned_groups = array( 0 );
	    if ( ! empty( $returned_data['groups'] ) ) {
		    foreach( $returned_data['groups'] as $group_id ) {
			    $returned_groups[] = $group_id;
		    }
	    }

	    // Get the returned email subject, if there is one
	    $returned_subject = ! empty( $returned_data['subject'] ) ? stripslashes( $returned_data['subject'] ) : false;

	    // Get the returned email message, if there is one
	    $returned_message = ! empty( $returned_data['message'] ) ? stripslashes( $returned_data['message'] ) : false;

	    if ( ! empty( $returned_data['error_message'] ) ) {
		    ?>
          <div class="invite-anyone-error error">
            <p><?php _e( "Some of your invitations were not sent. Please see the errors below and resubmit the failed invitations.", 'invite-anyone' ) ?></p>
          </div>
		    <?php
	    }

	    $blogname = get_bloginfo('name');
	    $welcome_message = sprintf( __( 'Invite friends to join %s by following these steps:', 'invite-anyone' ), $blogname );

		  ?>
      <form id="invite-anyone-by-email" action="<?php echo $bp->displayed_user->domain . $bp->invite_anyone->slug . '/sent-invites/send/' ?>" method="post">

        <h4><?php _e( 'Invite New Members', 'invite-anyone' ); ?></h4>

		    <?php

		    if ( isset( $iaoptions['email_limit_invites_toggle'] ) && $iaoptions['email_limit_invites_toggle'] == 'yes' && !current_user_can( 'delete_others_pages' ) ) {
			    if ( !isset( $sent_invites ) ) {
				    $sent_invites = invite_anyone_get_invitations_by_inviter_id( bp_loggedin_user_id() );
				    $sent_invites_count = $sent_invites->post_count;
			    }

			    $limit_invite_count = (int) $iaoptions['limit_invites_per_user'] - (int) $sent_invites_count;

			    if ( $limit_invite_count < 0 ) {
				    $limit_invite_count = 0;
			    }

			    ?>

              <p class="description"><?php printf( __( 'The site administrator has limited each user to %1$d invitations. You have %2$d invitations remaining.', 'invite-anyone' ), (int) $iaoptions['limit_invites_per_user'], (int) $limit_invite_count ) ?></p>

			    <?php
		    }
		    ?>

        <p id="welcome-message"><?php echo esc_html( $welcome_message ) ?></p>

        <ol id="invite-anyone-steps">

          <li>
		      <?php if ( ! empty( $returned_data['error_message'] ) ) : ?>
                <div class="invite-anyone-error error">
                  <p><?php echo $returned_data['error_message'] ?></p>
                </div>
		      <?php endif ?>

            <div class="manual-email">
              <p>
			      <?php _e( 'Enter email addresses below, one per line.', 'invite-anyone' ) ?>
			      <?php if( invite_anyone_allowed_domains() ) : ?> <?php _e( 'You can only invite people whose email addresses end in one of the following domains:', 'invite-anyone' ) ?> <?php echo esc_html( invite_anyone_allowed_domains() ); ?><?php endif; ?>
              </p>

			    <?php invite_anyone_email_fields( $returned_data['error_emails'] ) ?>
            </div>

		      <?php /* invite_anyone_after_addresses gets $iaoptions so that Cloudsponge etc can tell whether certain components are activated, without an additional lookup */ ?>
		      <?php do_action( 'invite_anyone_after_addresses', $iaoptions ) ?>

          </li>

          <li>
<!--          --><?php //echo "test"?>
<!--          --><?php //print_r($iaoptions)?>
		      <?php if ( $iaoptions['subject_is_customizable'] == 'yes' ) : ?>
                <label for="invite-anyone-custom-subject"><?php _e( '(optional) Customize the subject line of the invitation email.', 'invite-anyone' ) ?></label>
                <textarea name="invite_anyone_custom_subject" id="invite-anyone-custom-subject" rows="15" cols="10" ><?php echo esc_textarea( invite_anyone_invitation_subject( $returned_subject ) ) ?></textarea>
		      <?php else : ?>
                <strong><?php _e( 'Subject:', 'invite-anyone' ) ?></strong> <?php echo esc_html( invite_anyone_invitation_subject( $returned_subject ) ) ?>

                <input type="hidden" id="invite-anyone-customised-subject" name="invite_anyone_custom_subject" value="<?php echo esc_attr( invite_anyone_invitation_subject() ) ?>" />
		      <?php endif; ?>
          </li>

          <li>
		      <?php if ( $iaoptions['message_is_customizable'] == 'yes' ) : ?>
                <label for="invite-anyone-custom-message"><?php _e( '(optional) Customize the text of the invitation.', 'invite-anyone' ) ?></label>
                <p class="description"><?php _e( 'The message will also contain a custom footer containing links to accept the invitation or opt out of further email invitations from this site.', 'invite-anyone' ) ?></p>
                <textarea name="invite_anyone_custom_message" id="invite-anyone-custom-message" cols="40" rows="10"><?php echo esc_textarea( invite_anyone_invitation_message( $returned_message ) ) ?></textarea>
		      <?php else : ?>
                <label for="invite-anyone-custom-message"><?php _e( 'Message:', 'invite-anyone' ) ?></label>
                <textarea name="invite_anyone_custom_message" id="invite-anyone-custom-message" disabled="disabled"><?php echo esc_textarea( invite_anyone_invitation_message( $returned_message ) ) ?></textarea>

                <input type="hidden" name="invite_anyone_custom_message" value="<?php echo esc_attr( invite_anyone_invitation_message() ) ?>" />
		      <?php endif; ?>

          </li>

          <p>Invitees will receive invitations to this group when they join Zume.</p>

          <input type="hidden" name="invite_anyone_groups[]" id="invite_anyone_groups-<?php echo esc_attr( $group_id ) ?>" value="<?php echo esc_attr( $group_id ) ?>" checked />


		    <?php wp_nonce_field( 'invite_anyone_send_by_email', 'ia-send-by-email-nonce' ); ?>
		    <?php do_action( 'invite_anyone_addl_fields' ) ?>

        </ol>

<!--        <div class="submit">-->
<!--          <input type="submit" name="invite-anyone-submit" id="invite-anyone-submit" value="--><?php //_e( 'Send Invites', 'invite-anyone' ) ?><!-- " />-->
<!--        </div>-->


      </form>
      <?php
    }
	}


	class Invite_By_URL extends BP_Group_Extension {
		/**
		 * Your __construct() method will contain configuration options for
		 * your extension, and will pass them to parent::init()
		 */
		function __construct() {
			$args = array(
				'slug' => 'group_invite_by_url',
				'name' => 'Invite By URL',
				'screens' => array(
					'create' => array(
						'position' => 10,
					),
					'edit' => array(
						'enabled' => false,
					),
					'admin' => array(
						'enabled' => false,
					)
				),
//				'show_tab' => 'noone'
			);
			parent::init( $args );
		}




		function create_screen_save($group_id = NULL){
		  global $bp;
			update_option("testurl", $_POST);

			if (isset($_POST["redirect_invite"]) && $_POST["redirect_invite"] == "yes"){
				  bp_core_redirect( bp_get_group_permalink( $bp->groups->current_group ). "invite-anyone/");
			} else {
				  bp_core_redirect( "/dashboard");
      		}
		}



		function create_screen($group_id = NULL){
			global $bp;
			if ($group_id > 0){

		  $returned_data = !empty( $bp->invite_anyone->returned_data ) ? $bp->invite_anyone->returned_data : false;
			  $returned_groups = array( 0 );
	    if ( ! empty( $returned_data['groups'] ) ) {
		    foreach( $returned_data['groups'] as $group_id ) {
			    $returned_groups[] = $group_id;
		    }
	    }
        $returned_message = ! empty( $returned_data['message'] ) ? stripslashes( $returned_data['message'] ) : false;

			  	    // Get the returned email message, if there is one


        $group_name = "";
        $info_url = get_site_url() . "/about/?zume-group-id=".$group_id;
        $sign_up_url = get_site_url() . "?zume-group-id=".$group_id

        ?>

        <h3>To invite people to your group, copy and paste these 2 links:</h3>
          <p>They will be automatically added to this group.</p>
        <ul>
          <li>About Zume: <a href="<?php echo $info_url?>"><?php echo $info_url?></a></li>

          <li>Sign up: <a href="<?php echo $sign_up_url?>"><?php echo $sign_up_url?></a></li>
        </ul>

        <h3>Or copy and send this Email template:</h3>
          <p>

        <pre style="white-space: pre-line;">
          <?php echo esc_textarea( invite_anyone_invitation_message( $returned_message ) ) ?>
        </pre>

        </p>
          <p>
            <input type="checkbox" name="redirect_invite" id="redirect_invite" value="yes"  />
              Check this box if you would like the invite email to come from Zume instead.
            You will be redirected after you click finish.
          </p>

        <?php
      }
		}
	}

//  bp_register_group_extension( 'Invite_By_Email' );
	bp_register_group_extension( 'Invite_By_URL' );

endif; // if ( bp_is_active( 'groups' ) )