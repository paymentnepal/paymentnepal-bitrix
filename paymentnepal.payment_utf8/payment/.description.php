<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
IncludeModuleLangFile(__FILE__);

$psTitle = GetMessage("PAYMENTNEPAL.PAYMENT_TITLE");
$psDescription  = GetMessage("PAYMENTNEPAL.PAYMENT_DESC");

$arPSCorrespondence = array(
    "ORDER_ID" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_ORDER_ID"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_ORDER_ID_DESC"),
        "VALUE" => "ID",
        "TYPE" => "ORDER",
    ),
    "DATE_INSERT" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_ORDER_DATE"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_ORDER_DATE_DESC"),
        "VALUE" => "DATE_INSERT",
        "TYPE" => "ORDER",
    ),
    "SHOULD_PAY" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_ORDER_SUM"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_ORDER_SUM_DESC"),
        "VALUE" => "SHOULD_PAY",
        "TYPE" => "ORDER",
    ),
    "PHONE" => array(
       "NAME" => GetMessage("PAYMENTNEPAL.PHONE_NAME"),
       "DESCR" => GetMessage("PAYMENTNEPAL.PHONE_DESC"),
       "VALUE" => "PHONE",
       "TYPE" => "PROPERTY",
    ),
"COMMISSION" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_COMMISSION"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_COMMISSION_DESC"),
        "VALUE" => "0",
        "TYPE" => "",
    ),
"PAY_CART" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_CART"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_SELECTPAY_DESC"),
        "VALUE" => "1",
        "TYPE" => "",
    ),
"PAY_WM" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_WM"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_SELECTPAY_DESC"),
        "VALUE" => "1",
        "TYPE" => "",
    ),
"PAY_YM" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_YM"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_SELECTPAY_DESC"),
        "VALUE" => "1",
        "TYPE" => "",
    ),
"PAY_MC" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_MC"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_SELECTPAY_DESC"),
        "VALUE" => "1",
        "TYPE" => "",
    ),
"PAY_QIWI" => Array(
        "NAME" => GetMessage("PAYMENTNEPAL.PAYMENT_QIWI"),
        "DESCR" => GetMessage("PAYMENTNEPAL.PAYMENT_SELECTPAY_DESC"),
        "VALUE" => "1",
        "TYPE" => "",
    ),
);
?>
