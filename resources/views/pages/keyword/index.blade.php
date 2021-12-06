@extends('layouts.default')
@section('title', 'Kata Kunci')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox animated fadeIn">
        <div id="cc" class="easyui-layout" style="width:100%;height:600px;">
            <div data-options="region:'center',title:'Aturan'" style="padding:5px;background:#eee;">
				<div class="row p-1" id="keywordsToolbar">
					<div class="col-12">     
						<a href="#" class="easyui-linkbutton" id="createOrUpdateKeywords" data-options="iconCls: 'icon-save', plain: true, width: 80" onclick="createOrUpdateKeywords()">Simpan</a>
					</div>
				</div>
                <div id="keywordsTree" class="easyui-tree" toolbar="#keywordsToolbar"></div>
            </div>
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

	<div id="mm" class="easyui-menu" style="width:120px;">
		<div data-options="iconCls:'icon-add'" onclick="insertKeyword()">Tambah</div>
		<div data-options="iconCls:'icon-edit'">Ubah</div>
		<div data-options="iconCls:'icon-delete'" onclick="removeKeyword()">Hapus</div>
		<div class="menu-sep"></div>
		<div>Batal</div>
	</div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(() => {
            $('#keywordsTree').tree({
                url: 'keywords',
                method: 'GET',
                lines: true,
				animate: true,
                onDblClick: function(node){
                    $(this).tree('beginEdit', node.target)
                },
				onContextMenu: function(e, node){
					if ($(this).tree('getSelected')){
						$('#mm').menu('show', {
							left: e.originalEvent.clientX,
							top: e.originalEvent.clientY
						});
					}
				}
            }).on("contextmenu",function(){
				return false;
			}); 
        })

		function createOrUpdateKeywords(){
			var rootNode = $('#keywordsTree').tree('getRoot')
			console.log(rootNode);
			$.ajax({
				url: 'keywords',
				method: 'POST',
				data: {
					_token: '<?= csrf_token() ?>',
					keywords: JSON.stringify([rootNode])
				},
				success: (response) => {
					if (response.data.success){
						swal({
							position: 'top-end',
							icon: 'success',
							title: 'Aturan berhasil diupdate',
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						console.log(response.data.error)
					}
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

		function removeKeyword(){
			var keyword = $('#keywordsTree').tree('getSelected')
			if (keyword){
				$('#keywordsTree').tree('remove', keyword.target);
			}
		}

		function insertKeyword(){
			var keyword = $('#keywordsTree').tree('getSelected')
			if (keyword){
				$('#keywordsTree').tree('append', {
					parent: keyword.target,
					data: {
						text: 'Aturan Baru'
					}
				})
			}
		}
    </script>
@endsection