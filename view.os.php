<?php
/*
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
define('INTERNAL', 1);
define('PUBLIC', 1);
require(dirname(__FILE__) . '/../../init.php');
require_once dirname(__FILE__) . '/components/view_os_widget.class.php';

ViewOsWidget::instance()->prolog();
ViewOsWidget::instance()->display();
