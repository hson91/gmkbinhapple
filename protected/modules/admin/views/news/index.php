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
			'name'=>'image',
			'value'=>'$data->image != "" && $data->image != null && file_exists(Yii::app()->basePath."/../static/images/news/thumbs/".$data->image) ? CHtml::image(Yii::app()->baseUrl."/static/images/news/thumbs/".$data->image, $data->title, array("style"=>"height: 50px;display:block;margin: 0 auto;")) : "No Image"',
			'type'=>'raw',
		),
		array(
			'name'=>'cate_id',
			'value'=>'$data->category != null ? $data->category->title : "Không Có"',
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
			'name'=>'updated',
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