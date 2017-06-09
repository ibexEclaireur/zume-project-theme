<?php
/*
Template Name: Zume Dashboard
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
                            <div class="medium-4 columns">
                                <div class="callout" data-equalizer-watch>
                                    <h2 class="center">Start a Group</h2>
                                    <p class="center " style="height:175px;">
                                        <a href="/groups/create/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/training.jpg"  /></a><br><br>
                                    </p>
                                    <p class="center"><a href="/groups/create/" class="button">New Group</a></p>

                                </div>
                            </div>
                            <div class="medium-4 columns">
                                <div class="callout" data-equalizer-watch>
                                    <a href="<?php echo $zume_get_userLink . '/invite-anyone/'; ?>">
                                    <h2 class="center">Connect</h2>
                                    <p class="center" style="height:175px;">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/invite.jpg"  class="center" /><br>
                                    </p>
                                    <p class="center" >
                                        <a href="<?php echo $zume_get_userLink . '/invite-anyone/';?>" class="button">Send Invites</a>
                                    </p>
                                    </a>
                                </div>
                            </div>
                            <div class="medium-4 columns">
                                <div class="callout" data-equalizer-watch>
                                    <a href="<?php echo $zume_get_userLink; ?>">
                                    <h2 class="center">Profile</h2>
                                        <p class="center" style="height:175px;">
                                            <?php echo bp_core_fetch_avatar( array( 'item_id' => $zume_current_user, 'type' => 'full', 'css_id' => 'dashboard-avatar' ) ); ?>
                                        </p>
                                    <p class="center" >
                                       <a href="<?php echo bp_core_get_userlink($zume_current_user, false, true) ; ?>" class="button">View Profile</a>
                                    </p>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <!--Second Row-->
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

                                                            <span class="text-gray text-small"><?php bp_group_type() ?> <br> <?php bp_group_member_count() ?><br>
                                                            <?php /*echo 'active ' . bp_get_group_last_active() */?></span>

                                                        </div>
                                                        <div class="medium-5 large-5 columns gutter-medium center">
                                                            <div class="button-group">
                                                                <a href="<?php echo $zume_get_userLink . 'invite-anyone/invite-new-members/group-invites/' . bp_get_group_id(); ?>" class=" button  ">Invite</a>
                                                                <span class="hide-for-medium"><br></span>
                                                                <a href="<?php bp_group_permalink() ?>" class=" button  ">View Group</a>
                                                                <span class="hide-for-medium"><br></span>
                                                                <a href="/zume-training/?id=<?php echo zume_group_next_session(bp_get_group_id()) ?>&group_id=<?php echo bp_group_id() ?>" class="button   ">Next Session</a>
                                                            </div>
                                                        </div>


                                                    <div class="clear"></div>
                                                </li>

                                            <?php endwhile; ?>
                                        </ul>


                                    <?php else: ?>

                                        <div id="message" class="info">
                                            <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Third Row -->
                        <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
                            <div class="medium-8 columns">
                                <div class="callout" data-equalizer-watch>
                                    <h2 class="center">Your Coaches</h2>

                                    <?php if ( bp_has_groups(array('user_id' => get_current_user_id() ) ) ) : ?>

                                        <ul id="groups-list" class="item-list">

                                            <?php while ( bp_groups() ) : bp_the_group(); ?>

                                                <?php foreach (bp_group_mod_ids(false, 'array') as $mod) : ?>

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

                                            <?php endwhile; // Group loop ?>
                                        </ul>

                                        <?php do_action( 'bp_after_groups_loop' ) ?>

                                    <?php else: ?>

                                        <div id="message" class="info">
                                            <p><?php _e( 'You have no coaches assigned.', 'buddypress' ) ?></p>
                                        </div>

                                    <?php endif; ?>




                                </div>
                            </div>
                            <!--<div class="medium-4 columns">
                                <div class="callout" data-equalizer-watch>
                                    <p class="center">Zúme</p>
                                    <br><br><br><br>
                                </div>
                            </div>-->
                            <div class="medium-4 columns">
                                <div class="callout" data-equalizer-watch>
                                    <h2 class="center">Resources</h2>

                                    <ul>
                                        <li><a href="">Zume Handbook</a></li>
                                    </ul>
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
