<?php

/**
 * Description of widget
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class ViewWidget
{
    const VIEW_ID = 'view_id';
    const BLOCK_ID = 'block_id';

    /**
     *
     * @staticvar ViewWidget $result
     * @return ViewWidget 
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
        require_once(get_config('libroot') . 'view.php');
    }

    public function forbidden()
    {

        $view_id = $this->view_id();
        if (empty($view_id))
        {
            return true;
        }

        return!can_view_view($view_id);
    }

    public function view_id()
    {
        $result = param_integer(self::VIEW_ID);

        if (empty($result))
        {
            return false;
        }
        return $result;
    }

    /**
     *
     * @staticvar View $result
     * @return View 
     */
    public function view()
    {
        static $result = null;
        if (!is_null($result))
        {
            return $result;
        }
        $view_id = $this->view_id();
        $result = $view_id ? new View($view_id) : false;
        return $result;
    }

    public function block_id()
    {
        return param_integer(self::BLOCK_ID, false);
    }

    public function smarty($view)
    {
        $javascript = array('paginator', 'viewmenu', 'jquery', 'artefact/resume/resumeshowhide.js');
        $javascript = array_merge($javascript, $view->get_blocktype_javascript());
        if ($view->get('type') == 'profile')
        {
            $javascript[] = 'lib/pieforms/static/core/pieforms.js';
        }

        $extrastylesheets = array('style/views.css', 'style/widgets.css');

        $headers = array('<link rel="stylesheet" type="text/css" href="' . get_config('wwwroot') . 'theme/views.css">');

        if (!$view->is_public())
        {
            $headers[] = '<meta name="robots" content="noindex">';  // Tell search engines not to index non-public views
        }

        $smarty = smarty(
                $javascript, $headers, array(), array(
            'stylesheets' => $extrastylesheets,
            'sidebars' => false,
                )
        );
        return $smarty;
    }

    public function display()
    {
        if ($this->forbidden())
        {
            $this->display_login_page();
        }
        global $THEME;

        $viewid = $this->view_id();

        $view = $this->view();
        $owner = $view->get('owner');
        $viewtype = $view->get('type');
        $title = $view->display_title();
        $tags = $view->get('tags');
        $author = $view->formatted_owner();

        // Set up theme
        $viewtheme = $view->get('theme');
        if ($viewtheme && $THEME->basename != $viewtheme)
        {
            $THEME = new Theme($viewtheme);
        }

        $smarty = $this->smarty($view);

        $smarty->assign('viewid', $viewid);
        $smarty->assign('viewtype', $viewtype);
        $smarty->assign('owner', $owner);
        $smarty->assign('tags', $tags);
        $smarty->assign('maintitle', $title);
        $smarty->assign('PAGEAUTHOR', $author);

        if ($block_id = $this->block_id())
        {
            $blockinstance = new BlockInstance($block_id);
            $content = $blockinstance->render_viewing();
        }
        else
        {
            $content = $view->build_columns();
        }

        $smarty->assign('viewdescription', $view->get('description'));
        $smarty->assign('viewcontent', $content);
        $smarty->display('widget/view.tpl');
    }

    public function display_login_page($message=null, Pieform $form=null)
    {
        global $USER, $SESSION;
        if ($form != null)
        {
            $loginform = get_login_form_js($form->build());
        }
        else
        {
            require_once('pieforms/pieform.php');
            $loginform = get_login_form_js(pieform(auth_get_login_form()));
            /*
             * If $USER is set, the form was submitted even before being built.
             * This happens when a user's session times out and they resend post
             * data. The request should just continue if so.
             */
            if ($USER->is_logged_in())
            {
                return;
            }
        }

        if ($message)
        {
            $SESSION->add_info_msg($message);
        }
        

        $extrastylesheets = array('style/widgets.css');
        $smarty = smarty(array(), array(), array(), array('stylesheets' => $extrastylesheets, 'pagehelp' => false, 'sidebars' => false));
        $smarty->assign('login_form', $loginform);
        $smarty->assign('PAGEHEADING', get_string('loginto', 'mahara', get_config('sitename')));
        $smarty->assign('LOGINPAGE', true);
        $smarty->display('widget/login.tpl');
        exit;
    }

}
