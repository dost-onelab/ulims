Yii EJEditable Extension
==============================

_EJEditable_ is a Yii extension wrapping the jQuery Plugin [Jeditable](https://github.com/tuupola/jquery_jeditable "Jeditable on GitHub") from 
[Mika Tuupola](https://github.com/tuupola "Mika Tuupola on GitHub"). <br>
Jeditable is an inplace editor plugin that allows you to click and edit the contents of various html elements.



##Requirements
Tested with Yii 1.1.9, should work with Yii 1.1 or above.

## Files
Extract the zip file and place the contents inside your `protected/extensions` folder.

## Examples
In the examples below we will use the model "Category" with the attributes id, name, description and status.

### 1- Basic Use
In the beginning of your view file, call the widget without any options:
~~~
[php]
$this->widget('ext.EJEditable.EJEditable');
~~~

Further down in your view file are the elements you want to make editable. <br>
Make sure that each element has the **class** "editable" and the attributes **id** and **data-attribute** are set:
~~~
[html]
<tr>
	<td class="editable" data-attribute="name" id=1 >Category 1</td>
	<td class="editable" data-attribute="description" id=1 >Description of Category 1</td>
	<td class="editable" data-attribute="status" id=1 >Active</td>
</tr>
~~~

- **id** is the id of the model instance that will be edited, and
- **data-attribute** is the name of the attribute that will be edited.

Add the following action to your controller `CategoryController.php`:
~~~
[php]
public function actions()
{
	...,
	'updateAttribute' => array(
		'class' => 'ext.EJEditable.actions.UpdateAttributeAction',
	),
  );
}
~~~

**What happens**: All elements with the class "editable" become editable.
A click on the element will turn it into a text field. Edit and press 'enter' to save changes, 
which will send a POST request to the default action `updateAttribute` of the current controller.
That's it!


### 2- Advanced Use
In the same view file you can initiate multiple instances of the widget.
You may need a separate instance for one or more attributes, 
if you for example want to edit them via something else than a text field, e.g. a drop-down list.
~~~
[php]
// Makes all elements with the class "editables" editable
$this->widget('ext.EJEditable.EJEditable', array(
	'url' => $this->createUrl('updateAttribute'),
	'jquerySelector'=>'.editables',
	'options'=>array(
		'indicator'=>CHtml::image(Yii::app()->createUrl('my_assets/images/indicator.gif')),
		'submitdata'=>array('year'=>2014, 'month'=>2),
	)
));
// Makes all elements with the class "editable_stat" editable
// and updates the `status` attribute of the model.
$this->widget('ext.EJEditable.EJEditable', array(
	'url' => $this->createUrl('updateAttribute'),
	'jquerySelector'=>'.editable_stat',
	'attribute'=>'status', 
	'submitDataAttributes'=>false,
	'options'=>array(
		'type'=>'selector',
		'data'=>"{'0':'Inactive', '1':'Active'}",
		'submit'=>'OK',
	)
));
~~~

~~~
[html]
<tr>
	<td class="editables" data-attribute="name" id=1 >Category 1</td>
	<td class="editables" data-attribute="description" id=1 >Description of Category 1</td>
	<td class="editable_stat" data-color="red" id=1 >Active</td>
</tr>
~~~

The widget has five optional properties:

- **url** is the url of the action that handles the POST request and updates the attribute of the model. By default the `updateAttributeAction` included in this extension will be used. You can implement and use your own action by setting this property.
- **jquerySelector**  is a jQuery selector that is used to identify the elements that are to be made editable by this instance of the widget. The default value is ".editable".
See the [jQuery Documentation](http://api.jquery.com/category/selectors/ "jQuery - Selectors") for a list of possible selectors.
- **attribute** is the name of the model's attribute to be updated. The default value is `null`;
it is assumed that the attribute name will be provided via the `data-attribute` of the html element.
- **submitDataAttributes** is a boolean value indicating whether or not the `data-` attributes of the html elements 
should be sent as additional parameters with the POST request. The default value is true. 
- **options** is an array of additional options for the Jeditable plugin. The default value is an empty array.
For a list of possible options and their use see the [Jeditable Project Page](http://www.appelsiini.net/projects/jeditable "Jeditable - Project Page").

The first instance of the widget will make all elements with the class "editables" editable. 
For these elements, a loading indicator will be shown after the form is submitted, while waiting for the response. <br>
Furthermore, the parameters "year=2014" and "month=2" will be added to the POST request. 
Because `submitDataAttributes` is set to true (by default), the parameter "attribute=name", or "attribute=description" respectively, will also be added to the POST request.

The second instance of the widget will make all elements with the class "editable_stat" editable. 
A click on those elements will produce a drop-down list with the options defined in the `data` option. A click on the 'OK' button then submits the form.<br>
Note that `data-attribute` is omitted in the last td element, and the name of the  attribute to be updated is set via the widget's `attribute` property.
Make sure that the attribute name is provided one way or the other.<br>
Since `submitDataAttributes` is set to false, the parameter "color=red" will NOT be added to the POST request.


### 3- Use in CGridView

We can make the cells in a CGridView editable in the following way:
~~~
[php]
$this->widget('ext.EJEditable.EJEditable');
...
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate'=>'js:function(id, data) { init_editable(".editable"); }', // make cells editable again
	'columns'=>array(
		'id',
		'name'=>array(
			'class'=>'ext.EJEditable.components.DataColumn',
			'name'=>'name',
			'evaluateHtmlOptions'=>true,
			'htmlOptions'=>array('class'=>'"editable"', 'data-attribute'=>'"name"', 'id'=>'"{$data->id}"'),
		),
		'description'=>array(
			'class'=>'ext.EJEditable.components.DataColumn',
			'name'=>'description',
			'evaluateHtmlOptions'=>true,
			'htmlOptions'=>array('class'=>'"editable"', 'data-attribute'=>'"description"', 'id'=>'"{$data->id}"'),
		),
		...
	),
));
~~~

It is important to set the `afterAjaxUpdate` property of CGridView, so that after an ajax update the cells
are still editable. Here the function `init_editable(selector)` has to be called as shown in the example above, where `selector` is the jQuery selector 
that is used to identify the td-elements (i.e. cells) of the CGridView. 

Note that we used the class `DataColumn` included in this extension. Please refer to 
[this wiki article about how to use the special variable $data in the htmlOptions of a column in CGridView](http://www.yiiframework.com/wiki/314/cgridview-use-special-variable-data-in-the-htmloptions-of-a-column-i-e-evaluate-htmloptions-attribute/ "Use special variable $data in the htmlOptions of a column in CGridView")
for more information.

### 4- Use in CDetailView

We can make the cells in a CDetailView table editable in the following way:
~~~
[php]
$this->widget('ext.EJEditable.EJEditable');
...
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'name',
			'value'=>$model->name,
			'template'=>"<tr class=\"{class}\"><th>{label}</th><td id={$model->id} class='editable' data-attribute='name'>{value}</td></tr>\n",
		),
		array(
			'name'=>'description',
			'value'=>$model->description,
			'template'=>"<tr class=\"{class}\"><th>{label}</th><td id={$model->id} class='editable' data-attribute='description'>{value}</td></tr>\n",
		),
	),
));
~~~



##Resources
* [Yii Extension Page](http://www.yiiframework.com/extension/ejeditable/ "ejeditable - Yii Extension Page")
* [GitHub Page](https://github.com/c-cba/yii-ejeditable "yii-ejeditable - GitHub Page")
* [Jeditable Project Page](http://www.appelsiini.net/projects/jeditable "Jeditable - Project Page")
* [Jeditable Demo Page](http://www.appelsiini.net/projects/jeditable/default.html "Jeditable - Demo Page")
* [Yii Wiki Article about how to use the special variable $data in the htmlOptions of a column in CGridView](http://www.yiiframework.com/wiki/314/cgridview-use-special-variable-data-in-the-htmloptions-of-a-column-i-e-evaluate-htmloptions-attribute/ "Use special variable $data in the htmlOptions of a column in CGridView")
