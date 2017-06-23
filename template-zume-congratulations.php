<?php
/*
Template Name: Zúme Congratulations on completing
*/

get_header();

?>

<div class="row block">
    <div class="step-title" style="text-transform: uppercase">Congratulations on completing Zúme training!</div>
</div>

<div class="row block">
    <div class="activity-title"><span>WATCH</span></div>
    <div class="activity-description">
        You and your group are now ready to take leadership to a new level!
        Here are a few more steps to help you KEEP growing!
    </div>
</div>

<div class="row block">
    <div class="small-12 small-centered medium-9 columns">
        <script src="//fast.wistia.com/embed/medias/h3znainxm9.jsonp" async></script>
        <script src="//fast.wistia.com/assets/external/E-v1.js" async></script>
        <div class="wistia_embed wistia_async_h3znainxm9" >&nbsp;</div>
    </div>
</div>

<div class="row block">
    <div class="activity-title"><span>GROW</span></div>
    <div class="activity-description">
        <p style="text-transform: uppercase">Grow as a disciple by putting your faith to work</p>
        <p>
            Consider registering online for reminders, coaching resources, and to become connected
            with others who are using the same sort of mininistry approach.
            You can do this at ZumeProject.com.
        </p>
    </div>
</div>

<div class="row block">
    <div class="activity-title"><span>ACT</span></div>
    <div class="activity-description">
        <div class="congratulations-more">
            <button class="button js-congratulations-more-button" data-item="learn-more">
                <div class="congratulations-icon congratulations-icon-learn-more"></div>
                <span>Learn More</span>
            </button>
            <button class="button js-congratulations-more-button" data-item="invite">
                <div class="congratulations-icon congratulations-icon-invite"></div>
                <span>Invite my friends</span>
            </button>
            <button class="button js-congratulations-more-button" data-item="coordinator">
                <div class="congratulations-icon congratulations-icon-coordinator"></div>
                <span>Become a county coordinator</span>
            </button>
            <button class="button js-congratulations-more-button" data-item="map">
                <div class="congratulations-icon congratulations-icon-map"></div>
                <span>Map my neighborhood</span>
            </button>
            <button class="button js-congratulations-more-button" data-item="language">
                <div class="congratulations-icon congratulations-icon-language"></div>
                <span>Fund translation of Zúme</span>
            </button>
            <button class="button js-congratulations-more-button" data-item="contact-coach">
                <div class="congratulations-icon congratulations-icon-contact-coach"></div>
                <span>Contact my coach</span>
            </button>
        </div>

        <div class="congratulations-more__text js-congratulations-more-item" data-item="learn-more" hidden>
            <p>
                Find additional information on some of the multiplication concepts at
                <a href="http://metacamp.org/multiplication-concepts/" target="_blank">
                    http://metacamp.org/multiplication-concepts/
                </a>
                or ask questions about specific resources at
                <a href="mailto:info@zumeproject.com">info@zumeproject.com</a>.
            </p>
            <p class="center">
                <a class="button" href="http://metacamp.org/multiplication-concepts/" target="_blank">Learn more</a>
            </p>
        </div>
        <div class="congratulations-more__text js-congratulations-more-item" data-item="invite" hidden>
            <p>
                You can put what you know to work is by helping spread the word about Zúme Training and
                inviting others to go through training, too. We make it easy to invite friends through
                email, Facebook, Twitter, Snapchat and other social sites, but we can&rsquo;t invite your
                friends for you.
            </p>
            <?php
            $group = groups_get_group(['group_id' => 10]); // TODO: fix this
            ?>
            <p class="center">
                <?php /* <a class="button" href="<?php echo bp_get_group_permalink($group) . 'group_invite_by_url/'; ?>">Invite my friends</a> */ ?>
                <a class="button" href="#">TODO</a>
            </p>
        </div>
        <div class="congratulations-more__text js-congratulations-more-item" data-item="coordinator" hidden>
            <p>
                One of the ways you can put what you know to work is by becoming a county coordinator,
                that is someone who can help connect groups as they get started in your area. If you’re
                the kind of person who likes to help people go and grow, this might be a way God can use
                your gifts to do even more. Let us know by sending an email to
                <a href="mailto:info@zumeproject.com">info@zumeproject.com</a>.
            </p>
            <p class="center">
                <a class="button" href="/dashboard/#your-coaches">Contact my coach</a>
            </p>
        </div>
        <div class="congratulations-more__text js-congratulations-more-item" data-item="map" hidden>
            <p>
                We are working with
                <a href="http://www.mappingcenter.org" target="_blank">http://www.mappingcenter.org</a>
                to try to provide you with free information on the residents within your census tract in
                order to help you more effectively reach it. "Stay tuned" for more information. If you do
                not have relationships within your census tract and are looking for ways to connect with
                your neighbors, you might consider the Mapping Your Neighborhood program for disaster
                preparedness. You can find information and downloadable resources at
                <a href="http://mil.wa.gov/emergency-management-division/preparedness/map-your-neighborhood" target="_blank">
                    http://mil.wa.gov/emergency-management-division/preparedness/map-your-neighborhood
                </a>.
            </p>
            <p class="center">
                <a class="button" href="http://www.mappingcenter.org/" target="_blank">Map my neighborhood</a>
            </p>
        </div>
        <div class="congratulations-more__text js-congratulations-more-item" data-item="language" hidden>
            <p>
                As Zúme Training grows, sessions will soon be available in 34 more languages. As we bring
                those trainings online, we’ll send you information on people in your neighborhood that
                speak those languages, so you can share something that’s built just for them. You can
                help fund the translation of the Zúme Training into additional languages by donating at
                <a href="https://big.life/donate" target="_blank">https://big.life/donate</a> and
                designating the gift for the Zúme Project with a note about the language you would like
                to fund.
            </p>
            <p class="center">
                <a class="button" href="https://big.life/donate" target="_blank">Fund translation of Zúme</a>
            </p>
        </div>
        <div class="congratulations-more__text js-congratulations-more-item" data-item="contact-coach" hidden>
            <p class="center">
                <a class="button" href="/dashboard/#your-coaches">Contact my coach</a>
            </p>
        </div>

    </div>
</div>

<?php get_footer(); ?>
