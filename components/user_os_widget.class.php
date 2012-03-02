<?php

require_once dirname(__FILE__) . '/view_os_widget.class.php';
require_once dirname(__FILE__) . '/user_widget.class.php';

/**
 * Description of 
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class UserOsWidget extends ViewOsWidget
{
   
    /**
     *
     * @staticvar UserOsWidget $result
     * @return UserOsWidget 
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
       return UserWidget::instance()->user_id();
    }

    public function user()
    {
       return UserWidget::instance()->user();
    }

    public function view()
    {
       return UserWidget::instance()->view();
    }

    public function view_id()
    {
       return UserWidget::instance()->view_id();
    }

}
