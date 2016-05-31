<div class="action">
    <?php echo CHtml::link('<i>&#xf055;</i>Thêm', array('create')); ?>
    <?php echo CHtml::ajaxLink("<i>&#xf014;</i>Xóa chọn", array('deletes'), array(
        "type"    => "post",
        "data"    => "js:{ids:$.fn.yiiGridView.getChecked('data-grid','ids')}",
        "success" => "function(data){
            $.fn.yiiGridView.update('data-grid'); 
        }"),
        array('confirm' => 'Bạn có chắc chắn muốn xóa?')); 
    ?>
</div>
<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'data-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions'=>array('class'=>'table tbuser'),
	'summaryText'=>'',
	'filter'=>$model,
	'afterAjaxUpdate'=>'function(id, data){$("#data-grid").append("<script src=\"'.Yii::app()->controller->module->assetsUrl.'/js/status.js\"><script src=\"'.Yii::app()->controller->module->assetsUrl.'/js/ordering.js\"><\/script><script src=\"'.Yii::app()->controller->module->assetsUrl.'/js/detail.js\"><\/script>");}',
	'columns'=>array(
		array(
			'id'=>'ids',
			'class'=>'CCheckBoxColumn',
			'selectableRows' => 2,
            'htmlOptions'=>array('class'=>'ct mini'),
            'filterHtmlOptions'=>array('class'=>'mini'),
		),
		array(
			'name'=>'id',
			'htmlOptions'=>array('class'=>'ct mini'),
            'filterHtmlOptions'=>array('class'=>'mini'),
		),
		array(
			'name'=>'username',
		),
		array(
			'name'=>'roles',
			'htmlOptions'=>array('class'=>'ct'),
		),
        array(
			'name'=>'email',
			'htmlOptions'=>array('class'=>'ct'),
		),
        array(
			'name'=>'phone',
			'htmlOptions'=>array('class'=>'ct'),
		),
		array(
			'name'=>'visited',
			'value'=>'date("d-m-Y", strtotime($data->visited))',
			'htmlOptions'=>array('class'=>'ct'),
			
		),
		array(
            'name'=>'status',
			'value'=>'$data->status==1?
				CHtml::link("<i>&#xf00c;</i>", array("status","id"=>$data->id), array("class"=>"status", "id"=>"status".$data->id)):
				CHtml::link("<i>&#xf00d;</i>", array("status","id"=>$data->id), array("class"=>"status", "id"=>"status".$data->id))',
			'type'=>'raw',
			'filter'=>Yii::app()->params['status'],
			'htmlOptions'=>array('class'=>'ct mini'),
			'filterHtmlOptions'=>array('class'=>'mini'),
        ),
		array(
			'class'=>'CButtonColumn',
			'template'=>Yii::app()->user->role==='admin'?'{update}{delete}':'{update}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),array(
						  'onchange'=>"$.fn.yiiGridView.update('data-grid',{data:{pageSize: $(this).val()}})")),        
            'htmlOptions'=>array('class'=>'ct act'),
			'buttons'=>array(
				'update' => array(
					'label'=>'<i>&#xf040;</i>',
					'options'=>array('title'=>'Cập Nhật'),
					'imageUrl'=>false,
				),
				'delete' => array(
					'label'=>'<i>&#xf014;</i>',
					'options'=>array('title'=>'Xóa'),
					'imageUrl'=>false,
				),
			),
		),
	),
	'pager'=>array(
		'cssFile'=>false,
		'class'=>'CLinkPager',
		'pageSize'=>50,
		'firstPageLabel' => 'First',
		'prevPageLabel' => 'Previous',
		'nextPageLabel' => 'Next',
		'lastPageLabel' => 'Last',
		'selectedPageCssClass'=>'active',
		'header'=>'',
	),
	'pagerCssClass' => 'pagination',
)); ?>