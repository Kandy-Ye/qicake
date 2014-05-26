<?php 
  global $orderStatus, $orderBillStatus, $receiptStatus, $billStatus, $repairStatus, $complaintStatus, $complaintContent, $complaintRequirement, 
    $invoiceStatus, $couponStatus, $faultStatus, $evaluation, $abortReasons, $tagTypes;

  $orderStatus = array('Created' => '新创建待审核', 'Confirmed' => '已审核待分派', 'Dispatched' => '已分派待完成', 
            'Repaired' => '已完成待回访', 'Inquiried' => '已回访', 'TwiceInquiried' => '已二次回访', 'Aborted' => '已流单');

  $orderBillStatus = array('NotReceivable' => '不可收取', 'Receivable' => '应收取', 'Billed' => '已出账单', 'Received' => '已收取', 'Canceled' => '已取消');

  $receiptStatus = array('Receivable' => '应收取', 'Billed' => '已出账单', 'Received' => '已收取', 'Canceled' => '已取消');
  
  $couponStatus = array('Created' => '新创建', 'Confirmed' => '已审核', 'Replenished' => '已充值', 'Canceled' => '已取消');

  $billStatus = array('Receivable' => '未收款', 'Informed' => '已催款', 'Received' => '已收款', 'Canceled' => '已取消');

  $repairStatus = array('BeLate' => '人还没来', 'NotFixed' => '人来了，没修好', 'Fixed' => '已修好', 'BrokenAgain' => '修好又坏了');

  $complaintContent = array('BadService' => '服务规范问题', 'BadQuantity' => '维修质量问题', 'BadPrice' => '乱收费问题', 'Other' => '其他');

  $complaintRequirement = array('Urge' => '催促派人', 'Substitution' => '换人', 'Abort' => '放弃维修', 'Rework' => '返修', 'NeedInvoice' => '索要发票', 
            'Compensation' => '索要赔偿', 'Other' => '其他');

  $complaintStatus = array('NotFixed' => '尚未处理', 'Fixed' => '已处理', 'Abort' => '已流单');

  $invoiceStatus = array('NotPrinted' => '尚未打印', 'Printed' => '已打印', 'Sent' => '已寄出');

  $faultStatus = array('Repaired' => '已修好', 'NotRepaired' => '没修好', 'BrokenAgain' => '修好后坏了');

  $evaluation = array('VeryBad' => '很不满意', 'Bad' => '不满意', 'Normal' => '一般', 'Satisfied' => '满意', 'QuiteSatisfied' => '很满意');

  $abortReasons = array('Inquiry' => '仅仅是咨询', 'BadPrice' => '费用太贵', 'CustomerCancled' => '放弃维修', 'CustomerChangeProvider' => '换公司维修', 
    'DisputedMaintainMethod' => '不认同维修方式', 'BadMaintenance' => '维修后无法彻底解决问题', 'OutOfAbility' => '技术人员无法处理', 'BeLate' => '上门时间太慢', 
    'NeedDiagnosisOnly' => '仅需师傅上门看看', 'OutOfService' => '不属于业务范围', 'OutOfArea' => '上海未覆盖范围', 'OutOfCity' => '非上海用户', 'Other' => '其他原因');

  $tagTypes = array('System' => '系统标签', 'Symbol' => '符号标签', 'Customer' => '自定义');
?>
