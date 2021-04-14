<?
global $MESS;
$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen("/index.php"));
IncludeModuleLangFile($PathInstall."/install.php");

Class paymentnepal_payment extends CModule
{
    var $MODULE_ID = "paymentnepal.payment";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";
    var $PARTNER_NAME;
    var $PARTNER_URI;

    function paymentnepal_payment()
    {
        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage("PAYMENTNEPAL.PAYMENT_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("PAYMENTNEPAL.PAYMENT_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = GetMessage("PAYMENTNEPAL.PAYMENT_PARTNER_NAME");
        $this->PARTNER_URI = "http://www.paymentnepal.com";
    }

    function DoInstall()
    {
        global $APPLICATION, $step, $errors;

        $step = IntVal($step);
        if($step<2)
            $APPLICATION->IncludeAdminFile(GetMessage("PAYMENTNEPAL.PAYMENT_INSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/step1.php");
        elseif($step==2){
            $errors = $this->errors;
            $this->InstallFiles();
            $this->InstallDB();            
            $APPLICATION->IncludeAdminFile(GetMessage("PAYMENTNEPAL.PAYMENT_INSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/step2.php");
        }
    }

    function DoUninstall()
    {
        global $APPLICATION, $step;

        $step = IntVal($step);
        if($step<2)
            $APPLICATION->IncludeAdminFile(GetMessage("PAYMENTNEPAL.PAYMENT_UNINSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/unstep1.php");
        elseif($step==2){
            $errors = $this->errors;
            $this->UnInstallFiles();
            $this->UnInstallDB();
            $APPLICATION->IncludeAdminFile(GetMessage("PAYMENTNEPAL.PAYMENT_UNINSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/unstep2.php");
        }
    }

    function InstallDB()
    {
            global $DB, $DBType, $APPLICATION;
            $this->errors = false;
            RegisterModule("paymentnepal.payment");
            $arOptions = array("key", "secret_key");
            foreach($arOptions as $name) {
                    COption::SetOptionString("paymentnepal.payment", $name, $_REQUEST[$name], "");
            }
            return true;
    }

    function UnInstallDB($arParams = array())
    {
            global $DB, $DBType, $APPLICATION;
            $this->errors = false;
            UnRegisterModule("paymentnepal.payment");
            COption::RemoveOption("paymentnepal.payment", "");
            return true;
    }


    function InstallFiles()
    {
            CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/payment/",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/sale_payment/paymentnepal.payment/");
            CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/tools/",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/paymentnepal.payment/");
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/themes/.default/",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/");
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/paymentnepal.payment/install/themes/.default/icons/paymentnepal/",
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/icons/paymentnepal/");
            return true;
    }

    function UnInstallFiles()
    {
            DeleteDirFilesEx("/bitrix/php_interface/include/sale_payment/paymentnepal.payment");
            DeleteDirFilesEx("/bitrix/tools/paymentnepal.payment/");
            DeleteDirFilesEx("/bitrix/themes/.default/icons/paymentnepal/");
            return true;
    }
}
