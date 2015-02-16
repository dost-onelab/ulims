<?php

Yii::import('zii.widgets.grid.CGridView');

/**
* A Grid View that groups rows by any column(s)
*
* @category       User Interface
* @package        extensions
* @author         Vitaliy Potapov <noginsk@rambler.ru>
* @version        1.3
*/
class GroupGridView extends CGridView {

    //column values are merged independently
    const MERGE_SIMPLE = 'simple'; 
    //column values are merged if at least one value of nested columns changes (makes sense when several columns in $mergeColumns option)
    const MERGE_NESTED = 'nested';    
    //column values are merged independently, but value is shown in first row of group and below cells just cleared (instead of `rowspan`)
    const MERGE_FIRSTROW = 'firstrow'; 
    
    public $mergeColumns = array();
    public $mergeType = self::MERGE_SIMPLE;
    public $mergeCellCss = 'text-align: center; vertical-align: middle';
	//modified by RBG
	public $mergeCellClass;
    
    //list of columns on which change extrarow will be triggered
    public $extraRowColumns = array();
	//list of columns on which change extrarow header will be triggered
	public $extraRowColumnsGroupHeader = array();
	//list of columns on which change extrarow footer will be triggered
	public $extraRowColumnsGroupFooter = array();	
    //expression to get value shown in extrarow group header
    public $extraRowExpressionGroupHeader;
    //expression to get value shown in extrarow group footer
    public $extraRowExpressionGroupFooter;	
    //expression to get value shown in extrarow
    public $extraRowExpression;
    //position of extraRow relative to group: 'above' | 'below' 
    public $extraRowPos = 'above';
    //totals expression: function($data, $row, &$totals)
    public $extraRowTotals;
    
	//modified by RBG
	public $extraRowColSpan;
	public $extraRowHeaderColSpan;
	public $extraRowFooterColSpan;
	public $hiddenColumns; // in case we have a hidden column, subtract total number of colspan
		
	public $extraRowTotalColumns=array();
	
    //array with groups
    private $_groups = array();

    //array with groups header
    private $_groupsHeader = array();

    //array with groups header
    private $_groupsFooter = array();
		
	public $cssFile;
	
    public function renderTableBody()
    {
        if(!empty($this->mergeColumns) || !empty($this->extraRowColumnsGroupHeader)) {
			$this->groupByColumnsHeader();			
        }
				
        if(!empty($this->mergeColumns) || !empty($this->extraRowColumns)) {
            $this->groupByColumns();
        }
		
        if(!empty($this->mergeColumns) || !empty($this->extraRowColumnsGroupFooter)) {
			$this->groupByColumnsFooter();			
        }		
        parent::renderTableBody();
    }

    /**
    * find and store changing of group columns
    * 
    * @param mixed $data
    */
    public function groupByColumns()
    {
        $data = $this->dataProvider->getData();
        if(count($data) == 0) return;

        if(!is_array($this->mergeColumns)) $this->mergeColumns = array($this->mergeColumns);
        if(!is_array($this->extraRowColumns)) $this->extraRowColumns = array($this->extraRowColumns);

        //store columns for group. Set object for existing columns in grid and string for attributes
        $groupColumns = array_unique(array_merge($this->mergeColumns, $this->extraRowColumns));
        foreach($groupColumns as $key => $colName) {
            foreach($this->columns as $column) {
                if(property_exists($column, 'name') && $column->name == $colName) {
                    $groupColumns[$key] = $column;
                    break;
                }
            }
        }

        //storage for groups in each column
        $groups = array();
          
        //values for first row
        $values = $this->getRowValues($groupColumns, $data[0], 0);
        foreach($values as $colName => $value) {
            $groups[$colName][] = array(
                'value'  => $value,
                'column' => $colName,
                'start'  => 0,
                //end - later
                //totals - later
            );
        }
        
        //calc totals for the first row
        $totals = array();
        if($this->extraRowTotals) {
            $this->evaluateExpression($this->extraRowTotals, array('data'=>$data[0], 'row'=>0, 'totals' => &$totals));
        }

        //iterate data 
        for($i = 1; $i < count($data); $i++) {
            //save row values in array
            $current = $this->getRowValues($groupColumns, $data[$i], $i);

            //define is change occured. Need this extra foreach for correctly proceed extraRows
            $changedColumns = array();
            foreach($current as $colName => $curValue) {
                $prev = end($groups[$colName]);  
                if($curValue != $prev['value']) {
                    $changedColumns[] = $colName;
                }
            }
            
            /*
             if this flag = true -> we will write change for all grouping columns.
             It's required when change of any column from extraRowColumns occurs
            */
            $extraRowColumnChanged = (count(array_intersect($changedColumns, $this->extraRowColumns)) > 0);
            
            /*
             this changeOccured related to foreach below. It is required only for mergeType == self::MERGE_NESTED, 
             to write change for all nested columns when change of previous column occured
            */
            $changeOccured = false;
            foreach($current as $colName => $curValue) {
                //value changed
                $valueChanged = in_array($colName, $changedColumns);
                //change already occured in this loop and mergeType set to MERGETYPE_NESTED
                $saveChange = $valueChanged || ($changeOccured && $this->mergeType == self::MERGE_NESTED);
                
                if($extraRowColumnChanged || $saveChange) { 
                    $changeOccured = true;
                    $lastIndex = count($groups[$colName]) - 1;
                 
                    //finalize prev group
                    $groups[$colName][$lastIndex]['end'] = $i - 1;
                    $groups[$colName][$lastIndex]['totals'] = $totals;
                   
                    //begin new group
                    $groups[$colName][] = array(
                      'start'   => $i,
                      'column'  => $colName,
                      'value'   => $curValue,
                    );
                } 
            }
            
            //if change in extrarowcolumn --> reset totals
            if($extraRowColumnChanged) {
                $totals = array();  
            }
            
            //calc totals for that row
            if($this->extraRowTotals) {
                $this->evaluateExpression($this->extraRowTotals, array('data'=>$data[$i], 'row'=>$i, 'totals' => &$totals));
            }  
        }

        //finalize group for last row
        foreach($groups as $colName => $v) {
            $lastIndex = count($groups[$colName]) - 1;
            $groups[$colName][$lastIndex]['end'] = count($data) - 1;
            $groups[$colName][$lastIndex]['totals'] = $totals;
        }
        
        $this->_groups = $groups;
    }

    public function groupByColumnsHeader()
    {
        $data = $this->dataProvider->getData();
        if(count($data) == 0) return;

        if(!is_array($this->mergeColumns)) $this->mergeColumns = array($this->mergeColumns);
        if(!is_array($this->extraRowColumnsGroupHeader)) $this->extraRowColumnsGroupHeader = array($this->extraRowColumnsGroupHeader);

        //store columns for group. Set object for existing columns in grid and string for attributes
        $groupColumns = array_unique(array_merge($this->mergeColumns, $this->extraRowColumnsGroupHeader));
        foreach($groupColumns as $key => $colName) {
            foreach($this->columns as $column) {
                if(property_exists($column, 'name') && $column->name == $colName) {
                    $groupColumns[$key] = $column;
                    break;
                }
            }
        }

        //storage for groups in each column
        $groups = array();
          
        //values for first row
        $values = $this->getRowValues($groupColumns, $data[0], 0);
        foreach($values as $colName => $value) {
            $groups[$colName][] = array(
                'value'  => $value,
                'column' => $colName,
                'start'  => 0,
                //end - later
                //totals - later
            );
        }
        
        //calc totals for the first row
        $totals = array();
        if($this->extraRowTotals) {
            $this->evaluateExpression($this->extraRowTotals, array('data'=>$data[0], 'row'=>0, 'totals' => &$totals));
        }

        //iterate data 
        for($i = 1; $i < count($data); $i++) {
            //save row values in array
            $current = $this->getRowValues($groupColumns, $data[$i], $i);

            //define is change occured. Need this extra foreach for correctly proceed extraRows
            $changedColumns = array();
            foreach($current as $colName => $curValue) {
                $prev = end($groups[$colName]);  
                if($curValue != $prev['value']) {
                    $changedColumns[] = $colName;
                }
            }
            
            /*
             if this flag = true -> we will write change for all grouping columns.
             It's required when change of any column from extraRowColumns occurs
            */
            $extraRowColumnChanged = (count(array_intersect($changedColumns, $this->extraRowColumns)) > 0);
            
            /*
             this changeOccured related to foreach below. It is required only for mergeType == self::MERGE_NESTED, 
             to write change for all nested columns when change of previous column occured
            */
            $changeOccured = false;
            foreach($current as $colName => $curValue) {
                //value changed
                $valueChanged = in_array($colName, $changedColumns);
                //change already occured in this loop and mergeType set to MERGETYPE_NESTED
                $saveChange = $valueChanged || ($changeOccured && $this->mergeType == self::MERGE_NESTED);
                
                if($extraRowColumnChanged || $saveChange) { 
                    $changeOccured = true;
                    $lastIndex = count($groups[$colName]) - 1;
                 
                    //finalize prev group
                    $groups[$colName][$lastIndex]['end'] = $i - 1;
                    $groups[$colName][$lastIndex]['totals'] = $totals;
                   
                    //begin new group
                    $groups[$colName][] = array(
                      'start'   => $i,
                      'column'  => $colName,
                      'value'   => $curValue,
                    );
                } 
            }
            
            //if change in extrarowcolumn --> reset totals
            if($extraRowColumnChanged) {
                $totals = array();  
            }
            
            //calc totals for that row
            if($this->extraRowTotals) {
                $this->evaluateExpression($this->extraRowTotals, array('data'=>$data[$i], 'row'=>$i, 'totals' => &$totals));
            }  
        }

        //finalize group for last row
        foreach($groups as $colName => $v) {
            $lastIndex = count($groups[$colName]) - 1;
            $groups[$colName][$lastIndex]['end'] = count($data) - 1;
            $groups[$colName][$lastIndex]['totals'] = $totals;
        }
        
        $this->_groupsHeader = $groups;
    }

    public function groupByColumnsFooter()
    {
        $data = $this->dataProvider->getData();
        if(count($data) == 0) return;

        if(!is_array($this->mergeColumns)) $this->mergeColumns = array($this->mergeColumns);
        if(!is_array($this->extraRowColumnsGroupFooter)) $this->extraRowColumnsGroupFooter = array($this->extraRowColumnsGroupFooter);

        //store columns for group. Set object for existing columns in grid and string for attributes
        $groupColumns = array_unique(array_merge($this->mergeColumns, $this->extraRowColumnsGroupFooter));
        foreach($groupColumns as $key => $colName) {
            foreach($this->columns as $column) {
                if(property_exists($column, 'name') && $column->name == $colName) {
                    $groupColumns[$key] = $column;
                    break;
                }
            }
        }

        //storage for groups in each column
        $groups = array();
          
        //values for first row
        $values = $this->getRowValues($groupColumns, $data[0], 0);
        foreach($values as $colName => $value) {
            $groups[$colName][] = array(
                'value'  => $value,
                'column' => $colName,
                'start'  => 0,
                //end - later
                //totals - later
            );
        }
        
        //calc totals for the first row
        $totals = array();
        if($this->extraRowTotals) {
            $this->evaluateExpression($this->extraRowTotals, array('data'=>$data[0], 'row'=>0, 'totals' => &$totals));
        }

        //iterate data 
        for($i = 1; $i < count($data); $i++) {
            //save row values in array
            $current = $this->getRowValues($groupColumns, $data[$i], $i);

            //define is change occured. Need this extra foreach for correctly proceed extraRows
            $changedColumns = array();
            foreach($current as $colName => $curValue) {
                $prev = end($groups[$colName]);  
                if($curValue != $prev['value']) {
                    $changedColumns[] = $colName;
                }
            }
            
            /*
             if this flag = true -> we will write change for all grouping columns.
             It's required when change of any column from extraRowColumns occurs
            */
            $extraRowColumnChanged = (count(array_intersect($changedColumns, $this->extraRowColumns)) > 0);
            
            /*
             this changeOccured related to foreach below. It is required only for mergeType == self::MERGE_NESTED, 
             to write change for all nested columns when change of previous column occured
            */
            $changeOccured = false;
            foreach($current as $colName => $curValue) {
                //value changed
                $valueChanged = in_array($colName, $changedColumns);
                //change already occured in this loop and mergeType set to MERGETYPE_NESTED
                $saveChange = $valueChanged || ($changeOccured && $this->mergeType == self::MERGE_NESTED);
                
                if($extraRowColumnChanged || $saveChange) { 
                    $changeOccured = true;
                    $lastIndex = count($groups[$colName]) - 1;
                 
                    //finalize prev group
                    $groups[$colName][$lastIndex]['end'] = $i - 1;
                    $groups[$colName][$lastIndex]['totals'] = $totals;
                   
                    //begin new group
                    $groups[$colName][] = array(
                      'start'   => $i,
                      'column'  => $colName,
                      'value'   => $curValue,
                    );
                } 
            }
            
            //if change in extrarowcolumn --> reset totals
            if($extraRowColumnChanged) {
                $totals = array();  
            }
            
            //calc totals for that row
            if($this->extraRowTotals) {
                $this->evaluateExpression($this->extraRowTotals, array('data'=>$data[$i], 'row'=>$i, 'totals' => &$totals));
            }  
        }

        //finalize group for last row
        foreach($groups as $colName => $v) {
            $lastIndex = count($groups[$colName]) - 1;
            $groups[$colName][$lastIndex]['end'] = count($data) - 1;
            $groups[$colName][$lastIndex]['totals'] = $totals;
        }
        
        $this->_groupsFooter = $groups;
    }
    
    public function renderTableRow($row)
    {
        $extraRowEdge = null;
		$extraRowHeaderEdge = null;
		//try this extraRowColumnsGroupHeader
		if(count($this->extraRowColumnsGroupHeader)) {
			$headerName = $this->extraRowColumnsGroupHeader[0];
			$extraRowHeaderEdge = $this->isGroupEdgeHeader($headerName, $row);
			if($this->extraRowPos == 'above' && isset($extraRowHeaderEdge['start'])) {
				$this->renderExtraRowHeader($row, $extraRowHeaderEdge['group']['totals']); 
			}

			if(count($this->extraRowColumns)) {
				$colName = $this->extraRowColumns[0]; 
				$extraRowEdge = $this->isGroupEdge($colName, $row);
				if($this->extraRowPos == 'above' && isset($extraRowEdge['start'])) {
					$this->renderExtraRow($row, $extraRowEdge['group']['totals']); 
				}
			}
		}else{
			if(count($this->extraRowColumns)) {
				$colName = $this->extraRowColumns[0]; 
				$extraRowEdge = $this->isGroupEdge($colName, $row);
				if($this->extraRowPos == 'above' && isset($extraRowEdge['start'])) {
					$this->renderExtraRow($row, $extraRowEdge['group']['totals']); 
				}
			}
		}
		
        /*
        if($this->_changes && array_key_exists($row, $this->_changes)) {
            $change = $this->_changes[$row];
            //if change in extracolumns --> put extra row
            $columnsInExtra = array_intersect(array_keys($change['columns']), $this->extraRowColumns);
            //extraRowPos = before
            if(count($columnsInExtra) > 0 && $this->extraRowPos == 'before') {
                $this->renderExtraRow($row, $this->_changes[$row], $columnsInExtra);
            }
        }
        */

        // original CGridView code
        /*if($this->rowCssClassExpression!==null) 
        {
            $data=$this->dataProvider->data[$row];
            echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
        }
        else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
                echo '<tr class="'.$this->rowCssClass[$row%$n].'">';
            else
                echo '<tr>';*/
		
		/*
		 * Modified by RBG
		 * Code for Original CGridView
		*/		
		$htmlOptions=array();
		if($this->rowHtmlOptionsExpression!==null)
		{
			$data=$this->dataProvider->data[$row];
			$options=$this->evaluateExpression($this->rowHtmlOptionsExpression,array('row'=>$row,'data'=>$data));
			if(is_array($options))
				$htmlOptions = $options;
		}

		if($this->rowCssClassExpression!==null)
		{
			$data=$this->dataProvider->data[$row];
			$class=$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data));
		}
		elseif(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
			$class=$this->rowCssClass[$row%$n];

		if(!empty($class))
		{
			if(isset($htmlOptions['class']))
				$htmlOptions['class'].=' '.$class;
			else
				$htmlOptions['class']=$class;
		}

		echo CHtml::openTag('tr', $htmlOptions)."\n";
		//end modified by RBG :: code from original CGridView

        foreach($this->columns as $column) {
            $isGroupColumn = property_exists($column, 'name') && in_array($column->name, $this->mergeColumns);

            if(!$isGroupColumn) {
                $column->renderDataCell($row);     
                continue;
            }

            //is curent row appears on edge of group
            $edge = $this->isGroupEdge($column->name, $row);

            switch($this->mergeType) {
                case self::MERGE_SIMPLE: 
                case self::MERGE_NESTED: 
                    if(isset($edge['start'])) {
                        $options = $column->htmlOptions;
                        $column->htmlOptions['rowspan'] = $edge['group']['end'] - $edge['group']['start'] + 1; 
                        $column->htmlOptions['class'] = 'merge';
                        $style = isset($column->htmlOptions['style']) ? $column->htmlOptions['style'] : '';
                        $column->htmlOptions['style'] = $style.';'.$this->mergeCellCss;
						$column->htmlOptions['class'] = $this->mergeCellClass;
                        $column->renderDataCell($row);
                        $column->htmlOptions = $options;
                    }
                    break;

                case self::MERGE_FIRSTROW:
                    if(isset($edge['start'])) {
                        $column->renderDataCell($row);
                    } else {
                        echo '<td></td>'; 
                    }
                    break;
            }

        }

        echo "</tr>\n";
        
        //extraRowPos = after
        if(count($this->extraRowColumns) && $this->extraRowPos == 'below' && isset($extraRowEdge['end'])) {
            $this->renderExtraRow($row, $extraRowEdge['group']['totals']);
        }
		
		//extraRowColumnsGroupFooter
		//for SUBTOTAL
		if(count($this->extraRowColumnsGroupFooter)){
			$footerColName = $this->extraRowColumnsGroupFooter[0];
			$extraRowFooterEdge = $this->isGroupEdgeFooter($footerColName, $row);
		}

        if(count($this->extraRowColumnsGroupFooter) && isset($extraRowFooterEdge['end'])) {
            $this->renderExtraRowFooter($row, $extraRowFooterEdge['group']['totals']);
        }
    }    
    
    /**
    * returns array of rendered column values (TD)
    * 
    * @param mixed $columns
    * @param mixed $rowIndex
    */
    private function getRowValues($columns, $data, $rowIndex)
    {
        foreach($columns as $column) {
            if($column instanceOf CGridColumn) {
                $result[$column->name] = $this->getDataCellContent($column, $data, $rowIndex);
            } elseif(is_string($column)) {
                if(is_array($data) && array_key_exists($column, $data)) {
                    $result[$column] = $data[$column];
                } elseif($data instanceOf CModel && $data->hasAttribute($column)) {
                    $result[$column] = $data->getAttribute($column);
                } else {
                    throw new CException('Column or attribute "'.$column.'" not found!');
                }
            }
        }

        return $result;
    }

    /**
    * renders extra row
    * 
    * @param mixed $row
    * @param mixed $change
    */
    private function renderExtraRow($row, $totals)
    {
        $data = $this->dataProvider->data[$row]; 
        if($this->extraRowExpression) { //user defined expression, use it!
            $content = $this->evaluateExpression($this->extraRowExpression, array('data'=>$data, 'row'=>$row, 'totals' => $totals));
        } else {  //generate value
            $values = array();
            foreach($this->extraRowColumns as $colName) {
                $values[] = CHtml::encode(CHtml::value($data, $colName));
            }
            $content = '<strong>'.implode(' :: ', $values).'</strong>';  
        }
		
		//modified by RBG
		$totalColumns = count($this->columns);
		if($this->hiddenColumns) $totalColumns=$totalColumns-$this->hiddenColumns;
		if($this->extraRowColSpan){ //user defined number of colspan, use it!
			$colspan = $this->extraRowColSpan;
			//create td for columns not covered by colspan
			//if colspan defined is less than 1 or greater than total columns
			//return total columns
			if($colspan<1 OR $colspan>$totalColumns){
				$colspan=$totalColumns;
			}else{
				$colRemain = $totalColumns - $colspan;				
			}
			echo '<tr>';
			echo '<td class="extrarow" colspan="'.$colspan.'">'.$content.'</td>';
			echo '</tr>';
		}else{//count total number of columns
			$colspan = $totalColumns;
			echo '<tr>';
			echo '<td class="extrarow" colspan="'.$colspan.'">'.$content.'</td>';
			echo '</tr>';
		}
		
		
    }
	
    private function renderExtraRowHeader($row, $totals)
    {
        $data = $this->dataProvider->data[$row]; 
        if($this->extraRowExpressionGroupHeader) { //user defined expression, use it!
            $content = $this->evaluateExpression($this->extraRowExpressionGroupHeader, array('data'=>$data, 'row'=>$row, 'totals' => $totals));
        } else {  //generate value
            $values = array();
            foreach($this->extraRowColumnsGroupHeader as $colName) {
                $values[] = CHtml::encode(CHtml::value($data, $colName));
            }
            $content = '<strong>'.implode(' :: ', $values).'</strong>';  
        }
		
		//modified by RBG
		$totalColumns = count($this->columns);
		if($this->hiddenColumns) $totalColumns=$totalColumns-$this->hiddenColumns;
		if($this->extraRowHeaderColSpan){ //user defined number of colspan, use it!
			$colspan = $this->extraRowHeaderColSpan;
			//create td for columns not covered by colspan
			//if colspan defined is less than 1 or greater than total columns
			//return total columns
			if($colspan<1 OR $colspan>$totalColumns){
				$colspan=$totalColumns;
			}else{
				$colRemain = $totalColumns - $colspan;				
			}
			echo '<tr>';
			echo '<td class="extrarowgroupheader" colspan="'.$colspan.'">'.$content.'</td>';
			echo '</tr>';
		}else{//count total number of columns
			$colspan = $totalColumns;
			echo '<tr>';
			echo '<td class="extrarowgroupheader" colspan="'.$colspan.'">'.$content.'</td>';
			echo '</tr>';
		}
		
    }	

    private function renderExtraRowFooter($row, $totals)
    {
        $data = $this->dataProvider->data[$row]; 
        if($this->extraRowExpressionGroupFooter) { //user defined expression, use it!
            $content = $this->evaluateExpression($this->extraRowExpressionGroupFooter, array('data'=>$data, 'row'=>$row, 'totals' => $totals));
        } else {  //generate value
            $values = array();
            foreach($this->extraRowColumnsGroupFooter as $colName) {
                $values[] = CHtml::encode(CHtml::value($data, $colName));
            }
            $content = '<strong>'.implode(' :: ', $values).'</strong>';  
        }
		
		//modified by RBG
		$totalColumns = count($this->columns);
		if($this->hiddenColumns) $totalColumns=$totalColumns-$this->hiddenColumns;
		if($this->extraRowFooterColSpan){ //user defined number of colspan, use it!
			$colspan = $this->extraRowFooterColSpan;
			//create td for columns not covered by colspan
			//if colspan defined is less than 1 or greater than total columns
			//return total columns
			if($colspan<1 OR $colspan>$totalColumns){
				$colspan=$totalColumns;
			}else{
				$colRemain = $totalColumns - $colspan;				
			}
			echo '<tr>';
			echo '<td class="extrarowgroupfooter" colspan="'.$colspan.'">'.$content.'</td>';
			echo '</tr>';
		}else{//count total number of columns
			$colspan = $totalColumns;
			echo '<tr>';
			echo '<td class="extrarowgroupfooter" colspan="'.$colspan.'">'.$content.'</td>';
			echo '</tr>';
		}
		
    }	

    /**
    * need to rewrite this function as it is protected in CDataColumn: it is strange as all methods inside are public 
    * 
    * @param mixed $column
    * @param mixed $row
    * @param mixed $data
    */
    private function getDataCellContent($column, $data, $row)
    {
        if($column->value!==null)
            $value=$column->evaluateExpression($column->value, array('data'=>$data,'row'=>$row));
        else if($column->name!==null)
                $value=CHtml::value($data,$column->name);

            return $value===null ? $column->grid->nullDisplay : $column->grid->getFormatter()->format($value, $column->type);
    }
    
    /**
    * Is current row start or end of group in particular column 
    */
    private function isGroupEdge($colName, $row) 
    {
        $result = array();
        foreach($this->_groups[$colName] as $index => $v) {
           if($v['start'] == $row) {
               $result['start'] = $row;
               $result['group'] = $v;
           }
           if($v['end'] == $row) {
               $result['end'] = $row;
               $result['group'] = $v;
           } 
           if(count($result)) break;
        }
        return $result;
    }

    private function isGroupEdgeHeader($colName, $row) 
    {
        $result = array();
        foreach($this->_groupsHeader[$colName] as $index => $v) {
           if($v['start'] == $row) {
               $result['start'] = $row;
               $result['group'] = $v;
           }
           if($v['end'] == $row) {
               $result['end'] = $row;
               $result['group'] = $v;
           } 
           if(count($result)) break;
        }
        return $result;
    }

    private function isGroupEdgeFooter($colName, $row) 
    {
        $result = array();
        foreach($this->_groupsFooter[$colName] as $index => $v) {
           if($v['start'] == $row) {
               $result['start'] = $row;
               $result['group'] = $v;
           }
           if($v['end'] == $row) {
               $result['end'] = $row;
               $result['group'] = $v;
           } 
           if(count($result)) break;
        }
        return $result;
    }	

}
