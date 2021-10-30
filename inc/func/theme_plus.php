<?php
/**
 * Copyright 2021, https://github.com/paopao233
 * All right reserved.
 *
 * @author parklot
 * @Content 主题加强Functions
 * @date 2021-8月-9日 20:29
 * @license GPL v3 LICENSE
 */
?>
<?php
const update_api = "https://www.guluqiu.online/wp-content/themes/baoLog/inc/update_api.json";
/**
 * 主题更新检验
 */
add_filter('site_transient_update_themes', 'theme_check_for_update');

function theme_check_for_update($transient)
{
    // Check Theme is active or not.
    if (empty($transient->checked['BaoLog']))
        return $transient;

    $request = theme_fetch_data_of_latest_version();

    if (is_wp_error($request) || wp_remote_retrieve_response_code($request) != 200) {
        return $transient;
    } else {
        $response = wp_remote_retrieve_body($request);
    }

    $data = json_decode($response);

    if (version_compare($transient->checked['BaoLog'], $data->new_version, '<')) {
        $transient->response['BaoLog'] = (array)$data;

        add_action('admin_notices', 'theme_update_admin_notice');
    }

    return $transient;
}

function theme_fetch_data_of_latest_version()
{
    // Your API call to check for new version
    $request = wp_safe_remote_get(update_api);

    return $request;
}

function theme_update_admin_notice()
{
    echo '<div class="notice notice-warning notice-alt is-dismissible">
          <p>New Theme Update is available.</p>
         </div>';
}