<?php
/**
 * UpdateAttributeAction class file.
 * 
 * UpdateAttributeAction represents an action that updates an attribute of an existing model 
 * using the EJEditable extension.
 *
 * @author C.Yildiz (aka c@cba) <c@cba-solutions.org>
 * @copyright Copyright &copy; 2014 C.Yildiz
 * @license Licensed under MIT license. http://choosealicense.com/licenses/mit/
 * @version 1.0
 */
 
class UpdateAttributeAction extends CAction
{  
  /**
   * @var string a callback method in controller for additional processing.
   */
  public $callback = null;
  /**
   * @var string a preCall method in controller for additional processing.
   */
  public $preCall = null;
  /**
   * @var string the name of the model to be created.
   */
  public $modelClass = null;
  
  /**
   * Initialize the action.
   */
  protected function init()
  {
  }
  
  /**
   * Run the action.
   */
  public function run()
  {
	// only allow update via POST request
	if(Yii::app()->request->isPostRequest) {
		if(isset($_GET['id']) || isset($_POST['id'])) {
			$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
			
			$this->init();
			$controller = $this->getController();
			$modelClass = !empty($this->modelClass) ? $this->modelClass : ucfirst( $controller->getId() );
			$model = $modelClass::model()->findByPk($id);
			if(!empty($model)) {
				if( $this->preCall !== null && method_exists( $controller, $this->preCall ) )
					$controller->{$this->preCall}( $model );
				
				if( !empty($_GET['attribute']) || !empty($_POST['attribute']) ) {
					$attribute = isset($_GET['attribute']) ? $_GET['attribute'] : $_POST['attribute'];
					$oldvalue = $model->$attribute;
					if(isset($_POST['value'])) {
						$value = $_POST['value'];
						$model->$attribute = $value;
						if($model->save(true,array($attribute))) {
							if( $this->callback !== null && method_exists( $controller, $this->callback ) )
								$controller->{$this->callback}( $model );
							echo $value;
						}
						else echo $oldvalue;
					}
					else echo $oldvalue;
				}
				else {echo "No Attribute"; Yii::app()->end();}
			} else echo "No $modelClass with #$id";
		}
		Yii::app()->end();
	}
	Yii::app()->end();
}
  
  /**
   * Returns whether this is an AJAX request.
   * @return boolean true if this is an AJAX request.
   */
  public function getIsAjaxRequest()
  {
    return $this->isAjaxRequest;
  }
  
  /**
   * Returns an URL for redirect.
   * @param int $id the id of the model to redirect to.
   * @return mixed processed redirect URL.
   */
  protected function getRedirectUrl( $id )
  {
    // Process redirect URL
    if( $this->_redirectTo === null )
    {
      // Use default redirect URL
      if( $this->redirectTo === null )
        $this->_redirectTo = array( 'view', 'id' => $id );
      // User set redirect URL is an array, check if id is needed
      else if( is_array( $this->redirectTo ) )
      {
        // ID is set
        if( isset( $this->redirectTo['id'] ) )
          // ID needed, set it to the model id
          if( $this->redirectTo['id'] )
            $this->redirectTo['id'] = $id;
          // ID is not needed, remove it from redirect URL
          else
            unset( $this->redirectTo['id'] );
        
        // Set processed redirect URL
        $this->_redirectTo = $this->redirectTo;
      }
      // User set redirect URL is a string
      else
        $this->_redirectTo = $this->redirectTo;
    }
    
    // Return processed redirect URL
    return $this->_redirectTo;
  }
}
?>