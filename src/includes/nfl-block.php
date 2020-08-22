<?php

define('RESULTA_NFL_TEAMS_CACHE_KEY', 'resulta-nfl-teams');
define('RESULTA_NFL_TEAMS_ENDPOINT_OPTION', 'resulta-nfl-endpoint');
define('RESULTA_NFL_TEAMS_APIKEY_OPTION', 'resulta-nfl-api-key');
define('RESULTA_NFL_TEAMS_CACHE_EXPIRE_OPTION', 'resulta-nfl-cache-expire');

add_action(
    'init',
    function () {
        // Options
        add_option(RESULTA_NFL_TEAMS_ENDPOINT_OPTION, 'http://delivery.chalk247.com/team_list/NFL.JSON');
        add_option(RESULTA_NFL_TEAMS_APIKEY_OPTION, '74db8efa2a6db279393b433d97c2bc843f8e32b0');

        register_block_type(
            'resulta/block-resulta-nfl-teams',
            array(
                'attributes' => [],
                'render_callback' => 'resulta_render_nfl_teams',
            )
        );
    }
);

/**
 *
 * Create the shortcode
 *
 */
add_shortcode('nfl-teams', 'resulta_render_nfl_teams');

/**
 *
 * Render NFL teams
 *
 */
function resulta_render_nfl_teams()
{
    $teams = resulta_get_nfl_teams();

    // Calculates how many conferences and columns factor
    $num_conferences = count($teams);
    $columns_factor = floor(12 / $num_conferences);

    ob_start();
?>
    <?php if(empty($teams)): 
        resulta_render_nfl_team_no_data();
    else: ?>
    <div class="container">
        <div class="row">
            <?php foreach ($teams as $name => $conference) : ?>
                <div class="col-sm-<?php echo $columns_factor ?>">
                    <h2 class="conference-title"><?php echo $name ?></h2>
                    <?php foreach ($conference as $team) : ?>
                        <?php resulta_render_nfl_team_card($team); ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
<?php
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

/**
 *
 * Render NFL team card
 *
 */
function resulta_render_nfl_team_card($team)
{
?>
    <div class="team-card">
        <h5 class="team-title"><?php echo $team['name'] . ' ' . $team['nickname'] ?></h5>
        <p>Division: <?php echo $team['division'] ?></p>
    </div>
<?php
}

/**
 *
 * Render No data available
 *
 */
function resulta_render_nfl_team_no_data()
{
?>
    <div class="container">
        <div class="row">
        <div class="col-sm-12"><h6>oops, No data available.</h6</div>
        </div>
    </div>
<?php
}

/**
 *
 * Get the lists of teams from transient and also controls the expire
 * Looking for eficieny and avoid API calls
 *
 */
function resulta_get_nfl_teams()
{

    $teams = get_transient(RESULTA_NFL_TEAMS_CACHE_KEY);

    // No/Expired cache: Call the endpoint and update the cache
    if (!$teams) {
        $endpoint = get_option(RESULTA_NFL_TEAMS_ENDPOINT_OPTION);
        $api_key = get_option(RESULTA_NFL_TEAMS_APIKEY_OPTION);
        $cache_expire = get_option(RESULTA_NFL_TEAMS_CACHE_EXPIRE_OPTION, 15);

        $endpoint = "$endpoint?api_key=$api_key";

        $response = wp_remote_get($endpoint);
        if (is_wp_error($response)) {
            return null;
        }

        // Extracting the data
        $body = json_decode($response['body'], true);
        $raw_teams = $body['results']['data']['team'];

        //Grouping them in conferences
        $teams = [];
        foreach ($raw_teams as $team) {
            $teams[$team['conference']][] = $team;
        }

        // Expires in 15 minutes
        set_transient(RESULTA_NFL_TEAMS_CACHE_KEY, $teams, $cache_expire * MINUTE_IN_SECONDS);
    }

    return $teams;
}
