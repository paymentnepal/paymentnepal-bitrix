<?
define("STOP_STATISTICS", true);
define("NOT_CHECK_PERMISSIONS", true);

if(!require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"))
    die('prolog_before.php not found!');
if(!CModule::IncludeModule("sale")) die('sale module not found');
IncludeModuleLangFile(__FILE__);
if(!CModule::IncludeModule("paymentnepal.payment")) die('paymentnepal.payment module not found');

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $module_id = "paymentnepal.payment";
    $request = $_POST;
    $transaction_id = $request["tid"];
    $order_id = $request["comment"];

    if (!($arOrder = CSaleOrder::GetByID(IntVal($request["comment"])))){
        AddMessage2Log(GetMessage("PAYMENTNEPAL.PAYMENT_WRONG_ORDER_ID", array("#ORDER_ID#" => $order_id)),$module_id);
        SendError(GetMessage("PAYMENTNEPAL.PAYMENT_WRONG_ORDER_ID", array("#ORDER_ID#" => $order_id)),$module_id);
        mail('support@paymentnepal.com',$_SERVER["SERVER_NAME"],GetMessage("PAYMENTNEPAL.PAYMENT_WRONG_ORDER_ID"));
    } else {
        if (!(CPaymentnepalPayment::VerifyCheck($request, $arOrder["LID"]))) {
            $strStatus = "";
            $strStatus .= GetMessage("PAYMENTNEPAL.PAYMENT_PAYMENT_ID", array("#TRANSACTION_ID#" => $transaction_id));
            $strStatus .= GetMessage("PAYMENTNEPAL.PAYMENT_SIGNS_DONT_MATCH", array("#ORDER_ID#" => $order_id));

            $arFields = array(
                "PS_STATUS" => "N",
                "PS_STATUS_MESSAGE" => $strStatus,
                "PS_RESPONSE_DATE" => date("d-m-Y H:i:s"),
                "USER_ID" => $arOrder["USER_ID"]
            );
            CSaleOrder::Update($arOrder["ID"], $arFields);
        } else {
            $strStatus = "";
            $strStatus .= GetMessage("PAYMENTNEPAL.PAYMENT_PAYMENT_ID", array("#TRANSACTION_ID#" => $transaction_id));
            $strStatus .= GetMessage("PAYMENTNEPAL.PAYMENT_PAYMENT_FOR_ORDER_SUCCESFUL", array("#ORDER_ID#" => $order_id));

            if ($arOrder["PRICE"] <= $request["system_income"]){
                $payed = "Y";
                CSaleOrder::PayOrder($arOrder["ID"], "Y");
            } else {
                $payed = "N";
                $strStatus .= GetMessage("PAYMENTNEPAL.PAYMENT_NOT_FULL_PAYMENT");
            }

            $arFields = array(
                "PAYED" => $payed,
                "PS_STATUS" => "Y",
                "STATUS_ID" => "P",
                "SUM_PAID" => $request["system_income"],
                "PS_STATUS_MESSAGE" => $strStatus,
                "PS_SUM" => $request["system_income"],
                "PS_RESPONSE_DATE" => date("d-m-Y H:i:s"),
                "USER_ID" => $arOrder["USER_ID"]
            );
            CSaleOrder::Update($arOrder["ID"], $arFields);
        }
    }
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
