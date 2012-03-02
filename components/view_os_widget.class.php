<?php

require_once dirname(__FILE__) . '/view_widget.class.php';

/**
 * Description of 
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class ViewOsWidget extends ViewWidget
{

    /**
     *
     * @staticvar ViewOsWidget $result
     * @return ViewOsWidget 
     */
    public static function instance()
    {
        static $result = null;
        if (!is_null($result))
        {
            return $result;
        }
        return $result = new self();
    }

    public function prolog()
    {
        parent::prolog();
        require_once get_config('docroot') . '/blocktype/lib.php';
    }

    public function blocks()
    {
        $installed = plugins_installed('blocktype');
        $view_id = $this->view_id();
        $sql = 'SELECT bi.*
                FROM {block_instance} bi
                WHERE bi.view = ?
                ORDER BY bi.column, bi.order';
        $blocks = get_records_sql_array($sql, array($view_id));
        $blocks = $blocks ? $blocks : array();


        $result = array();
        foreach ($blocks as $block)
        {
            if (isset($installed[$block->blocktype]))
            {

                safe_require('blocktype', $block->blocktype);
                $bi = new BlockInstance($block->id, $block);
                $title = $bi->get_title();
                //not so good but nothing better
                //$title = str_replace("'", '&apos;', $title);
                $block->title = $title;
                
                $result[] = $block;
            }
        }

        return $result;
    }

    public function display_title($view)
    {
        $view_type = $view->get('type');
        if ($view_type == 'profile')
        {
            $title = hsc(display_name($view->get('owner'), null, true));
            return $title;
        }
        if ($view_type == 'dashboard')
        {
            return get_string('dashboardviewtitle', 'view');
        }

        $ownername = hsc($view->formatted_owner());

        if ($view_type == 'grouphomepage')
        {
            return get_string('aboutgroup', 'group', $ownername);
        }

        $title = hsc($view->get('title'));
        return $title;
    }

    public function display_description($view)
    {

        $view_type = $view->get('type');
        if ($view_type == 'profile')
        {
            return get_string('profiledescription');
        }
        if ($view_type == 'dashboard')
        {
            return get_string('dashboarddescription');
        }

        $ownername = hsc($view->formatted_owner());

        if ($view_type == 'grouphomepage')
        {
            return get_string('aboutgroup', 'group', $ownername);
        }

        $description = html2text($view->get('description'));
        return $description;
    }

    public function display_thumbnail($view)
    {
        global $THEME;
        $view_type = $view->get('type');
        if ($view_type == 'profile')
        {
            $result = $THEME->get_url('images/profile.png');
        }
        if ($view_type == 'dashboard')
        {
            $result = $THEME->get_url('images/rorganise.png');
            return $result;
        }
        if ($view_type == 'grouphomepage')
        {
            $result = $THEME->get_url('images/groups.png');
            return $result;
        }
        $result = $THEME->get_url('images/organise.png');
        return $result;
    }
    
    public function display_screenshot($view)
    {
//        global $THEME;
//        $view_type = $view->get('type');
//        $result = $THEME->get_url('images/organise.png');
        return $this->display_thumbnail($view);
    }


    public function display()
    {
        $view_id = $this->view_id();
        $view = $this->view();
        if (empty($view))
        {
            return;
        }

        $title = $this->display_title($view);
        $title_url = get_config('wwwroot') . 'view/view.php?id=' . $view_id;
        $url = get_config('wwwroot') . 'artefact/widget/view.php?view_id=' . $view_id . '&block_id=__UP_blockid__';
        $author = $view->formatted_owner();
        $owner_id = $view->get('owner');
        
        $owner = get_record('usr', 'id', $owner_id);
        $email = $owner->email;
        $blocks = $this->blocks();
        $first = reset($blocks);
        $default_block = $first ? $first->id : 0;
        $description = $this->display_description($view);
        $thumbnail = $this->display_thumbnail($view);
        $screenshot = $this->display_screenshot($view);
        $height = 250;

        header('Content-Type: text/xml');
        $smarty = smarty();
        $smarty->assign('view_id', $view_id);
        $smarty->assign('title', $title);
        $smarty->assign('title_url', $title_url);
        $smarty->assign('description', $description);
        $smarty->assign('thumbnail', $thumbnail);
        $smarty->assign('screenshot', $screenshot);
        $smarty->assign('height', $height);
        $smarty->assign('scrolling', false); //will be done by our own iframe

        $smarty->assign('url', $url);
        $smarty->assign('author', $author);
        $smarty->assign('email', $email);
        $smarty->assign('blocks', $blocks);
        $smarty->assign('default_block', $default_block);
        $smarty->display('widget/os_module.tpl');
    }

}
