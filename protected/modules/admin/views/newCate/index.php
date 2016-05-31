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
			'name'=>'title',
		),
		array(
			'name'=>'alias',
			'filter'=>false,
		),
		array(
			'name'=>'updated',
			'value'=>'date("d-m-Y",$data->updated)',
			'htmlOptions'=>array('class'=>'ct'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>Yii::app()->user->role==='admin'?'{update}{delete}':'{update}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['recordsPerPage'],array(
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
		'header'=>'',
		'selectedPageCssClass'=>'active',
	),
	'pagerCssClass' => 'pagination',
)); ?>