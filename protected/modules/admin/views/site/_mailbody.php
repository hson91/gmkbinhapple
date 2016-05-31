<?php 
    $total = count($coupons); 
    $basePath = Yii::app()->request->getHostInfo().(Yii::app()->request->serverName=='localhost'?'/hotdeal/':'/'); 
?>
<?php if ($total > 0) : ?>
<table style="background:none repeat scroll 0% 0% #7daf4e;border:10px solid #7daf4e;width:650px" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td style="background:#fff;border-bottom:10px solid #7daf4e">
				<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
					<tbody>
						<tr>
							<td style="padding:10px" width="28%"><?php echo CHtml::link(CHtml::image($basePath.'images/logo.png', 'Dream Deal', array('title'=>'Dream Deal','height'=>64)),$basePath,array('_target'=>'blank')); ?></td>
							<td style="text-align:center;font-family:Arial,Helvetica,sans-serif" align="center" width="72%">
                            <?php echo CHtml::link('Dream Deal', $basePath, array('style'=>'font-size:30px;font-weight:bold;color:#89b556;text-decoration:none','_target'=>'_blank')); ?></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
        <?php $count = 1; foreach ($coupons as $coupon) : ?>
		<tr>
			<td style="background:#fff">
				<table style="width:100%" cellpadding="10" cellspacing="0" border="0">
					<tbody>
						<tr>
							<td valign="top" width="300"><?php echo CHtml::link(CHtml::image($basePath.'images/coupons/'.$coupon['image'], $coupon['title'], array('title'=>$coupon['title'],'height'=>200,'width'=>300,'border'=>0)),$basePath.$coupon['alias'].'-'.$coupon['id'],array('_target'=>'blank','style'=>'border:none;text-decoration:none')); ?></td>
							<td style="padding-left:0" valign="top">
								<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
									<tbody>
										<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:18px;font-weight:bold;padding-right:10px" height="36">
                                                <?php echo CHtml::link($coupon['title'], $basePath.$coupon['alias'].'-'.$coupon['id'], array('style'=>'text-decoration:none','target'=>'_blank')); ?>
											</td>
										</tr>
										<tr>
											<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;padding-right:10px" height="110" valign="top">Đầm Denim Dễ Thương
												<?php echo $coupon['short_title']; ?>
											</td>
										</tr>
										<tr>
											<td style="background:#efefef;min-height:36px;font-family:Arial,Helvetica,sans-serif">
												<table style="width:100%" cellpadding="0" cellspacing="0" border="0">
													<tbody>
														<tr>
															<td style="border-right:1px solid #ccc;padding:5px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="center" width="21%">Giảm<br> <span style="font-size:18px;color:#c52127"><?php echo $coupon['discount']; ?>%</span></td>
															<td style="border-right:1px solid #ccc;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="center" width="49%">Giá
																bán <br> <span style="font-size:18px;color:#c52127;font-weight:bold"><?php echo number_format((float) ($coupon['price']-$coupon['price']*$coupon['discount']/100), 0, '', '.'); ?> VNĐ</span>
															</td>
															<td style="padding:0 8px;font-family:Arial,Helvetica,sans-serif" align="center" width="30%">
																<table style="background-color:#f8cd81;width:72px;min-height:31px;border:1px solid #d27d00" cellpadding="0" cellspacing="0" bgcolor="#f8cd81">
																	<tbody>
																		<tr>
																			<td style="width:72px;min-height:31px;padding:0;text-align:center;font-family:Arial" height="31" width="72">
                                                                            <?php echo CHtml::link('Xem', $basePath.$coupon['alias'].'-'.$coupon['id'], array('style'=>'width:72px;line-height:31px;display:block;color:#c22227;font-size:21px;font-weight:bold;text-decoration:none','target'=>'_blank')); ?>
                                                                            </td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
        <?php if ($count < $total) : ?>
		<tr>
			<td style="background:#7daf4e;min-height:10px;font-size:1px" bgcolor="#7daf4e" height="10">&nbsp;</td>
		</tr>
        <?php endif ?>
        <?php $count++; ?>
        <?php endforeach ?>
    </tbody>
</table>
<?php endif ?>