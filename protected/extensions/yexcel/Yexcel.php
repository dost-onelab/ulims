<?php
	/**
	 * Yii Excel File Reader (Yexcel) Class
	 * by: Michel Kogan
	 * --------------------
	 * LICENSE
	 * --------------------
	 * This program is open source product; you can redistribute it and/or
	 * modify it under the terms of the GNU General Public License (GPL)
	 * as published by the Free Software Foundation; either version 2
	 * of the License, or (at your option) any later version.
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 * To read the license please visit http://www.gnu.org/copyleft/gpl.html
	 *
	 * --------------------
	 * @package    Yexcel
	 * @author     Michel Kogan <kogan.michel@gmail.com
	 * @copyright  2012 Michel Kogan
	 * @license    http://www.gnu.org/copyleft/gpl.html  GNU General Public License (GPL)
	 * @link       http://www.sparta.ir
	 * @see        FileSystem
	 * @version    1.0.0
	 *
	 *
	 */
	/** Include path **/
	set_include_path(get_include_path() . PATH_SEPARATOR . Yii::app()->basePath.'/extensions/yexcel/Classes/');

	/** PHPExcel_IOFactory */
	include 'PHPExcel/IOFactory.php';

	class Yexcel
	{
		function __construct()
		{
		}

		public function init()
		{
		}

		public function readActiveSheet( $file )
		{
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

			return $sheetData;
		}
	}

?>
