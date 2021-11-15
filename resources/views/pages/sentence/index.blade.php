@extends('layouts.default')
@section('title', 'Peribahasa')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox animated fadeIn">
		<div class="ibox-content no-padding">
			<div class="row p-1" id="sentenceToolbar">
				<div class="col-6">     
					<a href="#" class="easyui-linkbutton" id="createSentenceButton" data-options="iconCls: 'icon-add', plain: true, width: 80" onclick="showCreateOrUpdateSentenceWindow('create')">Tambah</a>
					<a href="#" class="easyui-linkbutton" id="updateSentenceButton" data-options="iconCls: 'icon-edit', plain: true, width: 80" onclick="showCreateOrUpdateSentenceWindow('update')">Edit</a>
					<a href="#" class="easyui-linkbutton" id="deleteSentenceButton" data-options="iconCls: 'icon-remove', plain: true, width: 80" onclick="deleteSentence()">Delete</a>
				</div>
				<div class="col-6">
					<input class="easyui-searchbox" data-options="prompt: 'Type an SPK Number or Product Code ..'" style="width:100%;" id="search">
				</div>
			</div>
			<table id="sentenceTable" toolbar="#sentenceToolbar"></table>
		</div>
	</div>

	<div id="createOrUpdateSentenceWindow" class="easyui-window" title="Basic Window" data-options="iconCls:'icon-save',closed:true, minimizable:false, collapsible:false"  style="width:60%;height:auto;">                                
		<div title="Sentence" style="width: auto; margin: 20px;">
			<form id="sentenceForm" method="post">
				<input type="hidden" name="id" id="id">
				<div class="row mb-4">
					<div class="col-lg-12 col-xl-6">
						<input class="easyui-tagbox" value="" label="Kalimat / Kata :" labelPosition="top" style="width:100%;" name="words" id="words">
					</div>
					<div class="col-lg-12 col-xl-6">
						<input class="easyui-textbox" label="Arti :" labelPosition="top" style="width:100%;"  name="meaning"  id="meaning">
					</div>                        
				</div>
				<div class="row text-center">
					<div class="col-sm-12">
						<button type="button" class="btn btn-primary" onclick="createOrUpdateSentence()">SAVE</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('javascript')
    <script>
		$(document).ready(() => {
			initSentenceTable();
			setSentenceButtonState('disable');
		});

		$(window).resize(() => {
			resizeComponents();
		});

		function minimizeNavbar(){
			setTimeout(() => resizeComponents(), 500);
		}

		function resizeComponents(){
			var sentenceTable = $('#sentenceTable');
			if (sentenceTable.data('datagrid')){
				sentenceTable.datagrid('resize');
			}
		}

		function initSentenceTable(){
			$('#sentenceTable').datagrid({
				title: 'Daftar Kata',
				url: 'sentence/getAll',
				rownumbers: true,
				fitColumns: true,
				singleSelect: true,
				pagination: true,
				method: 'GET',
				queryParams: {
					_token: '<?= csrf_token() ?>'
				},
				onSelect: () => {
					setSentenceButtonState('enable');
				},
				loadFilter: (data) => {
					var rows = (data.data).map((sentence) => {
						sentence.sentence = (sentence.words).map((word) => {
							return word.word.name;
						}).join(' ');
						return sentence;
					});
					return {
						total: data.total,
						rows: rows
					};
				},
				columns: [[
					{field:'sentence', title: 'Kata / Kalimat', width: '40%'},
					{field:'meaning', title: 'Arti', width: '60%'},
				]]
			});
			var panel = $('#sentenceTable').datagrid('getPanel');
			panel.panel({
				cls: 'datagrid-panel-fullsize',
				headerCls: 'datagrid-panel-fullsize',
				bodyCls: 'datagrid-panel-fullsize'
			});
		}

		function showCreateOrUpdateSentenceWindow(action){
			var title = "Tambah Data";
			if (action == 'update'){
				var row = $('#sentenceTable').datagrid('getSelected');
				if (typeof row.words === 'object') {
					row.words = (row.words).map((word) => {
						return word.word.name;
					}).join(',');
				}
				$('#sentenceForm').form('load', row);
				title = "Ubah Data";
			}

			$('#createOrUpdateSentenceWindow').window('open').window('setTitle', title);
		}

		function createOrUpdateSentence(){
			var url = 'sentence';
			var method = 'POST';
			var id = $('#id').val();
			var alertMessage = 'Berhasil menambahkan kata atau kalimat';
			var mode = 'create';

			if (id !== '') {
				url = 'sentence/' + id;
				method = 'PUT';
				alertMessage = "Berhasil ubah kata atau kalimat";
				mode = 'update';
			}

			$.ajax({
				url: url,
				method: method,
				data: {
					_token: '<?= csrf_token() ?>',
					words: ($('#words').tagbox('getValues')).join(','),
					meaning: $('#meaning').textbox('getValue')
				},
				success: (response) => {
					if (mode == 'create'){
						$('#spkId').val(response.data);
						$('#sentenceForm').form("reset");
						$('#createOrUpdateSentenceWindow').window('close');
					}
					swal({
						position: 'top-end',
						icon: 'success',
						title: alertMessage,
						showConfirmButton: false,
						timer: 1500
					});
					reloadSentenceTable();
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

		function deleteSentence(){
			var row = $('#sentenceTable').datagrid('getSelected');
			if (row){
				console.log(row)
				swal({
					text: "Hapus " + row.meaning + " ?",
					icon: "warning",
					buttons: true,
					dangerMode: true
				}).then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: 'sentence/' + row.id,
							method: 'DELETE',
							data: {
								_token: '<?= csrf_token() ?>'
							},
							success: (response) => {
								reloadSentenceTable();
								swal({icon: 'success', title: 'Yeay..',	text: 'Kalimat berhasil dihapus'});
							}
						});
					}
				});
			} else {
				swal({icon: 'warning', title: 'Oopss..', text: 'Silahkan pilih kalimat yang akan dihapus!'});
			}
		}

		function reloadSentenceTable(search = ''){
			$('#sentenceTable').datagrid('load', {
				_token: '<?= csrf_token() ?>',
				search: search
			});
		}

		function setSentenceButtonState(option){
			$('#updateSentenceButton, #deleteSentenceButton').linkbutton(option);
		}
    </script>
@endsection