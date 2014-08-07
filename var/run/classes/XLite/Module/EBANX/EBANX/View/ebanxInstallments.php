<?php
 
namespace XLite\Module\EBANX\EBANX\View;
 
class ebanxInstallments extends \XLite\View\FormField\Select\Regular
{
    protected function getDefaultOptions()
    {
        return array(
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
        );
    }
}

?>
