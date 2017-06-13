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




if (  function_exists( 'bp_is_active') &&  bp_is_active( 'groups' ) ) :

  function group_urls($group_id){
	  $token = groups_get_groupmeta($group_id, "group_token");
	  $know_more_url = get_site_url() . "/?group-id=".$group_id ."&zgt=" . $token;
	  $sign_up_url = get_site_url() . "/register/?group-id=".$group_id ."&zgt=" . $token;
	  return array("know_more"=>$know_more_url, "sign_up"=>$sign_up_url);
  }


	class Invite_By_URL extends BP_Group_Extension {
		/**
		 * Your __construct() method will contain configuration options for
		 * your extension, and will pass them to parent::init()
		 */

		function __construct() {
			$args = array(
				'slug' => 'group_invite_by_url',
				'name' => 'Invite your friends',
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
		  $message = "<p>Hey,</p>
        <p>I just signed up for a 9-week online training course, called Zúme Training. It teaches ordinary men and women, like ourselves, how to make disciples who make more disciples. In order to start the training, I need at least 3 other people to gather in-person with me each week.</p>
        <p>You can check out the course at <a href=\"" . $know_more_url . "\"> " . $know_more_url . "</a></p>
        <p>To accept the invitation to join my Zúme Training group \"" .  $group->name . "\", click on this link: <a href=\"". $sign_up_url ."\" >" . $sign_up_url ."</a></p>
        <p>After you click on the link, it will ask you to create an account. Then you will be joined to our group. When we have at least four people ready to gather together, we can begin going through Zúme Training.</p>
        <p>Let's learn how God can use people like us to change the world together,</p>
        <p>[Insert your name here]</p>";

		  return $message;
    }


		function create_screen_save($group_id = NULL){
      $group = groups_get_group($group_id);

			if (isset($_POST["redirect_invite"]) && $_POST["redirect_invite"] == "yes"){
				  bp_core_redirect( bp_get_group_permalink($group) . "group_invite_by_email/");
			} else {
				  bp_core_redirect( "/dashboard");
      		}
		}


		function invite_options($sign_up_url, $group, $know_more_url){
    ?>
      <h2 class="group-invite-hearer-with-text-under" style="margin-top:15px">To invite people you have 3 options:</h2>
      <p>Invite 3-11 friends, Zúme requires at least 4 people to be present to start each session.</p>

      <h3 class="group-invite-header group-invite-hearer-with-text-under"><strong>Option 1: </strong></h3>
      <span class="group-invite-header-side-text">
        Write your own message.
      </span>
      <p> Simply include this link and send it by email or any method you wish.</p>
      <pre><a href="<?php echo $sign_up_url?>"><?php echo $sign_up_url?></a></pre>

      <h3 class="group-invite-header"><strong>Option 2: </strong></h3>
      <span class="group-invite-header-side-text">Use our email template.</span>
        <div style="padding:10px; background-color:#eee; border:1px solid #cecece">
        <?php echo $this->invite_message($group, $sign_up_url, $know_more_url) ?>
        </div>

    <?php
    }

		function create_screen($group_id = NULL){
			global $bp;
			if ($group_id > 0){


        $group = groups_get_group($group_id);
        $urls = group_urls($group_id);
		    $know_more_url = $urls["know_more"];
        $sign_up_url = $urls["sign_up"];

        $this->invite_options($sign_up_url, $group, $know_more_url );
        ?>
        <h3 class="group-invite-header"><strong>Option 3:</strong></h3><span class="group-invite-header-side-text">Have the email come from Zúme.</span>
        <p>
          <input id="redirect_invite" class="checkbox-custom" name="redirect_invite" value="yes" type="checkbox">
          <label for="redirect_invite" class="checkbox-custom-label">
            Check this box if you would like the invitation email to come from Zúme.
            After you click "Finish" you will be redirected to the next page where you can add your friend's email addresses.
          </label>
        </p>
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
	      $urls = group_urls($group_id);
	      $know_more_url = $urls["know_more"];
	      $sign_up_url = $urls["sign_up"];


		    $this->invite_options($sign_up_url, $group, $know_more_url )
		    ?>
        <h3 class="group-invite-header"><strong>Option 3:</strong></h3><span class="group-invite-header-side-text">Have the email come from Zúme.</span>
        <p>
          Click <strong><a style="font-size: 14pt ;" href="<?php echo bp_get_group_permalink($group) . "group_invite_by_email/"?>">here</a></strong> if you would like the invitation email to come from Zúme.
          You can add your friend's email addresses on the next page.
        </p>

		    <?php
	    }
	  }


	}

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
            "create" => array(
                "enabled" => false
            )
        ),
				'show_tab' => 'noone'
			);
			parent::init( $args );
		}


    function display( $group_id = NULL ) {
      $this->settings_screen($group_id);
    }


		function settings_screen_save($group_id = NULL){

			update_option("save_group_email", $_POST);

		}







		function settings_screen($group_id = NULL){
			global $bp;


			$group = groups_get_group($group_id);
      $urls = group_urls($group_id);
      $know_more_url = $urls["know_more"];
      $sign_up_url = $urls["sign_up"];
      $current_user = wp_get_current_user();

      $message = "";
      $subject = "";

			?>
          <form id="invite_by_email" action="/wp-admin/admin-post.php" method="post">
            <h4>Invite Friends to <?php echo $group->name ?></h4>

            <ol id="invite-anyone-steps">
              <li>
                <div class="manual-email">
                  <p>
					          <?php _e( 'Enter email addresses below, one per line.', 'zume_project' ) ?>
                    <textarea name="invite_by_email_addresses" rows="15" cols="10" class="invite-anyone-email-addresses" id="invite-by-email-addresses"></textarea>
                  </p>
                </div>
              </li>

<!--              <li>-->
<!--                    <label for="invite-anyone-custom-subject">--><?php //_e( '(optional) Customize the subject line of the invitation email.', 'zume_project' ) ?><!--</label>-->
<!--                    <textarea name="invite_anyone_custom_subject" id="invite-anyone-custom-subject" rows="1" cols="10" >--><?php //echo esc_textarea( invite_anyone_invitation_subject( $subject ) ) ?><!--</textarea>-->
<!--              </li>-->
<!--              <li>-->
<!--                    <label for="invite-anyone-custom-message">--><?php //_e( '(optional) Customize the text of the invitation.', 'zume_project' ) ?><!--</label>-->
<!--                    <p class="description">--><?php //_e( 'The message will also contain a custom footer containing links to accept the invitation or opt out of further email invitations from this site.', 'invite-anyone' ) ?><!--</p>-->
<!--                    <textarea name="invite_anyone_custom_message" id="invite-anyone-custom-message" cols="40" rows="15">--><?php //echo $message ?><!--</textarea>-->
<!---->
<!--              </li>-->

              <p>We will send an invitation to each email address to sign up to Zúme and join this group</p>

				    <?php wp_nonce_field( 'invite_by_email') ?>
            <input type="hidden" name="action" value="group_invite_by_email">
            <input type="hidden" name="group_id" value=" <?php echo esc_attr( $group_id )?>">
            <input type="hidden" name="inviter_name" value=" <?php echo esc_attr( $current_user->display_name )?>">
            <input type="hidden" name="sign_up_url" value=" <?php echo esc_attr( $sign_up_url )?>">


            </ol>

              <div class="submit">
                <input type="submit" name="invite-anyone-submit" id="invite-anyone-submit" value="<?php _e( 'Send Invites', 'zume-project' ) ?> " />
              </div>

          </form>
			<?php
		}
	}



	bp_register_group_extension( 'Invite_By_URL' );
  bp_register_group_extension( 'Invite_By_Email' );
endif; // if ( bp_is_active( 'groups' ) )
