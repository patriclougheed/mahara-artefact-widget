<?php

require_once dirname(__FILE__) . '/view_os_widget.class.php';
require_once dirname(__FILE__) . '/dashboard_widget.class.php';

/**
 * Description of DashboardOsWidget
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class DashboardOsWidget extends ViewOsWidget
{
   
    /**
     *
     * @staticvar DashboardOsWidget $result
     * @return DashboardOsWidget 
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
       return DashboardWidget::instance()->user_id();
    }

    public function user()
    {
       return DashboardWidget::instance()->user();
    }

    public function view()
    {
       return DashboardWidget::instance()->view();
    }

    public function view_id()
    {
       return DashboardWidget::instance()->view_id();
    }

}
