{include:file='{$BACKEND_CORE_PATH}/layout/templates/header.tpl'}
{include:file='{$BACKEND_CORE_PATH}/layout/templates/sidebar.tpl'}
		<td id="contentHolder">
			<div class="inner">
				{form:add}
					<fieldset>
						<label for="path">Pad</label>
						<p>{$txtPath} {$txtPathError}</p>

						<label for="label">Label</label>
						<p>{$txtLabel} {$txtLabelError}</p>

						<label for="num_blocks">Aantal blokken</label>
						<p>{$ddmNumBlocks} {$ddmNumBlocksError}</p>

						{iteration:names}
							<label for="name{$names.i}">Naam {$names.i}</label>
							<p>{$names.txtName} {$names.txtNameError}</p>
						{/iteration:names}

						<label for="format">Formaat</label>
						<p>{$txtFormat} {$txtFormatError}</p>

						<p><label for="active">{$chkActive} {$chkActiveError} Actief</label></p>
						<p><label for="default">{$chkDefault} {$chkDefaultError} Default</label></p>
					</fieldset>

					<div class="fullwidthOptions">
						<div class="buttonHolderRight">
							<input id="add" class="inputButton button mainButton" type="submit" name="add" value="{$lblAddTemplate|ucfirst}" />
						</div>
					</div>
				{/form:add}
			</div>
		</td>
	</tr>
</table>
{include:file='{$BACKEND_CORE_PATH}/layout/templates/footer.tpl'}