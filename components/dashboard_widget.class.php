<?php

require_once dirname(__FILE__) . '/view_widget.class.php';

/**
 * Description of DashboardWidget
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class DashboardWidget extends ViewWidget
{
    const USER_ID = 'user_id';

    /**
     *
     * @staticvar DashboardWidget $result
     * @return DashboardWidget 
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
    
    public function user_id()
    {
        global $USER;

        $user_id = param_integer(self::USER_ID, false);
        $user_id = $user_id ? $user_id : $USER->get('id');
        return $user_id;
    }

    /**
     *
     * @global User $USER
     * @staticvar User $result
     * @return User 
     */
    public function user()
    {
        static $result = null;
        if (!is_null($result))
        {
            return $result;
        }

        global $USER;
        $user_id = $this->user_id();
        if (empty($user_id))
        {
            return $result = false;
        }
        if ( !empty($USER) && $USER->get('id') == $user_id)
        {
            return $result = $USER;
        }
        $user = get_record('usr', 'id', $user_id, 'deleted', 0);
        if (empty($user))
        {
            return false;
        }

        $result = new User();
        $result->find_by_id($user_id, $user);
        return $result;
    }

    public function view()
    {
        static $result = null;
        if (!is_null($result))
        {
            return $result;
        }
        $user = $this->user();
        return $result = $user ? $user->get_view_by_type('dashboard') : false;
    }

    public function view_id()
    {
        $view = $this->view();
        return $view ? $view->get('id') : false;
    }

}
