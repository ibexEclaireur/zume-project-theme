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
				'name' => 'Send Invite',
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

    function invite_message($group, $sign_up_url, $know_more_url){
		  $message = "Hey,

        I just signed up for a 9-week online training course, called Zúme Training. It teaches ordinary men and women, like ourselves, how to make disciples who make more disciples. In order to start the training, I need at least 3 other people to gather in-person with me each week.

        You can check out the course at " . $know_more_url . "

        To accept the invitation to join my Zúme Training group \"" .  $group->name . "\", click on this link: " . $sign_up_url ."

        After you click on the link, it will ask you to create an account. Then you will be joined to our group. When we have at least four people ready to gather together, we can begin going through Zúme Training.

        Let's learn how God can use people like us to change the world together,

        [Insert your name here]";

		  return $message;
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


        $group = groups_get_group($group_id);
        $token = groups_get_groupmeta($group_id, "group_token");
		    $know_more_url = get_site_url() . "/?group-id=".$group_id ."&zgt=" . $token;
        $sign_up_url = get_site_url() . "/register/?group-id=".$group_id ."&zgt=" . $token

        ?>

        <h2>To Invite people you have 3 options</h2>
        <p>Invite 3-11 friends, you have to have 4 people present to start the Zume Sessions.</p>
        <ul>
          <li>
            <p><strong>Send this invite link to your group</strong></p>
              <pre><a href="<?php echo $sign_up_url?>"><?php echo $sign_up_url?></a></pre></li>
          </li>

          <li>
            <p><strong>Copy and send this Email template:</strong></p>
            <p>

            <pre style="white-space: pre-line;">
              <?php echo esc_textarea( invite_anyone_invitation_message( $this->invite_message($group, $sign_up_url, $know_more_url) ) ) ?>
            </pre>

            </p>
          </li>
          <li>
            <p><strong>Have the email come from Zume:</strong></p>
            <p>
              <input type="checkbox" name="redirect_invite" id="redirect_invite" value="yes"  />
                Check this box if you would like the invite email to come from Zume.
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

	      $group = groups_get_group($group_id);
		    $token = groups_get_groupmeta($group_id, "group_token");
		    $know_more_url = get_site_url() . "/?group-id=".$group_id ."&zgt=" . $token;
		    $sign_up_url = get_site_url() . "/register/?group-id=".$group_id ."&zgt=" . $token;

		    ?>
          <h3>Invite 3-11 friends, you have to have 4 people present to start the Zume Sessions.</h3>
          <ul>
            <li>
              <p><strong>Send this invite link to your group</strong></p>
              <pre><a href="<?php echo $sign_up_url?>"><?php echo $sign_up_url?></a></pre></li>
            </li>

            <li>
              <p><strong>Copy and send this Email template:</strong></p>
              <p>

              <pre style="white-space: pre-line;">
              <?php echo esc_textarea( invite_anyone_invitation_message( $this->invite_message($group, $sign_up_url, $know_more_url) ) ) ?>
            </pre>

              </p>
            </li>
            <li>
              <p><strong>Have the email come from Zume:</strong></p>
              <p>
                Click <a href="<?php echo $this->get_invite_anyone_email_link($group_id)?>">here</a> if you would like the invite email to come from Zume.
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
