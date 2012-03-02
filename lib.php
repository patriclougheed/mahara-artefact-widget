<?php

/**
 *
 * @package    mahara
 * @subpackage artefact-widget
 * @author     laurent.opprecht@gmail.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2011 University of Geneva http://www.unige.ch/
 *
 */
defined('INTERNAL') || die();

class PluginArtefactWidget extends PluginArtefact
{

    public static function get_headers()
    {
        $headers = array();
        return $headers;
    }

    public static function get_artefact_types()
    {
        return array('widget');
    }

    public static function get_block_types()
    {
        return array();
    }

    public static function get_plugin_name()
    {
        return 'widget';
    }

    public static function menu_items()
    {
        return array();
    }

    public static function get_event_subscriptions()
    {
        return array();
    }

    public static function get_activity_types()
    {
        return array();
    }

    public static function postinst($prevversion)
    {
        return true;
    }

    public static function view_export_extra_artefacts($viewids)
    {
        $artefacts = array();
        return $artefacts;
    }

    public static function artefact_export_extra_artefacts($artefactids)
    {
        $artefacts = array();
        return $artefacts;
    }

}

/**
 * 
 */
class ArtefactTypeWidget extends ArtefactType
{

    public function __construct($id = 0, $data = null)
    {
        parent::__construct($id, $data);
    }

    public static function is_singular()
    {
        return false;
    }

    public static function get_icon($options=null)
    {
        return '';
    }

    public static function get_links($id)
    {
        return array();
    }

    public function can_have_attachments()
    {
        return false;
    }

    public function render_self()
    {
        return clean_html($this->get('description'));
    }

    public function exportable()
    {
        return false;
    }

    public function get_view_url($viewid, $showcomment=true)
    {
        return '';
    }

    public function viewable_in($viewid)
    {
        return false;
    }

    public static function has_config()
    {
        return false;
    }

    public static function get_config_options()
    {
        return array();
    }

    public static function get_string($identifier, $section='artefact.widget')
    {
        return get_string($identifier, $section);
    }
}