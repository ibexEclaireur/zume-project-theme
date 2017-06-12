<?php


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

function bpex_remove_group_tabs() {

/**
 * @since 2.6.0 Introduced the $component parameter.
 *
 * @param string $slug      The slug of the primary navigation item.
 * @param string $component The component the navigation is attached to. Defaults to 'members'.
 * @return bool Returns false on failure, True on success.
 */

	if ( ! bp_is_group() ) {
		return;
	}

	$slug = bp_get_current_group_slug();
        // all existing default group tabs are listed here. Uncomment or remove.
//		bp_core_remove_subnav_item( $slug, 'members' );
//		bp_core_remove_subnav_item( $slug, 'send-invites' );
		bp_core_remove_subnav_item( $slug, 'invite-anyone' );
//		bp_core_remove_subnav_item( $slug, 'admin' );
//		bp_core_remove_subnav_item( $slug, 'forum' );

}
add_action( 'bp_actions', 'bpex_remove_group_tabs' );

if ( !defined( 'BP_INVITE_ANYONE_SLUG' ) )
	define( 'BP_INVITE_ANYONE_SLUG', 'invite-anyone' );

if ( bp_is_active( 'groups' ) ) :


	class Invite_By_URL extends BP_Group_Extension {
		/**
		 * Your __construct() method will contain configuration options for
		 * your extension, and will pass them to parent::init()
		 */

		function __construct() {
			$args = array(
				'slug' => 'group_invite_by_url',
				'name' => 'Invite By URL',
        "visibility" => "private",
        "show_tab"=> 'members',
        "access" => "members",


			);
			parent::init( $args );
		}

		function get_invite_anyone_email_link($group_id){
		  return bp_loggedin_user_domain() . BP_INVITE_ANYONE_SLUG . '/invite-new-members/group-invites/' . $group_id;
    }

    function display( $group_id = NULL ) {
      $this->settings_screen($group_id);
    }


		function create_screen_save($group_id = NULL){
			if (isset($_POST["redirect_invite"]) && $_POST["redirect_invite"] == "yes"){
				  bp_core_redirect( $this->get_invite_anyone_email_link($group_id));
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



        $token = groups_get_groupmeta($group_id, "group_token");
        update_option("group_token_test", $token);

        $sign_up_url = get_site_url() . "/register/?group-id=".$group_id ."&zgt=" . $token

        ?>

        <h2>To Invite people you have 3 options</h2>
        <p>Invite 3-11 friends, you have to have 4 people present to start the Zúme Sessions.</p>
        <ul>
          <li>
            <p><strong>Send this invite link to your group</strong></p>
              <pre><a href="<?php echo $sign_up_url?>"><?php echo $sign_up_url?></a></pre></li>
          </li>

          <li>
            <p><strong>Copy and send this Email template:</strong></p>
            <p>

            <pre style="white-space: pre-line;">
              <?php echo esc_textarea( invite_anyone_invitation_message( $returned_message ) ) ?>
            </pre>

            </p>
          </li>
          <li>
            <p><strong>Have the email come from Zúme:</strong></p>
            <p>
              <input type="checkbox" name="redirect_invite" id="redirect_invite" value="yes"  />
                Check this box if you would like the invite email to come from Zúme.
              You will be redirected after you click finish.
            </p>
          </li>
        </ul>
        <?php
      }
		}


	  /**
	   * settings_screen() is the catch-all method for displaying the content
	   * of the edit, create, and Dashboard admin panels
	   */
	  function settings_screen( $group_id = NULL ) {
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



		    $token = groups_get_groupmeta($group_id, "group_token");
		    update_option("group_token_test", $token);

		    $sign_up_url = get_site_url() . "/register/?group-id=".$group_id ."&zgt=" . $token

		    ?>
          <h3>Invite 3-11 friends, you have to have 4 people present to start the Zúme Sessions.</h3>
          <ul>
            <li>
              <p><strong>Send this invite link to your group</strong></p>
              <pre><a href="<?php echo $sign_up_url?>"><?php echo $sign_up_url?></a></pre></li>
            </li>

            <li>
              <p><strong>Copy and send this Email template:</strong></p>
              <p>

              <pre style="white-space: pre-line;">
              <?php echo esc_textarea( invite_anyone_invitation_message( $returned_message ) ) ?>
            </pre>

              </p>
            </li>
            <li>
              <p><strong>Have the email come from Zúme:</strong></p>
              <p>
                Click <a href="<?php echo $this->get_invite_anyone_email_link($group_id)?>">here</a> if you would like the invite email to come from Zúme.
                You will be redirected after you click finish.
              </p>
            </li>
          </ul>
		    <?php
	    }
	  }


	}

	bp_register_group_extension( 'Invite_By_URL' );

endif; // if ( bp_is_active( 'groups' ) )
