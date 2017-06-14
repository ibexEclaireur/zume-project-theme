<?php
/*
Template Name: Zúme Dashboard
*/

$zume_dashboard = Zume_Dashboard::instance();
$zume_current_user = get_current_user_id();
$zume_get_userLink = bp_core_get_userlink($zume_current_user, false, true);

get_header();

?>

    <div id="content">

        <div id="inner-content" class="row">

            <main id="main" class="large-12 medium-12 columns" role="main">



                <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

                    <header class="article-header">

                    </header> <!-- end article header -->

                    <section class="entry-content" itemprop="articleBody">


                        <!-- First Row -->
                        <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
                            <div class="medium-12 columns">
                                <div class="callout" data-equalizer-watch>
                                    <h2 class="center">Your Groups</h2>

                                    <?php if ( bp_has_groups(array('user_id' => get_current_user_id() ) ) ) : ?>

                                        <!--<div class="pagination">

                                            <div class="pag-count" id="group-dir-count">
                                                <?php /*bp_groups_pagination_count() */?>
                                            </div>

                                            <div class="pagination-links" id="group-dir-pag">
                                                <?php /*bp_groups_pagination_links() */?>
                                            </div>

                                        </div>
                                        -->
                                        <ul id="groups-list" class="item-list">
                                            <?php while ( bp_groups() ) : bp_the_group(); ?>
                                                <?php $member_count = bp_get_group_member_count(); ?>

                                                <li>
                                                    <div class="row">
                                                        <div class="medium-5 large-5 columns gutter-medium">
                                                            <div class="item-avatar">
                                                                <a href="<?php bp_group_permalink() ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ) ?></a>
                                                            </div>
                                                            <div>
                                                                <div class="item-title">
                                                                    <a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a>
                                                                </div>
                                                                <div class="wp-caption-text">
                                                                    <?php echo bp_get_group_description_excerpt() ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="medium-2 large-2 columns gutter-medium center">
                                                            <!--<span class="activity"><?php /*echo 'warning'; */?></span><br>-->

                                                            <span class="text-gray text-small"><?php bp_group_type() ?> <br> <?php echo $member_count; ?><br>
                                                            <?php /*echo 'active ' . bp_get_group_last_active() */?></span>

                                                        </div>
                                                        <div class="medium-5 large-5 columns gutter-medium center">
                                                            <div class="button-group">

                                                                <a href="<?php echo bp_get_group_permalink(). 'group_invite_by_url/'; ?>" class=" button  ">Invite <?php if($member_count < 4 ) { echo 4 - $member_count . ' more to start'; } ?></a>

                                                                <span class="hide-for-medium"><br></span>

                                                                <?php if($member_count > 3 ): // check if there are minimum 4 members ?>

                                                                    <?php // Next session button
                                                                    $group_next_session = zume_group_next_session(bp_get_group_id());

                                                                    if (is_null($group_next_session)): ?>
                                                                        <a href="/zume-training/?id=10&group_id=<?php bp_group_id() ?>" class="button   ">See Sessions</a>
                                                                    <?php else: ?>
                                                                        <a href="/zume-training/?id=<?php echo $group_next_session; ?>&group_id=<?php bp_group_id() ?>" class="button   ">Start session <?php echo $group_next_session; ?></a>
                                                                    <?php endif; ?>


                                                                <?php endif; ?>
                                                            </div>
                                                        </div>


                                                    <div class="clear"></div>
                                                </li>

                                            <?php endwhile; ?>
                                        </ul>


                                    <?php else: ?>

                                        <div id="message" class="info">
                                          <p>You are currently not in a group.</p>
                                          <p>Zume requires participants to go through the training in groups for several important reasons.
                                            You will need at least 4 people gathered together to start each new session. Please start a group below.</p>
                                          <p>If you intended to join someone else's group, please return to the invitation they sent and use
                                            the link provided to be automatically added to that group.</p>
                                        </div>

                                    <?php endif; ?>

                                    <p class="center">
                                        <a href="/groups/create/" class="button">Start New Group</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
                            <div class="medium-8 columns">
                                <div class="callout" data-equalizer-watch>

                                    <?php
                                    if ( bp_has_groups(array('user_id' => get_current_user_id() ) ) ) :

                                        $mod_ids = [];
                                        while ( bp_groups() ) {
                                            bp_the_group();
                                            $mod_ids = array_unique(array_merge(
                                                $mod_ids,
                                                bp_group_mod_ids(false, 'array')
                                            ));
                                        }
                                        ?>

                                        <h2 class="center"><?php echo _n("Your Coach", "Your Coaches", count($mod_ids)) ?></h2>

                                        <ul id="groups-list" class="item-list">
                                        <?php
                                        foreach ($mod_ids as $mod) :
                                        ?>

                                            <li>
                                                <div class="item-avatar">
                                                    <a href="<?php echo bp_core_get_userlink($mod, false, true) ?>"><?php  echo bp_core_fetch_avatar( array( 'item_id' => $mod) ) ?></a>
                                                </div>

                                                <div class="item">
                                                    <div class="item-title"><?php  echo bp_core_get_userlink($mod); ?></div>
                                                    <div class="item-meta"><span class="activity"><?php echo bp_core_get_last_activity( bp_get_user_last_activity( $mod ), __( 'active %s', 'buddypress' ) )  ?></span></div>

                                                    <div class="item-desc"><?php  ?> </div>

                                                    <?php do_action( 'bp_directory_groups_item' ) ?>
                                                </div>

                                                <div class="action">
                                                    <a href="<?php echo  wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . bp_core_get_username( $mod ) ); ?>" class="btn button">Private Message</a>

                                                    <div class="meta">

                                                    </div>

<!--                                                            --><?php //do_action( 'zume_directory_members_item' ) ?>
                                                </div>

                                                <div class="clear"></div>
                                            </li>

                                        <?php endforeach; // Coach Loop ?>

                                        </ul>

                                        <?php do_action( 'bp_after_groups_loop' ) ?>

                                        <?php if (empty($mod_ids)): ?>
                                            <div id="message" class="info">
                                                <p><?php _e("You have not yet been assigned any coaches.", "buddypress") ?></p>
                                            </div>
                                        <?php endif; ?>


                                    <?php else: ?>

                                        <h2 class="center">Your Coach</h2>
                                        <div id="message" class="info">
                                            <p><?php _e( 'You are not in any groups.', 'buddypress' ) ?></p>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="medium-4 columns">
                                <div class="callout" data-equalizer-watch>
                                    <h2 class="center">Messages</h2>

                                    <p class="center">
                                        <a href="<?php echo bp_core_get_userlink($zume_current_user, false, true) ; ?>/messages/" class="button">View Messages</a>
                                    </p>
                                    <p class="center text-gray text-small">
                                        <?php
                                        $unread_messages_count = bp_get_total_unread_messages_count();
                                        echo sprintf(_n("You have %s unread message.", "You have %s unread messages.", $unread_messages_count), $unread_messages_count);
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>



                    </section> <!-- end article section -->

                    <footer class="article-footer">

                    </footer> <!-- end article footer -->



                </article> <!-- end article -->



            </main> <!-- end #main -->

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>
