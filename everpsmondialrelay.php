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

class EverPsMondialRelay extends Module
{
    public function __construct()
    {
        $this->name = 'everpsmondialrelay';
        $this->tab = 'shipping_logistics';
        $this->version = '2.0.1';
        $this->installed_version = '';
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => '1.7');
        $this->author = 'Team Ever';
        parent::__construct();
        $this->displayName = $this->l('Ever PS Mondial Relay');
        $this->description = $this->l('Correct customer shipping informations');
        $this->isSeven = Tools::version_compare(_PS_VERSION_, '1.7', '>=') ? true : false;
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return (parent::install()
            && $this->installModuleTab('AdminEverPsMondialRelay'));
    }

    public function uninstall()
    {
        return (parent::uninstall()
            && $this->uninstallModuleTab('AdminEverPsMondialRelay'));
    }

    /**
     * The installModuleTab method
     *
     * @param string $tabClass
     * @param string $tabName
     * @param integer $idTabParent
     * @return boolean
     */
    private function installModuleTab($tabClass)
    {
        foreach (Language::getLanguages(false) as $language) {
            $tabName[$language['id_lang']] = 'Ever PS Mondial Relay';
        }

        $tab = new Tab();
        $tab->name = $tabName;
        $tab->class_name = $tabClass;
        $tab->module = $this->name;
        $tab->id_parent = (int)Tab::getIdFromClassName('AdminParentOrders');
        $tab->position = Tab::getNewLastPosition($tab->id_parent);

        return $tab->save();
    }

    /**
     * The uninstallModuleTab method
     *
     * @param string $tabClass
     * @return boolean
     */
    private function uninstallModuleTab($tabClass)
    {
        $tab = new Tab((int)Tab::getIdFromClassName($tabClass));

        return $tab->delete();
    }
}
