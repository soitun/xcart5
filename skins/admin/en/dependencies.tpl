{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p class="error-message">
{t(#Unable to install module X because some modules, which it depends on, have not been installed or activated yet#,_ARRAY_(#X#^mm.moduleName))}
</p>
<table>
<tr>
  <td>
  {t(#Please, make sure that the following modules are installed and enabled:#)}
	</td>
	<td>
	<table>
		<tr FOREACH="mm.dependencies,dependency">
		<td>{dependency}</td>
		</tr>
	</table>
	</td>
</tr>
</table>
