@extends('layouts.default')
@section('title', 'SPK')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox animated fadeIn">
		<div class="ibox-content no-padding">
			<div class="row p-1" id="spkToolbar">
				<div class="col-6">     
					<a href="#" class="easyui-menubutton" data-options="menu: '#mm', iconCls: 'icon-add', width: 100">Create</a><span class="menu-separator"></span>
					<a href="#" class="easyui-linkbutton" id="duplicateSpkButton" data-options="iconCls: 'icon-reload', plain: true, width: 100" onclick="showCreateOrUpdateSpkWindow('duplicate')">Duplicate</a>
					<a href="#" class="easyui-linkbutton" id="updateSpkButton" data-options="iconCls: 'icon-edit', plain: true, width: 80" onclick="showCreateOrUpdateSpkWindow('update')">Edit</a>
					<a href="#" class="easyui-linkbutton" id="deleteSpkButton" data-options="iconCls: 'icon-remove', plain: true, width: 80" onclick="deleteSpk()">Delete</a>
					<a href="#" class="easyui-linkbutton" id="printSpkButton" data-options="iconCls: 'icon-print', plain: true, width: 80" onclick="printSpk()">Print</a>
				</div>
				<div class="col-6">
					<input class="easyui-searchbox" data-options="prompt: 'Type an SPK Number or Product Code ..'" style="width:100%;" id="search">
				</div>
			</div>
			<div id="mm" style="width:150px;">
				<div data-options="iconCls: ''" onclick="showCreateOrUpdateSpkWindow('create', 'internal')">
					Internal
				</div>
				<div data-options="iconCls: 'icon-undo'" onclick="showCreateOrUpdateSpkWindow('create', 'external')">
					External
				</div>
			</div>
			<table id="spkTable" toolbar="#spkToolbar"></table>
		</div>
	</div>

	<div class="ibox animated fadeIn">
		<div class="ibox-content no-padding">
			<table id="spkLinesOverviewTable"></table>
		</div>
	</div>

	<div id="createOrUpdateSpkWindow" class="easyui-window" title="Basic Window" data-options="iconCls:'icon-save',closed:true, minimizable:false, collapsible:false"  style="width:90%;height:100%;">              
		<div id="createOrUpdateSpkTab" class="easyui-tabs" style="width:100%;height:auto;padding-top:0px">                  
			<div title="SPK Header">
				<form id="spkForm" method="post">
					<input type="hidden" name="_token" id="spkCsrfToken" value="{{ csrf_token() }}">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="item_description" id="itemDescription">
					<input type="hidden" name="item_brand" id="itemBrand">
					<input type="hidden" name="item_instruction" id="itemInstruction">
					<input type="hidden" name="item_size" id="itemSize">
					<input type="hidden" name="search_name" id="searchName">
					<input type="hidden" name="is_internal" id="isInternal">
					<div class="row mb-2">
						<div class="col-md-3">
							<input class="easyui-textbox" label="No. SPK :" labelPosition="top" style="width:100%;" data-options="editable: false" name="spk_number" id="spkNumber">
						</div>
						<div class="col-md-3">
							<input class="easyui-combogrid" label="Item :" labelPosition="top" style="width:100%;"  name="item_code"  id="itemCode">
						</div>         
						<div class="col-md-6">
							<input class="easyui-textbox" label="Item Name :" labelPosition="top" style="width:100%;" name="item_name" data-options="editable: false" id="itemName">
						</div>                        
					</div>
					<div class="row mb-2">
						<div class="col-3" id="billNumberContainer">
							<input class="easyui-combogrid" label="No Nota:" labelPosition="top" style="width:100%;"  name="bill_number" id="billNumber">
						</div>
						<div class="col-3">
							<input class="easyui-textbox" label="Customer :" labelPosition="top" style="width:100%;" name="customer_account" data-options="editable: false" id="customerAccount">
						</div>
						<div class="col-6">
							<input class="easyui-textbox" label="Customer Name :" labelPosition="top" style="width:100%;" name="customer_name" data-options="editable: false" id="customerName">
						</div>      
					</div>
					<div class="row mb-2">
						<div class="col-3">
							<input class="easyui-textbox" label="Quantity :" labelPosition="top" style="width:100%;"  name="quantity" id="quantity">
						</div>
						<div class="col-3">
							<input class="easyui-textbox" label="Unit of Measure :" labelPosition="top" style="width:100%;"  name="unit_of_measure" id="unitOfMeasure">
						</div>
						<div class="col-3">
							<input class="easyui-textbox" label="Quantity in Kg :" labelPosition="top" style="width:100%;"  name="quantity_in_kg" id="quantityInKg">
						</div>
						<div class="col-3">
							<input class="easyui-textbox" label="Shipping Tolerance :" labelPosition="top" style="width: 100%" name="shipping_tolerance" id="shippingTolerance">
						</div>     
					</div>
					<div class="row mb-2">
						<div class="col-3">
							<input class="easyui-datetimebox" label="Shipping Date :" labelPosition="top" style="width:100%;"  name="shipping_date" id="shippingDate">
						</div>
						<div class="col-md-3">
							<input class="easyui-combogrid" label="Item WIP :" labelPosition="top" style="width:100%;"  name="item_wip_code"  id="itemWipCode">
						</div>         
						<div class="col-md-6">
							<input class="easyui-textbox" label="Item WIP Name :" labelPosition="top" style="width:100%;" name="item_wip_name" data-options="editable: false" id="itemWipName">
						</div>
					</div>
					<div class="row mb-4">
						<div class="col-3">
							<input class="easyui-checkbox" label="Repeat Order ?" labelPosition="top" value="1" name="is_repeat_order" id="isRepeatOrder">
						</div>
						<div class="col-9">
							<input class="easyui-textbox" label="Packing Details :" labelPosition="top" style="width:100%;" name="packing_details" multiline="true" data-options="height:'120px'" id="packingDetails">
						</div>
					</div>
					<div class="row text-right">
						<div class="col-sm-12">
							<button type="button" class="btn btn-primary" onclick="createOrUpdateSpk()">SAVE</button>
						</div>
					</div>
				</form>
			</div>
			<div title="SPK Lines">
				<form id="spkLinesForm" method="post">
					<input type="hidden" name="_token" id="spkLinesCsrfToken" value="{{ csrf_token() }}">
					<input type="hidden" name="id" id="spkLinesId">
					<input type="hidden" name="spk_id" id="spkId">
					<input type="hidden" name="item_description" id="spkLinesItemDescription">
					<input type="hidden" name="item_brand" id="spkLinesItemBrand">
					<input type="hidden" name="item_instruction" id="spkLinesItemInstruction">
					<input type="hidden" name="item_size" id="spkLinesItemSize">
					<div class="row mb-3">
						<div class="col-3" id="spkLinesNumberContainer">
							<input class="easyui-textbox" label="SPK Lines Number :" labelPosition="top" style="width:100%;" data-options="editable: false" name="spk_lines_number" id="spkLinesNumber">
						</div>
						<div class="col-3" id="spkLinesPositionContainer">
							<input class="easyui-textbox" label="Posisi:" labelPosition="top" style="width:100%;" name="position" id="spkLinesPosition">
						</div>
						<div class="col-3" id="spkLinesProductionProcessIdContainer">
							<input class="easyui-combogrid" label="Process:" labelPosition="top" style="width:100%;" name="production_process_id" id="spkLinesProductionProcessId">
						</div>
						<div class="col-3" id="spkLinesItemCodeContainer">
							<input class="easyui-combogrid" label="Item :" labelPosition="top" style="width:100%;" name="item_code" id="spkLinesItemCode">
						</div>
						<div class="col-3" id="spkLinesItemNameContainer">
							<input class="easyui-textbox" label="Item Name :" labelPosition="top" style="width:100%;" data-options="editable: false" name="item_name" id="spkLinesItemName">
						</div>
						<div class="col-3" id="spkLinesMaterialTypeContainer">
							<input class="easyui-textbox" label="Jenis Bahan:" labelPosition="top" style="width:100%;" name="material_type" id="spkLinesMaterialType">
						</div>
						<div class="col-3" id="spkLinesCutTypeContainer">
							<input class="easyui-textbox" label="Jenis Potongan:" labelPosition="top" style="width:100%;" name="cut_type" id="spkLinesCutType">
						</div>
						<div class="col-3" id="spkLinesOutputTargetContainer">
							<input class="easyui-textbox" label="Output Target :" labelPosition="top" style="width:100%;" name="output_target" id="spkLinesOutputTarget">
						</div>
						<div class="col-3" id="spkLinesWasteTargetContainer">
							<input class="easyui-textbox" label="Target Waste (%):" labelPosition="top" style="width:100%;" name="waste_target" id="spkLinesWasteTarget">
						</div>
						<div class="col-3" id="spkLinesEstimateFinishDateContainer">
							<input class="easyui-datetimebox" label="Target Selesai :" labelPosition="top" style="width:100%;" name="estimate_finish_date" id="spkLinesEstimateFinishDate">
						</div>
						<div class="col-3" id="spkLinesQuantityOrderContainer">
							<input class="easyui-textbox" label="Jumlah Order:" labelPosition="top" style="width:100%;" name="quantity_order" id="spkLinesQuantityOrder">
						</div>
						<div class="col-3" id="spkLinesUomOrderContainer">
							<input class="easyui-textbox" label="UoM Order:" labelPosition="top" style="width:100%;" name="uom_order" id="spkLinesUomOrder">
						</div>
						<div class="col-3" id="spkLinesCwOrderContainer">
							<input class="easyui-textbox" label="CW Order:" labelPosition="top" style="width:100%;" name="cw_order" id="spkLinesCwOrder">
						</div>
						<div class="col-3" id="spkLinesWidthContainer">
							<input class="easyui-textbox" label="Lebar:" labelPosition="top" style="width:100%;" name="width" id="spkLinesWidth">
						</div>
						<div class="col-3" id="spkLinesLengthContainer">
							<input class="easyui-textbox" label="Panjang:" labelPosition="top" style="width:100%;" name="length" id="spkLinesLength">
						</div>
						<div class="col-3" id="spkLinesThicknessContainer">
							<input class="easyui-textbox" label="Tebal:" labelPosition="top" style="width:100%;" name="thickness" id="spkLinesThickness">
						</div>
						<div class="col-3" id="spkLinesFoldContainer">
							<input class="easyui-textbox" label="Lipatan:" labelPosition="top" style="width:100%;" name="fold" id="spkLinesFold">
						</div>
						<div class="col-3" id="spkLinesNumberOfColorContainer">
							<input class="easyui-textbox" label="Jumlah Warna:" labelPosition="top" style="width:100%;" name="number_of_color" id="spkLinesNumberOfColor">
						</div>
						<div class="col-3" id="spkLinesRollSizeStartContainer">
							<input class="easyui-textbox" label="Ukuran Roll Awal:" labelPosition="top" style="width:100%;" name="roll_size_start" id="spkLinesRollSizeStart">
						</div>
						<div class="col-3" id="spkLinesRollSizeFinishContainer">
							<input class="easyui-textbox" label="Ukuran Roll Akhir:" labelPosition="top" style="width:100%;" name="roll_size_finish" id="spkLinesRollSizeFinish">
						</div>
						<div class="col-3" id="spkLinesPonsSizeTypeContainer">
							<input class="easyui-textbox" label="Jenis Ukuran Ponds:" labelPosition="top" style="width:100%;" name="pons_size_type" id="spkLinesPonsSizeType">
						</div>
						<div class="col-3" id="spkLinesHandleContainer">
							<input class="easyui-textbox" label="Handle:" labelPosition="top" style="width:100%;" name="handle" id="spkLinesHandle">
						</div>
						<div class="col-3" id="spkLinesBoxWeightContainer">
							<input class="easyui-textbox" label="Box Weight:" labelPosition="top" style="width:100%;" name="box_weight" id="spkLinesBoxWeight">
						</div>
						<div class="col-3" id="spkLinesGrossContainer">
							<input class="easyui-textbox" label="Gross:" labelPosition="top" style="width:100%;" name="gross" id="spkLinesGross">
						</div>
						<div class="col-3" id="spkLinesNettoContainer">
							<input class="easyui-textbox" label="Netto:" labelPosition="top" style="width:100%;" name="netto" id="spkLinesNetto">
						</div>
						<div class="col-3" id="spkLinesIsFinishGoodContainer">
							<input class="easyui-checkbox" label="Finish Good ?" labelPosition="top" value="1" name="is_finish_good" id="spkLinesIsFinishGood">
						</div>
						<div class="col-3" id="spkLinesIsUseTreatmentContainer">
							<input class="easyui-checkbox" label="Treat / AC ?" labelPosition="top" value="1" name="is_use_treatment" id="spkLinesIsUseTreatment">
						</div>
						<div class="col-3" id="spkLinesIsUseRotaryContainer">
							<input class="easyui-checkbox" label="Use Rotary ?" labelPosition="top" value="1" name="is_use_rotary" id="spkLinesIsUseRotary">
						</div>                          
					</div> 
					<div class="row text-center mb-3">
						<div class="col-sm-12">
							<button type="button" class="easyui-linkbutton" data-options="iconCls: 'icon-add'" id="createSpkLinesButton" onclick="createOrUpdateSpkLines()">Add</button>
							<button type="button" class="easyui-linkbutton" data-options="iconCls: 'icon-save'" id="updateSpkLinesButton" onclick="createOrUpdateSpkLines()">Save</button>
							<button type="button" class="easyui-linkbutton" data-options="iconCls: 'icon-cut'" id="loadSpkLinesButton" onclick="loadSpkLinesForm()">Edit</button>
							<button type="button" class="easyui-linkbutton" data-options="iconCls: 'icon-remove'" id="deleteSpkLinesButton" onclick="deleteSpkLines()">Delete</button>
						</div>
					</div>
				</form>
				<table id="spkLinesTable" style="width: 100%;"></table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
    <script>
		// init variable
		const windowStatesEnum = {
			CLOSED: "CLOSED",
			CREATE: {
				INTERNAL: "create.internal",
				EXTERNAL: "create.external"
			},
			UPDATE: {
				INTERNAL: {
					NEW: "update.internal.new",
					REPEAT: "update.internal.repeat"
				},
				EXTERNAL: {
					NEW: "update.external.new",
					REPEAT: "update.external.repeat"
				}
			},
			DUPLICATE: {
				INTERNAL: "duplicate.internal",
				EXTERNAL: "duplicate.external"
			}
		};

		var spkIdTemp = '';
		var spkNumberTemp = '';
		var spkLinesIdTemp = '';
		var customerIdTemp = '';
		var windowState = windowStatesEnum.CLOSED;

		$(document).ready(() => {               
			initSpkTable();
			resetSpkButtonsState();

			$('#search').searchbox({
				searcher: (value, name) => reloadSpkTable(value)
			});

			$('#spkTable').datagrid('getPager').pagination({
				nav: $.extend({}, $.fn.pagination.defaults.nav, {
					refresh: {
						iconCls: 'pagination-refresh',
						handler: () => {
							reloadSpkTable();
							$('#search').searchbox('setValue', '');
						}
					}
				})
			});

			$('#createOrUpdateSpkWindow').window({
				onBeforeClose: () => {
					spkIdTemp = '';
					spkNumberTemp = '';
					spkLinesIdTemp = '';
					resetSpkLinesFieldsVisibility();
					setSpkLinesButtonsState(['create'], ['update', 'load', 'delete']);
					clearSpkForm();
					resetSpkFieldsState();
					clearSpkLinesForm();
					reloadSpkTable();
					$('#createOrUpdateSpkTab').tabs('enableTab', 0).tabs('enableTab', 1).tabs({selected: 0});
					$('#billNumber').combogrid({prompt: '', disabled: false});
				}
			})

			$('#spkLinesPosition').textbox({
				onChange: (value) => {
					$('#spkLinesNumber').textbox('setValue', spkLinesNumberBuilder(spkNumberTemp, value));
				}
			});

			$('#itemCode').combogrid({
				mode: 'remote',
				url: 'spk/getItems',
				method: 'GET',
				idField: 'ITEMID',
				textField: 'ITEMID',
				panelWidth: 660,
				columns: [[
					{field: 'ITEMID', title: 'Kode Item', width: 120},
					{field: 'ecores_product_translation_NAME', title: 'Nama', width: 300},
					{field: 'SJB_BRAND', title: 'Brand', width: 120},
					{field: 'STANDARDINVENTSIZEID', title: 'Ukuran', width: 100}
				]],
				onBeforeLoad: () => {
					var element = $('#itemCode').val().length;
					if (element < 2) {
						return false
					}     
				},
				onSelect: (index, row) => {
					$('#itemName').textbox('setValue', row.ecores_product_translation_NAME);
					$('#itemBrand').val(row.SJB_BRAND);
					$('#itemInstruction').val(row.IVS_INSTRUCTION);
					$('#itemDescription').val(row.ecores_product_translation_DESCRIPTION);
					$('#itemSize').val(row.STANDARDINVENTSIZEID);
				}
			});

			$('#itemWipCode').combogrid({
				mode: 'remote',
				url: 'spk/getItems',
				method: 'GET',
				idField: 'ITEMID',
				textField: 'ITEMID',
				panelWidth: 660,
				columns: [[
					{field: 'ITEMID', title: 'Kode Item', width: 120},
					{field: 'ecores_product_translation_NAME', title: 'Nama', width: 300},
					{field: 'SJB_BRAND', title: 'Brand', width: 120},
					{field: 'STANDARDINVENTSIZEID', title: 'Ukuran', width: 100}
				]],
				onBeforeLoad: () => {
					var element = $('#itemWipCode').val().length;
					if (element < 2) {
						return false
					}
				},
				onSelect: (index, row) => {
					$('#itemWipName').textbox('setValue', row.ecores_product_translation_NAME);
				}
			});

			$('#spkLinesItemCode').combogrid({
				mode: 'remote',
				url: 'spk/getItems',
				method: 'GET',
				idField: 'ITEMID',
				textField: 'NAME',
				panelWidth: 660,
				columns: [[
					{field: 'ITEMID', title: 'Kode Item', width: 120},
					{field: 'ecores_product_translation_NAME', title: 'Nama', width: 300},
					{field: 'SJB_BRAND', title: 'Brand', width: 120},
					{field: 'STANDARDINVENTSIZEID', title: 'Ukuran', width: 100}
				]],
				onBeforeLoad: () => {
					var element = $('#spkLinesItemCode').val().length;
					if (element < 2) {
						return false
					}     
				},
				onSelect: (index, row) => {
					$('#spkLinesItemName').textbox('setValue', row.ecores_product_translation_NAME);
					$('#spkLinesItemBrand').val(row.SJB_BRAND);
					$('#spkLinesItemInstruction').val(row.IVS_INSTRUCTION);
					$('#spkLinesItemDescription').val(row.ecores_product_translation_DESCRIPTION);
					$('#spkLinesItemSize').val(row.STANDARDINVENTSIZEID);
				}
			});

			$('#billNumber').combogrid({
				mode: 'remote',
				url: 'spk/getJobOrders',
				method: 'GET',
				idField: 'joborder_no',
				textField: 'joborder_no',
				panelWidth: 600,
				columns: [[
					{field: 'joborder_no', title: 'No. Nota', width: 100},
					{field: 'customer_id', title: 'Customer Id', width: 100},
					{field: 'customer_name', title: 'Customer Name', width: 250}
				]],
				onBeforeLoad: () => {
					var element = $('#billNumber').val().length;
					if (element < 1) {
						return false;
					}
				},
				onSelect: (index, row) => {
					$('#customerAccount').textbox('setValue', row.customer_id); 
					$('#customerName').textbox('setValue', row.customer_name); 
					$('#searchName').val(row.customer_name);                     
				}
			});

			$('#spkLinesProductionProcessId').combogrid({
				mode: 'remote',
				url: 'spk/getProcess',
				method: 'GET',
				idField: 'id',
				textField: 'name',
				columns: [[
						{field: 'name', title: 'Nama', width: 300}
				]],
				onSelect: (index, row) => {
					resetSpkLinesFieldsVisibility();
					setSpkLinesFieldsByProcess(row.name);
				}
			});

			$('#spkLinesEstimateFinishDate').datetimebox({
				formatter: (datetime) => { return toMysqlDatetimeFormatter(datetime) },
				parser: (datetime) => { return fromMysqlDateTimeParser(datetime) }
			});

			$('#shippingDate').datetimebox({
				formatter: (datetime) => { return toMysqlDatetimeFormatter(datetime) },
				parser: (datetime) => { return fromMysqlDateTimeParser(datetime) }
			});
		});

		$(window).resize(() => {
			resizeComponents();
		});

		function activateTriggerByWindowState(){
			resetSpkLinesFieldsVisibility();

			if (windowState == windowStatesEnum.CREATE.INTERNAL){
				$('#billNumber').combogrid({prompt: 'Leave empty.', readonly: true});
				$('#customerAccount').textbox('setValue', 'SJB').textbox('readonly', true);
				$('#customerName').textbox('setValue', 'Sinar Joyoboyo Plastik');
				$('#searchName').val('Sinar Joyoboyo Plastik');
				$('#isInternal').val(1);
				setSpkLinesButtonsState(['create'], ['update', 'load', 'delete']);
			}

			if (windowState == windowStatesEnum.CREATE.EXTERNAL){
				$('#isInternal').val(0);
				setSpkLinesButtonsState(['create'], ['update', 'load', 'delete']);
			}

			if (windowState == windowStatesEnum.UPDATE.INTERNAL.NEW){
				$('#billNumber').combogrid({readonly: true});
				setSpkLinesButtonsState(['create'], ['update', 'load', 'delete']);
			}

			if (windowState == windowStatesEnum.UPDATE.INTERNAL.REPEAT){
				disabledFields = [
					'itemCode', 'billNumber', 'unitOfMeasure', 'shippingTolerance', 
					'itemWipCode', 'isRepeatOrder'
				];
				disableSpkFieldsById(disabledFields);
				setSpkLinesButtonsState([], ['create', 'update', 'load', 'delete']);
				
			}

			if (windowState == windowStatesEnum.UPDATE.EXTERNAL.NEW){}

			if (windowState == windowStatesEnum.UPDATE.EXTERNAL.REPEAT){
				// only load billnumber that belongs to previous customer
				disabledFields = [
					'itemCode', 'billNumber', 'unitOfMeasure', 'shippingTolerance', 
					'itemWipCode', 'isRepeatOrder', 'packingDetails'
				];
				disableSpkFieldsById(disabledFields);
				setSpkLinesButtonsState([], ['create', 'update', 'load', 'delete']);
			}

			if (windowState == windowStatesEnum.DUPLICATE.INTERNAL){
				disabledFields = [
					'itemCode', 'billNumber', 'unitOfMeasure', 'shippingTolerance',
					'itemWipCode', 'isRepeatOrder', 'packingDetails'
				];
				disableSpkFieldsById(disabledFields);
			}

			if (windowState == windowStatesEnum.DUPLICATE.EXTERNAL){
				disabledFields = [
					'itemCode', 'unitOfMeasure', 'shippingTolerance', 
					'itemWipCode', 'isRepeatOrder', 'packingDetails'
				];
				disableSpkFieldsById(disabledFields);
				$('#billNumber').combogrid({
					queryParams: {
						customer_id: customerIdTemp
					}
				});
			}
		}

		function minimizeNavbar(){
			setTimeout(() => resizeComponents(), 500);
		}

		function resizeComponents(){
			var overviewTable = $('#spkLinesOverviewTable');
			$('#spkTable').datagrid('resize');
			if (overviewTable.data('datagrid') !== undefined){
				overviewTable.datagrid('resize');
			}
		}

		function setSpkLinesFieldsByProcess(processName) {
			var quantityOrder = 'spkLinesQuantityOrder';
			var uomOrder = 'spkLinesUomOrder';
			var cwOrder = 'spkLinesCwOrder';
			var width = 'spkLinesWidth';
			var length = 'spkLinesLength';
			var thickness = 'spkLinesThickness';
			var fold = 'spkLinesFold';
			var numberOfColor = 'spkLinesNumberOfColor';
			var roleSizeStart = 'spkLinesRollSizeStart';
			var roleSizeFinish = 'spkLinesRollSizeFinish';
			var ponsSizeType = 'spkLinesPonsSizeType';
			var handle = 'spkLinesHandle';
			var box_weight = 'spkLinesBoxWeight';
			var gross = 'spkLinesGross';
			var netto = 'spkLinesNetto';
			var isUseTreatment = 'spkLinesIsUseTreatment';
			var isUseRotary = 'spkLinesIsUseRotary';
			var isFinishGood = 'spkLinesIsFinishGood';
			var showThisFields = [];

			if (processName == 'ROLL') {
				showThisFields = [quantityOrder, uomOrder, cwOrder, width, thickness, isUseTreatment, isUseRotary, isFinishGood];
			}

			if (processName == 'PRINTING') {
				showThisFields = [quantityOrder, uomOrder, numberOfColor, width, thickness, roleSizeStart, roleSizeFinish, isFinishGood];
			}

			if (processName == 'CUTTING') {
				showThisFields = [quantityOrder, uomOrder, width, length, thickness, handle, box_weight, gross, netto, isFinishGood];
			}

			if (processName == 'GUSSET') {
				showThisFields = [quantityOrder, uomOrder, width, thickness, fold, roleSizeStart, roleSizeFinish];
			}

			if (processName == 'SOFT HANDLE') {
				showThisFields = [quantityOrder, uomOrder, width, length, thickness, handle];
			}

			if (processName == 'SLITTING') {
				showThisFields = [quantityOrder, uomOrder, width, thickness, roleSizeStart, roleSizeFinish];
			}

			if (processName == 'SHEET') {
				showThisFields = [quantityOrder, uomOrder, roleSizeStart, roleSizeFinish];
			}

			if (processName == 'HEAT SEAL') {
				showThisFields = [quantityOrder, uomOrder, width, thickness, roleSizeStart, roleSizeFinish];
			}

			showThisFields.forEach((value) => {
				$('#'+value+'Container').show();
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'textbox'){
					$('#'+value).textbox('resize');
				}

				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'combogrid'){
					$('#'+value).combogrid('resize');
				}
			})
		}
    
		function initSpkTable() {
			$('#spkTable').datagrid({
				title: 'SPK Header',
				url: 'spk/all',
				rownumbers: true,
				fitColumns: true,
				singleSelect: true,
				pagination: true,
				queryParams: {
					_token: '<?= csrf_token() ?>'
				},                    
				onSelect: (index, row) => {
					$('#duplicateSpkButton').linkbutton('enable');
					$('#updateSpkButton').linkbutton('enable');
					$('#deleteSpkButton').linkbutton('enable');
					$('#printSpkButton').linkbutton('enable');
					initSpkLinesOverviewTable(row.id, row.spk_number);
				},
				loadFilter: (data) => {
					var rows = (data.data).map((spk) => {
						uniqueProductionIdTemp = [];
						spk.production_id_joined = ((spk.production_transactions).filter((productionTransactions) => {
								if (productionTransactions.production_id == null) return false;
								if (uniqueProductionIdTemp.includes(productionTransactions.production_id)) return false;
								uniqueProductionIdTemp.push(productionTransactions.production_id);
								return true;
							}).map((productionTransactions) => {
							return productionTransactions.production_id;
						})).join();

						return spk
					});
					return {
						total: data.total,
						rows: rows
					};
				},
				columns: [[
					{field:'spk_number', title: 'SPK Number', width: '8%'},
					{field:'created_at', title: 'Created At', width: '8%', formatter: (value) => rowDateFormatter(value)},
					{field:'item_code', title: 'Item Code', width: '8%'},
					{field:'item_name', title: 'Item Name', width: '20%'},
					{field:'quantity', title: 'Quantity', width: '8%', formatter: (value) => rowCurrencyFormatter(value)},
					{field:'unit_of_measure', title: 'UOM', width: '8%'},
					{field:'customer_account', title: 'Cust No.', width: '8%'},
					{field:'customer_name', title: 'Cust. Name', width: '8%'},
					{field:'bill_number', title: 'Bill Number', width: '8%'},
					{field:'production_id_joined', title: 'BO Number', width: '16%'},
				]]
			});
			var panel = $('#spkTable').datagrid('getPanel');
			panel.panel({
				cls: 'datagrid-panel-fullsize',
				headerCls: 'datagrid-panel-fullsize',
				bodyCls: 'datagrid-panel-fullsize'
			});
		}
          
		function initSpkLinesTable() {
			$('#spkLinesTable').datagrid({
				title: 'SPK Lines',
				url: 'spklines/all',
				fitColumns: true,
				singleSelect: true,
				pagination: true,
				queryParams: {
					_token: '<?= csrf_token() ?>',
					spk_id: spkIdTemp
				},
				onSelect: () => {
					$('#loadSpkLinesButton').linkbutton('enable');
					if (windowState !== windowStatesEnum.UPDATE.INTERNAL.REPEAT && windowState !== windowStatesEnum.UPDATE.EXTERNAL.REPEAT){
						$('#deleteSpkLinesButton').linkbutton('enable');
					}
				},
				columns: [[
					{field:'position', title: 'Position', width: 80, align: 'center'},
					{field:'production_process_name', title: 'Process', width: 80},
					{field:'item_code', title: 'Item Code', width: 100, align: 'center'},
					{field:'item_name', title: 'Item Name', width: 400},
					{field:'item_brand', title: 'Brand', width: 120},
				]]
			});
		}

		function initSpkLinesOverviewTable(spkId, spkNumber) {
			$('#spkLinesOverviewTable').datagrid({
				title: spkNumber +' Overview',
				url: 'spklines/all',
				fitColumns: true,
				singleSelect: true,
				pagination: true,
				queryParams: {
						_token: '<?= csrf_token() ?>',
						spk_id: spkId
				},
				loadFilter: (data) => {
					var rows = (data).map((spkLines) => {
						if (spkLines.production_transactions.length == 0){
							spkLines.production_id_joined = '';
						} else {
							uniqueProductionIdTemp = [];
							spkLines.production_id_joined = (spkLines.production_transactions).filter((productionTransactions) => {
								if (productionTransactions.production_id == null) return false;
								if (uniqueProductionIdTemp.includes(productionTransactions.production_id)) return false;
								uniqueProductionIdTemp.push(productionTransactions.production_id);
								return true;
							}).map((productionTransactions) => {
								return productionTransactions.production_id;
							});
						}

						return spkLines
					});
					return {
						total: data.total,
						rows: rows
					};
				},
				columns: [[
					{field:'position', title: 'Position', width: '8%', align: 'center'},
					{field:'production_process_name', title: 'Process', width: '8%'},
					{field:'quantity_order', title: 'Order Quantity', width: '8%', align: 'center', formatter: (value) => rowCurrencyFormatter(value)},
					{field:'uom_order', title: 'UOM', width: '8%'},
					{field:'waste_target', title: 'Waste Target', width: '8%'},
					{field:'production_id_joined', title: 'BO Number', width: '28%'},
					{field:'is_finish_good', title: 'Finish Good', width: '8%', formatter: (value) => rowIsFinishGoodFormatter(value)},
					{field:'supply_total', title: 'Supply Total', width: '8%', formatter: (value) => rowCurrencyFormatter(value)},
					{field:'good_total', title: 'Good Total', width: '8%', formatter: (value) => rowCurrencyFormatter(value)},
					{field:'waste_total', title: 'Waste Total', width: '8%', formatter: (value) => rowCurrencyFormatter(value)},
				]]
			});
			var panel = $('#spkLinesOverviewTable').datagrid('getPanel');
			panel.panel({
				cls: 'datagrid-panel-fullsize',
				headerCls: 'datagrid-panel-fullsize',
				bodyCls: 'datagrid-panel-fullsize'
			});
		}

		function showCreateOrUpdateSpkWindow(type, customerType = ''){
			if (type == 'create') {
				windowState = (customerType == 'internal') 
						? windowStatesEnum.CREATE.INTERNAL 
						: windowStatesEnum.CREATE.EXTERNAL;

				$('#createOrUpdateSpkWindow').window('open').window('setTitle', 'Tambah Data');
				$('#createOrUpdateSpkTab').tabs('disableTab', 1);
				activateTriggerByWindowState();

				$.ajax({
					url: "spk/getSpkNumber/" + customerType,
					method: "GET",
				}).done((data) => {
					$('#spkNumber').textbox('setValue', data);
					$('#spkLinesNumber').textbox('setValue', data);
					spkNumberTemp = data;
				});
			}

			if (type == 'update') {
				var row = $('#spkTable').datagrid('getSelected');
				if (row) {
					spkIdTemp = row.id;
					spkNumberTemp = row.spk_number;
					$('#spkId').val(row.id);

					initSpkLinesTable();
					$('#createOrUpdateSpkWindow').window('open').window('setTitle', 'Edit Data');
					reloadSpkLinesTable();
					if (row.is_internal){
						windowState = (row.is_repeat_order) 
							? windowStatesEnum.UPDATE.INTERNAL.REPEAT 
							: windowStatesEnum.UPDATE.INTERNAL.NEW;
					} else {
						windowState = (row.is_repeat_order) 
							? windowStatesEnum.UPDATE.EXTERNAL.REPEAT 
							: windowStatesEnum.UPDATE.EXTERNAL.NEW;
					}
					activateTriggerByWindowState();
					$('#spkForm').form('load', row);
					$('#spkLinesNumber').textbox('setValue', row.spk_number);
				} else {
					swal({
						icon: 'error',
						title: 'Oops..',
						text: 'Silahkan pilih SPK yang akan diubah!'
					});
				}
			}

			if (type == 'duplicate'){
				var row = $('#spkTable').datagrid('getSelected');
				if (row){
					customerIdTemp = row.customer_account;
					$('#createOrUpdateSpkWindow').window('open').window('setTitle', 'Duplicate Data');
					$('#createOrUpdateSpkTab').tabs('disableTab', 1);
					windowState = (row.is_internal)
							? windowStatesEnum.DUPLICATE.INTERNAL
							: windowStatesEnum.DUPLICATE.EXTERNAL;
					activateTriggerByWindowState();
					$('#spkForm').form('load', row);
				}
			}
		}

		function disableSpkFieldsById(disabledFields = []){
			disabledFields.forEach((value, index) => {
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'textbox'){
						$('#'+value).textbox({editable: false});
				}
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'combogrid'){
						$('#'+value).combogrid({readonly: true});
				}
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'checkbox'){
						$('#'+value).checkbox({readonly: true});
				}
			})
		}

		function resetSpkFieldsState(){
			var spkFields = [
				'itemCode', 'billNumber', 'quantity', 'unitOfMeasure',
				'quantityInKg', 'shippingTolerance', 'shippingDate', 'itemWipCode',
				'isRepeatOrder', 'packingDetails'
			];
			spkFields.forEach((value, index) => {
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'textbox'){
						$('#'+value).textbox({editable: true});
				}
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'combogrid'){
						$('#'+value).combogrid({readonly: false});
				}
				if ((($('#'+value).attr('class')).split("-")[1]).split(' ')[0] == 'checkbox'){
						$('#'+value).checkbox({readonly: false});
				}
			});
		}

		function createOrUpdateSpk(){
			var url = 'spk';
			var method = 'POST';
			var id = $('#id').val();
			var alertMessage = 'Create SPK Success. Goto SPK Lines';
			var mode = 'create';

			if (id !== '') {
				url = 'spk/' + id;
				method = 'PUT';
				alertMessage = "SPK has been updated successfully.";
				mode = 'update';
			}

			if (windowState == windowStatesEnum.DUPLICATE.INTERNAL || windowState == windowStatesEnum.DUPLICATE.EXTERNAL){
				url = 'spk/' + id;
				method = 'PATCH';
				alertMessage = "SPK has been duplicated successfully.";
				mode = 'update';
			}

			$.ajax({
				url: url,
				method: method,
				data: $('#spkForm').serialize(),
				success: (response) => {
					if (mode == 'create'){
						$('#spkId').val(response.data);
						$('#spkForm').form("reset");
						$('#createOrUpdateSpkTab').tabs('enableTab', 1).tabs('disableTab', 0).tabs({selected: 1});
						spkIdTemp = response.data;
						initSpkLinesTable();
						reloadSpkLinesTable();
					}
					swal({
						position: 'top-end',
						icon: 'success',
						title: alertMessage,
						showConfirmButton: false,
						timer: 1500
					});
					reloadSpkTable();
				},
				error: (response) => {
					if (response.status == 422) {
						let jsonErrors = response.responseJSON.errors;
						var errorFields = '';
						Object.keys(jsonErrors).forEach((key) => {
							errorFields += jsonErrors[key] + '\n'
						})
						swal({
							icon: 'error',
							title: 'Oops..',
							text: errorFields
						});
					} else {
						console.log(response.responseJSON.errors);
					}
				}
			});
		}

		function deleteSpk(){
			var row = $('#spkTable').datagrid('getSelected');
			if (row){
				swal({
					text: "Hapus " + row.spk_number + " ?",
					icon: "warning",
					buttons: true,
					dangerMode: true
				}).then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: 'spk/' + row.id,
							method: 'DELETE',
							data: {
								_token: '<?= csrf_token() ?>'
							},
							success: (response) => {
								reloadSpkTable();
								swal({
									icon: 'success',
									title: 'Yeay..',
									text: 'SPK berhasil dihapus'
								});
							}
						});
					}
				});
			} else {
				swal('Perhatian','Silahkan pilih data yang akan dihapus!','info');
			}
		}

		function createOrUpdateSpkLines(){
			var url = 'spklines';
			var method = 'POST';
			var id = $('#spkLinesId').val();
			var alertMessage = 'SPK Lines created successfully';
			var mode = 'create';

			if (id !== ''){
				url = 'spklines/' + id;
				method = 'PUT';
				alertMessage = 'SPK Lines has been updated successfully.';
				mode = 'update';
			}

			$.ajax({
				url: url,
				method: method,
				data: $('#spkLinesForm').serialize(),
				success: (response) => {
					clearSpkLinesForm();                         
					reloadSpkLinesTable();
					resetSpkLinesFieldsVisibility();
					if (windowState == windowStatesEnum.CREATE.INTERNAL || windowState == windowStatesEnum.CREATE.EXTERNAL){    
						setSpkLinesButtonsState(['create'], ['update', 'load', 'delete']);
					} else {
						if (windowState == windowStatesEnum.UPDATE.INTERNAL.NEW || windowState == windowStatesEnum.UPDATE.EXTERNAL.NEW){
							setSpkLinesButtonsState(['create'], ['update', 'load', 'delete']);
						} else {
							setSpkLinesButtonsState([], ['create', 'update', 'load', 'delete']);
						}
					}
					reloadSpkTable();
					swal({
						position: 'top-end',
						icon: 'success',
						title: alertMessage,
						showConfirmButton: false,
						timer: 1500
					});
				},
				error: (response) => {
					if (response.status == 422) {
						let jsonErrors = response.responseJSON.errors;
						var errorFields = '';
						Object.keys(jsonErrors).forEach((key) => {
							errorFields += jsonErrors[key] + '\n'
						})
						swal({
							icon: 'error',
							title: 'Oops..',
							text: errorFields
						});
					} else {
						console.log(response.responseJSON.errors);
					}
				}
			});
		}

		function deleteSpkLines(){             
			var row = $('#spkLinesTable').datagrid('getSelected');
			if (row) {
				swal({
					text: "Hapus " + row.spk_lines_number + " ?",
					icon: "warning",
					buttons: true,
					dangerMode: true
				}).then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: 'spklines/' + row.id,
							method: 'DELETE',
							data: {
								_token: '<?= csrf_token() ?>'
							}
						}).done(() => {
							reloadSpkLinesTable();
							setSpkLinesButtonsState();
							resetSpkLinesFieldsVisibility();
							$('#spkLinesForm').form('reset');
							swal({
								icon: 'success',
								title: 'Yeay..',
								text: 'SPK Lines berhasil dihapus'
							});
						})
					}
				});
			} else {
				swal({
					icon: 'error',
					title: 'Oops..',
					text: 'Silahkan pilih SPK Lines yang akan dihapus!'
				});
			}
		}

		function loadSpkLinesForm(){             
			var row = $('#spkLinesTable').datagrid('getSelected');
			if (row) {
				$('#spkLinesForm').form('load', row);
				$('#updateSpkLinesButton').linkbutton('enable');
				$('#createSpkLinesButton').linkbutton('disable');
				resetSpkLinesFieldsVisibility();
				setSpkLinesFieldsByProcess(row.production_process_name);
			} else {
				swal({
					icon: 'error',
					title: 'Oops..',
					text: 'Silahkan pilih SPK Lines yang akan diubah!'
				});
			}
		}

		function reloadSpkTable(search = ''){
			$('#spkTable').datagrid('load', {
				_token: '<?= csrf_token() ?>',
				search: search
			});
		}

		function reloadSpkLinesTable(){
			$('#spkLinesTable').datagrid('load', {
				_token: '<?= csrf_token() ?>',
				spk_id: spkIdTemp
			});
		}

		function resetSpkButtonsState(){
			$('#duplicateSpkButton').linkbutton('disable');
			$('#updateSpkButton').linkbutton('disable');
			$('#deleteSpkButton').linkbutton('disable');
			$('#printSpkButton').linkbutton('disable');
		}

		/* Available buttons = create, update, load, delete */
		function setSpkLinesButtonsState(enable = [], disable = []){
			enable.forEach((value) => {
				$('#'+value+'SpkLinesButton').linkbutton('enable');
			});
			disable.forEach((value) => {
				$('#'+value+'SpkLinesButton').linkbutton('disable');
			});
		}

		function clearSpkForm(){
			$('#spkForm').form('clear');
			$('#spkCsrfToken').val('<?= csrf_token() ?>');
		}

		function clearSpkLinesForm(){
			$('#spkLinesForm').form('clear');
			$('#spkLinesCsrfToken').val('<?= csrf_token() ?>');
			$('#spkId').val(spkIdTemp);
			$('#spkLinesNumber').val(spkNumberTemp);
		}

		function resetSpkLinesFieldsVisibility(){
			$('#spkLinesQuantityOrderContainer').hide();
			$('#spkLinesUomOrderContainer').hide();
			$('#spkLinesCwOrderContainer').hide();
			$('#spkLinesWidthContainer').hide();
			$('#spkLinesLengthContainer').hide();
			$('#spkLinesThicknessContainer').hide();
			$('#spkLinesFoldContainer').hide();
			$('#spkLinesNumberOfColorContainer').hide();
			$('#spkLinesRollSizeStartContainer').hide();
			$('#spkLinesRollSizeFinishContainer').hide();
			$('#spkLinesPonsSizeTypeContainer').hide();
			$('#spkLinesHandleContainer').hide();
			$('#spkLinesBoxWeightContainer').hide();
			$('#spkLinesGrossContainer').hide();
			$('#spkLinesNettoContainer').hide();
			$('#spkLinesIsUseTreatmentContainer').hide();
			$('#spkLinesIsUseRotaryContainer').hide();
			$('#spkLinesIsFinishGoodContainer').hide();
		}

		function printSpk(){
			var selectedRow = $('#spkTable').datagrid('getSelected');
			if (selectedRow) {
				window.open("reports/" + selectedRow.id, '_blank')
			} else {
				swal({
					icon: 'error',
					title: 'Oops..',
					text: 'Silahkan pilih SPK yang akan dicetak.'
				});
			}
		}

		function spkLinesNumberBuilder(spkNumber, position){
			if (position == "") {
				return spkNumber;
			}
			return spkNumber + '-' + position;
		}
    </script>
@endsection