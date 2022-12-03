<?php
/**
 * Project : everpsmondialrelay
 * @author Team Ever
 * @link http://team-ever.com
 * @copyright Team Ever
 * @license   Tous droits réservés / Le droit d'auteur s'applique (All rights reserved / French copyright law applies)
 */

class EverPsMondialRelayClass extends ObjectModel
{
    /**
     * @var int When a relay is selected, a native Prestashop address will be created and
     * associated to the order
     */
    public $id_address_delivery;

    /**
     * @var int We could retrieve this from the cart, but this will ease the
     * joinings
     */
    public $id_customer;

    /**
     * @var int The Mondial Relay carrier method selected during checkout; this
     * could also be retrieved from the order's carrier
     */
    public $id_mondialrelay_carrier_method;

    /**
     * @var int The cart being shipped
     */
    public $id_cart;

    /**
     * @var int The order associated to the cart
     */
    public $id_order;

    /**
     * @var int The package weight; can be specified by the merchant when
     * generating the label
     */
    public $package_weight;

    /**
     * @var string The Mondial Relay insurance level; defaults to the one
     * from the carrier method, but can be set when generating the label
     */
    public $insurance_level;

    /**
     * @var string The relay's Mondial Relay identifier ("Num" field)
     */
    public $selected_relay_num;

    /**
     * @var string The relay's name; line 1 ("LgAdr1" field)
     */
    public $selected_relay_adr1;

    /**
     * @var string The relay's name; line 2 ("LgAdr2" field)
     */
    public $selected_relay_adr2;

    /**
     * @var string The relay's address; line 3 ("LgAdr3" field)
     */
    public $selected_relay_adr3;

    /**
     * @var string The relay's address; line 4 ("LgAdr4" field)
     */
    public $selected_relay_adr4;

    /**
     * @var string The relay's postcode ("CP" field)
     */
    public $selected_relay_postcode;

    /**
     * @var string The relay's city ("Ville" field)
     */
    public $selected_relay_city;

    /**
     * @var string The relay's country iso code ("Pays" field)
     */
    public $selected_relay_country_iso;

    /**
     * @var string The order's tracking url
     */
    public $tracking_url;

    /**
     * @var string The order's label url
     */
    public $label_url;

    /**
     * @var string The order's expedition number
     */
    public $expedition_num;

    /**
     * @var string The order's label generation date
     */
    public $date_label_generation;

    /**
     * @var bool Should this order be logged in history ?
     * Interesting sidenote : if a field has a non-zero default value (weak
     * comparison), we'll never be able to set it to 0 (weak comparison)
     * @see ObjectModel::validateField()
     */
    public $hide_history;

    // PS default fields
    public $date_add;
    public $date_upd;

    public static $definition = array(
        'table'   => 'mondialrelay_selected_relay',
        'primary' => 'id_mondialrelay_selected_relay',
        'fields'  => array(
            'id_address_delivery'            => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'allow_null' => true),
            'id_customer'                    => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'allow_null' => true),
            'id_mondialrelay_carrier_method' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'allow_null' => true),
            'id_cart'                        => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'allow_null' => true),
            'id_order'                       => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'allow_null' => true),
            'package_weight'                 => array('type' => self::TYPE_STRING, 'size' => 7, 'allow_null' => true),
            'insurance_level'                => array('type' => self::TYPE_STRING, 'values' => array(0, 1, 2, 3, 4, 5), 'default' => 0, 'size' => 1, 'allow_null' => true),
            // Mondial Relay fields, from webservice function WSI4_PointRelais_Recherche
            // These fields *could* always be retrieved from the webservice
            'selected_relay_num'             => array('type' => self::TYPE_STRING, 'size' => 6, 'allow_null' => true),
            'selected_relay_adr1'            => array('type' => self::TYPE_STRING, 'size' => 36, 'allow_null' => true),
            'selected_relay_adr2'            => array('type' => self::TYPE_STRING, 'size' => 36, 'allow_null' => true),
            'selected_relay_adr3'            => array('type' => self::TYPE_STRING, 'size' => 36, 'allow_null' => true),
            'selected_relay_adr4'            => array('type' => self::TYPE_STRING, 'size' => 36, 'allow_null' => true),
            'selected_relay_postcode'        => array('type' => self::TYPE_STRING, 'size' => 10, 'allow_null' => true),
            'selected_relay_city'            => array('type' => self::TYPE_STRING, 'size' => 32, 'allow_null' => true),
            'selected_relay_country_iso'     => array('type' => self::TYPE_STRING, 'size' => 2, 'allow_null' => true),
            //
            'tracking_url'                   => array('type' => self::TYPE_STRING, 'size' => 1000, 'allow_null' => true),
            'label_url'                      => array('type' => self::TYPE_STRING, 'size' => 1000, 'allow_null' => true),
            'expedition_num'                 => array('type' => self::TYPE_STRING, 'size' => 8, 'allow_null' => true),
            'date_label_generation'          => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'allow_null' => true),
            'hide_history'                   => array('type' => self::TYPE_BOOL, 'default' => 0, 'validate' => 'isBool'),
            'date_add'                       => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd'                       => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        ),
    );
}
