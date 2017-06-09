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
        $sign_up_url = get_site_url() . "/register?zume-group-id=".$group_id

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
                <?php echo esc_textarea( invite_anyone_invitation_message( $returned_message ) ) ?>
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
	}

	bp_register_group_extension( 'Invite_By_URL' );

endif; // if ( bp_is_active( 'groups' ) )
