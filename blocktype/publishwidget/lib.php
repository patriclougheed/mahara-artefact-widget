<?php

/**
 *
 * @package    mahara
 * @subpackage artefact-widget-publishwidget
 * @author     laurent.opprecht@gmail.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 2011 University of Geneva http://www.unige.ch/
 *
 */
defined('INTERNAL') || die();

class PluginBlocktypePublishwidget extends PluginBlocktype
{

    public static function get_title()
    {
        return self::get_string('title');
    }

    public static function get_description()
    {
        return self::get_string('description');
    }

    public static function get_categories()
    {
        return array('external');
    }

    public static function get_instance_javascript(BlockInstance $instance)
    {
        return array();
    }

    public static function render_instance(BlockInstance $instance, $editing=false)
    {
        //$configdata = $instance->get('configdata');
        $view = $instance->get_view();
        $view_type = $view->get('type');
        $view_id = $view->get('id');
        $owner_id = $view->get('owner');
        $timestamp = strtotime($view->get('mtime'));
        switch($view_type){
            case 'dashboard':
                $url = 'dashboard.os.php' . '?user_id=' . $owner_id;
                break;
            case 'profile' :
                $url = 'user.os.php' . '?user_id=' . $owner_id;
                break;
            default:
                $url = 'view.os.php' . '?view_id=' . $view_id;
                break;
        }
        $url = get_config('wwwroot') . 'artefact/widget/' . $url  . '&timestamp=' . $timestamp;
        $url_encoded = urlencode($url);
        $smarty = smarty_core();;
        $smarty->assign('url', $url);
        $smarty->assign('url_encoded', $url_encoded);
        return $smarty->fetch('blocktype:publishwidget:content.tpl');
    }

    // Yes, we do have instance config. People are allowed to specify the title 
    // of the block, nothing else at this time. So in the next two methods we 
    // say yes and return no fields, so the title will be configurable.
    public static function has_instance_config()
    {
        return true;
    }

    public static function instance_config_form($instance)
    {
        return array();
    }

    public static function artefactchooser_element($default=null)
    {
        
    }

    public static function default_copy_type()
    {
        return 'shallow';
    }

    public static function allowed_in_view(View $view)
    {
        return true;
    }

    public function get_string($identifier, $section = '', $p = null)
    {
        $section = $section ? $section : 'blocktype.widget/publishwidget';
        return get_string($identifier, $section, $p);
    }

}