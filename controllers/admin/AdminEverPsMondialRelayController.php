<?php
/**
 * Project : everpsmondialrelay
 * @author Team Ever
 * @link http://team-ever.com
 * @copyright Team Ever
 * @license   Tous droits réservés / Le droit d'auteur s'applique (All rights reserved / French copyright law applies)
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once _PS_MODULE_DIR_.'everpsmondialrelay/classes/EverPsMondialRelayClass.php';

/**
 * @property Order $object
 */
class AdminEverPsMondialRelayController extends ModuleAdminController
{
    public $toolbar_title;

    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'mondialrelay_selected_relay';
        $this->className = 'EverPsMondialRelayClass';
        $this->identifier = "id_mondialrelay_selected_relay";
        $this->lang = false;
        $this->deleted = false;
        $this->colorOnBackground = false;
        $this->context = Context::getContext();

        $this->_select = '
            a.*, o.reference,
            CONCAT(LEFT(c.`firstname`, 1), \'. \', c.`lastname`) AS `customer`';

        $this->_join = '
            LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = a.`id_customer`)
            LEFT JOIN `' . _DB_PREFIX_ . 'orders` o ON (o.`id_order` = a.`id_order`)';

        $this->fields_list = array(
            'id_mondialrelay_selected_relay' => array(
                'title' => 'ID',
                'align' => 'center',
                'width' => 25
            ),
            'reference' => array(
                'title' => 'Order reference',
                'width' => 'auto'
            ),
            'selected_relay_num' => array(
                'title' => 'selected_relay_num',
                'width' => 'auto'
            ),
            'customer' => array(
                'title' => 'Customer',
                'width' => 'auto',
                'orderby' => false,
                'search' => false,
            )
        );

        parent::__construct();
    }

    public function renderList()
    {
        $this->initToolbar();
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $lists = parent::renderList();
        $html=$this->context->smarty->fetch(_PS_MODULE_DIR_ . '/everpsmondialrelay/views/templates/admin/header.tpl');
        $html .= $lists;
        $html .= $this->context->smarty->fetch(_PS_MODULE_DIR_ . '/everpsmondialrelay/views/templates/admin/footer.tpl');

        return $html;
    }

    public function renderForm()
    {
        $customers = Customer::getCustomers();
        $carriers = Carrier::getCarriers($this->context->language->id);
        // Building the Add/Edit form
        $this->fields_form = array(
            'tinymce' => true,
            'description' => 'Veuillez renseigner les informations nécessaires à la bonne configuration des points relais. Merci de ne pas mettre de guillemets pour les enregistrements dans la base de données.',
            'submit' => array(
                'name' => 'save',
                'title' => 'Enregistrer',
                'class' => 'button pull-right'
            ),
            'input' => array(
                array(
                    'type' => 'select',
                    'label' => 'ID client',
                    'desc'      => 'Saisissez l\'ID du client',
                    'required' => true,
                    'name' => 'id_customer',
                    'options' => array(
                        'query' => $customers,
                        'id' => 'id_customer',
                        'name' => 'lastname'
                    )
                ),
                array(
                    'type' => 'select',
                    'label' => 'ID transporteur',
                    'desc'      => 'Saisissez l\'ID du transporteur',
                    'required' => true,
                    'name' => 'id_mondialrelay_carrier_method',
                    'options' => array(
                        'query' => $carriers,
                        'id' => 'id_carrier',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'text',
                    'label' => 'ID panier',
                    'desc'      => 'Saisissez l\'identifiant du panier',
                    'required' => true,
                    'name' => 'id_cart',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Numéro du point relais',
                    'desc'      => 'Saisissez le numéro du point relais',
                    'required' => true,
                    'name' => 'selected_relay_num',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Champ adresse 1',
                    'desc'      => 'Saisissez le champ adresse 1',
                    'required' => true,
                    'name' => 'selected_relay_adr1',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Champ adresse 2',
                    'desc'      => 'Saisissez le champ adresse 2',
                    'required' => false,
                    'name' => 'selected_relay_adr2',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Champ adresse 3',
                    'desc'      => 'Saisissez le champ adresse 3',
                    'required' => false,
                    'name' => 'selected_relay_adr3',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Champ adresse 4',
                    'desc'      => 'Saisissez le champ adresse 4',
                    'required' => false,
                    'name' => 'selected_relay_adr4',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Identifiant commande',
                    'desc'      => 'Saisissez l\'identifiant commande',
                    'required' => true,
                    'name' => 'id_order',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Code Postal du point relais',
                    'desc'      => 'Saisissez le code postal du point relais',
                    'required' => true,
                    'name' => 'selected_relay_postcode',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Ville du point relais',
                    'desc'      => 'Saisissez la ville du point relais',
                    'required' => true,
                    'name' => 'selected_relay_city',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Pays du point relais',
                    'desc'      => 'Saisissez le pays du point relais (FR pour la France)',
                    'required' => true,
                    'name' => 'selected_relay_country_iso',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'URL de suivi',
                    'desc'      => 'Saisissez l\'URL de suivi',
                    'required' => false,
                    'name' => 'tracking_url',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'URL de l\'étiquette',
                    'desc'      => 'Saisissez l\'URL de l\'étiquette',
                    'required' => false,
                    'name' => 'label_url',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'text',
                    'label' => 'Numéro d\'expédition',
                    'desc'      => 'Saisissez le numéro d\'expédition',
                    'required' => false,
                    'name' => 'expedition_num',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'date',
                    'label' => 'Date d\'ajout',
                    'desc'      => 'Saisissez la date d\'ajout',
                    'required' => true,
                    'name' => 'date_add',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
                array(
                    'type' => 'date',
                    'label' => 'Date de modification',
                    'desc'      => 'Saisissez la date de modification',
                    'required' => true,
                    'name' => 'date_upd',
                    'lang' => false,
                    'autoload_rte' => true,
                    'cols' => 60,
                    'rows' => 30
                ),
            )
        );
        return parent::renderForm();
    }

    public function postProcess()
    {
      if (Tools::isSubmit('save'))
      {
        $id = Tools::getValue('id_mondialrelay_selected_relay');
        $everrelay = new EverPsMondialRelayClass($id);
        $everrelay->id_customer = Tools::getValue('id_customer');
        $everrelay->id_mondialrelay_carrier_method = Tools::getValue('id_mondialrelay_carrier_method');
        $everrelay->id_cart = Tools::getValue('id_cart');
        $everrelay->id_order = Tools::getValue('id_order');
        $everrelay->selected_relay_num = Tools::getValue('selected_relay_num');
        $everrelay->selected_relay_adr1 = Tools::getValue('selected_relay_adr1');
        $everrelay->selected_relay_adr2 = Tools::getValue('selected_relay_adr2');
        $everrelay->selected_relay_adr3 = Tools::getValue('selected_relay_adr3');
        $everrelay->selected_relay_adr4 = Tools::getValue('selected_relay_adr4');
        $everrelay->selected_relay_postcode = Tools::getValue('selected_relay_postcode');
        $everrelay->selected_relay_city = Tools::getValue('selected_relay_city');
        $everrelay->selected_relay_country_iso = Tools::getValue('selected_relay_country_iso');
        $everrelay->tracking_url = Tools::getValue('tracking_url');
        $everrelay->label_url = Tools::getValue('label_url');
        $everrelay->expedition_num = Tools::getValue('expedition_num');
        $everrelay->date_add = Tools::getValue('date_add');
        $everrelay->date_upd = Tools::getValue('date_upd');
        if (!$everrelay->save()) {
            $this->errors[] = Tools::displayError('An error has occurred: Can\'t save the current object');
        }
        Tools::redirectAdmin(self::$currentIndex.'&conf=4&token='.$this->token);
      }
    }
}
