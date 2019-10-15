<?php

$handler = MailChimp_WooCommerce_Admin::connect();

// if we don't have valid campaign defaults we need to redirect back to the 'campaign_defaults' tab.
if (!$handler->hasValidApiKey()) {
    wp_redirect('admin.php?page=mailchimp-woocommerce&tab=api_key&error_notice=missing_api_key');
}

?>
<input type="hidden" name="mailchimp_active_settings_tab" value="store_info"/>

<fieldset class="">  
    <legend class="screen-reader-text">
        <span><?php esc_html_e('Store Settings', 'mc-woocommerce');?></span>
    </legend>
    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-name-label">
            <span> <?php esc_html_e('Name', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="text" id="<?php echo $this->plugin_name; ?>-store-name-label" name="<?php echo $this->plugin_name; ?>[store_name]" value="<?php echo isset($options['store_name']) ? $options['store_name'] : get_option('blogname') ?>" />
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-admin-email-label">
                <span> <?php esc_html_e('Email', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="email" id="<?php echo $this->plugin_name; ?>-admin-email-label" name="<?php echo $this->plugin_name; ?>[admin_email]" value="<?php echo isset($options['admin_email']) ? $options['admin_email'] : get_option('admin_email') ?>" />
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-address-label">
                <span> <?php esc_html_e('Street address', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="text" id="<?php echo $this->plugin_name; ?>-store-address-label" name="<?php echo $this->plugin_name; ?>[store_street]" value="<?php echo isset($options['store_street']) ? $options['store_street'] : WC()->countries->get_base_address(); ?>" />
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-city-label">
                <span> <?php esc_html_e('City', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="text" id="<?php echo $this->plugin_name; ?>-store-city-label" name="<?php echo $this->plugin_name; ?>[store_city]" value="<?php echo isset($options['store_city']) ? $options['store_city'] : WC()->countries->get_base_city(); ?>" />
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-state-label">
                <span> <?php esc_html_e('State', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="text" id="<?php echo $this->plugin_name; ?>-store-state-label" name="<?php echo $this->plugin_name; ?>[store_state]" value="<?php echo isset($options['store_state']) ? $options['store_state'] : WC()->countries->get_base_state(); ?>" />
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-postal-code-label">
                <span> <?php esc_html_e('Postal Code', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="text" id="<?php echo $this->plugin_name; ?>-store-postal-code-label" name="<?php echo $this->plugin_name; ?>[store_postal_code]" value="<?php echo isset($options['store_postal_code']) ? $options['store_postal_code'] : WC()->countries->get_base_postcode(); ?>" />
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-country-label">
                <span> <?php esc_html_e('Country', 'mc-woocommerce'); ?></span>
        </label>
        
        <?php global $woocommerce;
            $countries_obj   = new WC_Countries();
            $countries   = $countries_obj->__get('countries');
        ?>

        <div class="mailchimp-select-wrapper">
            <?php 
            woocommerce_form_field($this->plugin_name.'[store_country]', array(
                'type'          => 'select',
                'class'         => array( 'chzn-drop' ),
                'placeholder'   => __('Select a Country'),
                'options'       => $countries,
                'required'      => true
                ),
                isset($options['store_country']) ? $options['store_country'] : WC()->countries->get_base_country()
            );
            
            ?>
        </div>
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-phone-label">
                <span> <?php esc_html_e('Phone Number', 'mc-woocommerce'); ?></span>
        </label>
        <input required type="text" id="<?php echo $this->plugin_name; ?>-store-phone-label" name="<?php echo $this->plugin_name; ?>[store_phone]" value="<?php echo isset($options['store_phone']) ? $options['store_phone'] : '' ?>" />
    </div>

    <div class="box fieldset-header" >
        <h2 style="padding-top: 1em;"><?= __('Locale Settings', 'mc-woocommerce');?></h2>
        <br/>
        <p><?= __('Please apply your locale settings. If you\'re unsure about these, use the defaults.', 'mc-woocommerce');?></p>
    </div>

    <div class="box box-half" >
        <label for="<?php echo $this->plugin_name; ?>-store-locale-label">
            <span><?php esc_html_e('Locale', 'mc-woocommerce'); ?></span>
        </label>
        <div class="mailchimp-select-wrapper">
            <select name="<?php echo $this->plugin_name; ?>[store_locale]" required>
                <option disabled selected value="<?= __('','mc-woocommerce')?>"><?= __("Select store's locale",'mc-woocommerce')?></option>
                <?php $selected_locale = isset($options['store_locale']) && !empty($options['store_locale']) ? $options['store_locale'] : substr(get_locale(), 0, 2); ?>
                <?php foreach(MailChimp_Api_Locales::simple() as $locale_key => $local_value) : ?>
                    <option value="<?php echo esc_attr( $locale_key ) . '" ' . selected($locale_key === $selected_locale, true, false ); ?>"> <?php esc_html_e( $local_value ) ?> </option>;
                <?php endforeach;?>
            </select>
        </div>
    </div>

    <div class="box box-half" >
        <?php 
            $current_currency = isset($options['store_currency_code']) ? $options['store_currency_code'] : get_woocommerce_currency();
            $current_currency_data = MailChimp_WooCommerce_CurrencyCodes::getCurrency($current_currency);
        ?>
        <label for="<?php echo $this->plugin_name; ?>-store-currency-code-label">
            <span><?php esc_html_e('Woocommerce Currency', 'mc-woocommerce'); ?></span>
        </label>
        <input type="text" value="<?php echo isset($current_currency_data) ? $current_currency . ' | ' .  $current_currency_data['name']: $current_currency ?>" disabled/>
    </div>

    <div class="box" >
        <label for="<?php echo $this->plugin_name; ?>-store-timezone-label">
            <span><?php esc_html_e('Timezone', 'mc-woocommerce'); ?></span>
        </label>
        <div class="mailchimp-select-wrapper">
            <select name="<?php echo $this->plugin_name; ?>[store_timezone]" required>
                <option disabled selected value="<?= __('','mc-woocommerce')?>"><?= __("Select store's timezone",'mc-woocommerce')?></option>
                <?php $selected_timezone = isset($options['store_timezone']) && !empty($options['store_timezone']) ? $options['store_timezone'] : get_option('timezone_string'); ?>
                <?php
                    foreach(mailchimp_get_timezone_list() as $t) {
                    echo '<option value="' . esc_attr( $t['zone'] ) . '" ' . selected($t['zone'] === $selected_timezone, true, false ) . '>' . esc_html( $t['diff_from_GMT'] . ' - ' . $t['zone'] ) . '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</fieldset>