<?php
/*
Template Name: Zúme Coaches
*/
if ( !current_user_can( "administrator" ) && !current_user_can( "coach" ) ){
    wp_redirect( "dashboard" );
}

get_header();

$zume_states = array(
    'all' => 'All',
    'AL' => 'Alabama',
    'AK' => 'Alaska',
    'AZ' => 'Arizona',
    'AR' => 'Arkansas',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DE' => 'Delaware',
    'DC' => 'District of Columbia',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'HI' => 'Hawaii',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'IA' => 'Iowa',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'ME' => 'Maine',
    'MD' => 'Maryland',
    'MA' => 'Massachusetts',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MS' => 'Mississippi',
    'MO' => 'Missouri',
    'MT' => 'Montana',
    'NE' => 'Nebraska',
    'NV' => 'Nevada',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NY' => 'New York',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VT' => 'Vermont',
    'VA' => 'Virginia',
    'WA' => 'Washington',
    'WV' => 'West Virginia',
    'WI' => 'Wisconsin',
    'WY' => 'Wyoming',
);

?>

<div id="content">
    <div id="inner-content" class="row">

        <main id="main" class="large-12 medium-12 columns" role="main">

            <label for="state-select">Select State</label>
            <select id="state-select">
                <?php
                foreach ( $zume_states as $zume_state => $label ){ ?>
                    <option value="<?php echo esc_html( $zume_state ) ?>"> <?php echo esc_html( $label ) ?> </option>
                <?php } ?>

            </select>
            <div>
            <label for="members" style="display: inline-block">Ony show groups with 4 or more members?</label>
            <input type="checkbox" id="members">
            </div>
            <label for="session">On or past session:</label>
            <select id="session">
                <option value="any" selected>Any</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>

            <p style="margin-top: 10px">
                <button type="button" id="filter-table" class="button">Filter</button>
            </p>
            <table id="coaches-table">
                <thead>
                    <tr>
                        <td>Member Count</td>
                        <td>Session</td>
                        <td>Leader Name</td>
                        <td>Leader Email</td>
                        <td>Group Address</td>
                        <td>State</td>
                        <td>County</td>
                        <td>Census Tract</td>
                        <td>Date Created</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <h3>Just emails</h3>
            <div id="emails"></div>
        </main>
    </div>
</div>


